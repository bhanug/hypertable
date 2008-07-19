/** -*- c++ -*-
 * Copyright (C) 2008 Doug Judd (Zvents, Inc.)
 *
 * This file is part of Hypertable.
 *
 * Hypertable is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2 of the
 * License.
 *
 * Hypertable is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301, USA.
 */

#include "Common/Compat.h"
#include <iostream>

extern "C" {
#include <poll.h>
}

#include "Common/Error.h"
#include "Common/StringExt.h"
#include "Common/Serialization.h"

#include "AsyncComm/ApplicationQueue.h"
#include "AsyncComm/ResponseCallback.h"

#include "Hypertable/Lib/MasterClient.h"
#include "Hypertable/Lib/RangeServerProtocol.h"

#include "RequestHandlerCompact.h"
#include "RequestHandlerDestroyScanner.h"
#include "RequestHandlerDumpStats.h"
#include "RequestHandlerLoadRange.h"
#include "RequestHandlerUpdate.h"
#include "RequestHandlerCreateScanner.h"
#include "RequestHandlerFetchScanblock.h"
#include "RequestHandlerDropTable.h"
#include "RequestHandlerStatus.h"
#include "RequestHandlerReplayBegin.h"
#include "RequestHandlerReplayLoadRange.h"
#include "RequestHandlerReplayUpdate.h"
#include "RequestHandlerReplayCommit.h"
#include "RequestHandlerDropRange.h"
#include "RequestHandlerShutdown.h"

#include "ConnectionHandler.h"
#include "EventHandlerMasterConnection.h"
#include "RangeServer.h"


using namespace Hypertable;
using namespace Serialization;
using namespace Error;

/**
 *
 */
ConnectionHandler::ConnectionHandler(Comm *comm, ApplicationQueuePtr &app_queue, RangeServerPtr range_server, MasterClientPtr &master_client) : m_comm(comm), m_app_queue_ptr(app_queue), m_range_server_ptr(range_server), m_master_client_ptr(master_client), m_shutdown(false) {
  return;
}

/**
 *
 */
ConnectionHandler::ConnectionHandler(Comm *comm, ApplicationQueuePtr &app_queue, RangeServerPtr range_server) : m_comm(comm), m_app_queue_ptr(app_queue), m_range_server_ptr(range_server), m_shutdown(false) {
  return;
}


/**
 *
 */
void ConnectionHandler::handle(EventPtr &event) {
  int command = -1;

  if (m_shutdown)
    return;

  if (event->type == Event::MESSAGE) {
    ApplicationHandler *handler = 0;
    const uint8_t *msg = event->message;
    size_t remain = event->message_len;

    //event->display();

    try {
      command = decode_i16(&msg, &remain);

      // sanity check command code
      if (command < 0 || command >= RangeServerProtocol::COMMAND_MAX)
        HT_THROWF(PROTOCOL_ERROR, "Invalid command (%d)", command);

      switch (command) {
      case RangeServerProtocol::COMMAND_COMPACT:
        handler = new RequestHandlerCompact(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_LOAD_RANGE:
        handler = new RequestHandlerLoadRange(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_UPDATE:
        handler = new RequestHandlerUpdate(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_CREATE_SCANNER:
        handler = new RequestHandlerCreateScanner(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_DESTROY_SCANNER:
        handler = new RequestHandlerDestroyScanner(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_FETCH_SCANBLOCK:
        handler = new RequestHandlerFetchScanblock(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_DROP_TABLE:
        handler = new RequestHandlerDropTable(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_REPLAY_BEGIN:
        handler = new RequestHandlerReplayBegin(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_REPLAY_LOAD_RANGE:
        handler = new RequestHandlerReplayLoadRange(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_REPLAY_UPDATE:
        handler = new RequestHandlerReplayUpdate(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_REPLAY_COMMIT:
        handler = new RequestHandlerReplayCommit(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_DROP_RANGE:
        handler = new RequestHandlerDropRange(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_STATUS:
        handler = new RequestHandlerStatus(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_SHUTDOWN:
        m_shutdown = true;
        handler = new RequestHandlerShutdown(m_comm, m_range_server_ptr.get(), event);
        break;
      case RangeServerProtocol::COMMAND_DUMP_STATS:
        handler = new RequestHandlerDumpStats(m_comm, m_range_server_ptr.get(), event);
        break;
      default:
        HT_THROWF(PROTOCOL_ERROR, "Unimplemented command (%d)", command);
      }
      m_app_queue_ptr->add(handler);
    }
    catch (Exception &e) {
      ResponseCallback cb(m_comm, event);
      HT_ERROR_OUT << e << HT_END;
      std::string errmsg = format("%s - %s", e.what(), get_text(e.code()));
      cb.error(Error::PROTOCOL_ERROR, errmsg);
    }
  }
  else if (event->type == Event::CONNECTION_ESTABLISHED) {

    HT_INFOF("%s", event->to_str().c_str());

    /**
     * If this is the connection to the Master, then we need to register ourselves
     * with the master
     */
    if (m_master_client_ptr)
      m_app_queue_ptr->add(new EventHandlerMasterConnection(m_master_client_ptr, m_range_server_ptr->get_location(), event));
  }
  else {
    HT_INFOF("%s", event->to_str().c_str());
  }

}

