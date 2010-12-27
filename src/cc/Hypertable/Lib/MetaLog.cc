/**
 * Copyright (C) 2008 Luke Lu (Zvents, Inc.)
 *
 * This file is part of Hypertable.
 *
 * Hypertable is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2 of the
 * License, or any later version.
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
#include "Common/Time.h"
#include "RangeServerMetaLogEntries.h"
#include "MasterMetaLogEntries.h"

#define R_CAST_AND_OUTPUT(_type_, _ep_, _out_) \
  _type_ *sp = (_type_ *)_ep_; _out_ <<'{'<< #_type_ <<": timestamp='" \
      << hires_ts_date <<"' table="<< sp->table <<" range="<< sp->range

namespace Hypertable {

using namespace MetaLogEntryFactory;
using namespace RangeServerTxn;

std::ostream &
operator<<(std::ostream &out, const MetaLogEntry *ep) {
  switch (ep->get_type()) {
    case RS_SPLIT_START: {
      R_CAST_AND_OUTPUT(SplitStart, ep, out)
          <<" state="<< sp->range_state <<'}';
    } break;
    case RS_SPLIT_SHRUNK: {
      R_CAST_AND_OUTPUT(SplitShrunk, ep, out)
          <<" state="<< sp->range_state <<'}';
    } break;
    case RS_SPLIT_DONE: {
      R_CAST_AND_OUTPUT(SplitDone, ep, out)
          <<" state="<< sp->range_state <<'}';
    } break;
    case RS_RANGE_LOADED: {
      R_CAST_AND_OUTPUT(RangeLoaded, ep, out)
          <<" state="<< sp->range_state <<'}';
    } break;
    case RS_MOVE_START: {
      R_CAST_AND_OUTPUT(MoveStart, ep, out)
          <<" state="<< sp->range_state <<'}';
    } break;
    case RS_MOVE_DONE: {
      R_CAST_AND_OUTPUT(MoveDone, ep, out) <<'}';
    } break;
    case RS_DROP_TABLE: {
      R_CAST_AND_OUTPUT(DropTable, ep, out) <<'}';
    } break;
    case RS_LOG_RECOVER: {
      out << "{RsmlRecover: timestamp='" << hires_ts_date << "'}";
    } break;
    case MASTER_SERVER_JOINED: {
      out << "{ServerJoined: timestamp='" << hires_ts_date
          << "' location='" << ((MasterTxn::ServerJoined *)ep)->location << "'}";
    } break;
    case MASTER_SERVER_LEFT: {
      out << "{ServerLeft: timestamp='" << hires_ts_date
          << "' location='" << ((MasterTxn::ServerLeft *)ep)->location << "'}";
    } break;
    case MASTER_SERVER_REMOVED: {
      out << "{ServerRemoved: timestamp='" << hires_ts_date
          << "' location='" << ((MasterTxn::ServerRemoved *)ep)->location << "'}";
    } break;
    case MASTER_RANGE_ASSIGNED: {
      MasterTxn::RangeAssigned *sp = (MasterTxn::RangeAssigned *)ep;
      out << "{RangeAssigned: timestamp='" << hires_ts_date
          <<"' table="<< sp->table <<" range="<< sp->range
          <<"' transfer_log='" << sp->transfer_log << "' soft_limit="
          << sp->soft_limit << " location='" << sp->location << "'}";
    } break;
    case MASTER_RANGE_LOADED: {
      MasterTxn::RangeLoaded *sp = (MasterTxn::RangeLoaded *)ep;
      out << "{RangeLoaded: timestamp='" << hires_ts_date
          <<"' table="<< sp->table <<" range="<< sp->range
          <<"' location='" << sp->location << "'}";
    } break;
    case MASTER_LOG_RECOVER: {
      out << "{MmlRecover: timestamp='" << hires_ts_date << "'}";
    } break;
    default: out <<"{UnknownEntry("<< ep->get_type() <<")}";
  }
  return out;
}

} // namespace Hypertable
