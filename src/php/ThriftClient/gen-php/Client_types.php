<?php
/**
 * Autogenerated by Thrift
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


$GLOBALS['Hypertable_ThriftGen_E_CellFlag'] = array(
  'DELETE_ROW' => 0,
  'DELETE_CF' => 1,
  'DELETE_CELL' => 2,
  'INSERT' => 255,
);

final class Hypertable_ThriftGen_CellFlag {
  const DELETE_ROW = 0;
  const DELETE_CF = 1;
  const DELETE_CELL = 2;
  const INSERT = 255;
  static public $__names = array(
    0 => 'DELETE_ROW',
    1 => 'DELETE_CF',
    2 => 'DELETE_CELL',
    255 => 'INSERT',
  );
}

$GLOBALS['Hypertable_ThriftGen_E_MutatorFlag'] = array(
  'NO_LOG_SYNC' => 1,
);

final class Hypertable_ThriftGen_MutatorFlag {
  const NO_LOG_SYNC = 1;
  static public $__names = array(
    1 => 'NO_LOG_SYNC',
  );
}

class Hypertable_ThriftGen_RowInterval {
  static $_TSPEC;

  public $start_row = null;
  public $start_inclusive = true;
  public $end_row = null;
  public $end_inclusive = true;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'start_row',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'start_inclusive',
          'type' => TType::BOOL,
          ),
        3 => array(
          'var' => 'end_row',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'end_inclusive',
          'type' => TType::BOOL,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['start_row'])) {
        $this->start_row = $vals['start_row'];
      }
      if (isset($vals['start_inclusive'])) {
        $this->start_inclusive = $vals['start_inclusive'];
      }
      if (isset($vals['end_row'])) {
        $this->end_row = $vals['end_row'];
      }
      if (isset($vals['end_inclusive'])) {
        $this->end_inclusive = $vals['end_inclusive'];
      }
    }
  }

  public function getName() {
    return 'RowInterval';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->start_row);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->start_inclusive);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->end_row);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->end_inclusive);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('RowInterval');
    if ($this->start_row !== null) {
      $xfer += $output->writeFieldBegin('start_row', TType::STRING, 1);
      $xfer += $output->writeString($this->start_row);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->start_inclusive !== null) {
      $xfer += $output->writeFieldBegin('start_inclusive', TType::BOOL, 2);
      $xfer += $output->writeBool($this->start_inclusive);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_row !== null) {
      $xfer += $output->writeFieldBegin('end_row', TType::STRING, 3);
      $xfer += $output->writeString($this->end_row);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_inclusive !== null) {
      $xfer += $output->writeFieldBegin('end_inclusive', TType::BOOL, 4);
      $xfer += $output->writeBool($this->end_inclusive);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Hypertable_ThriftGen_CellInterval {
  static $_TSPEC;

  public $start_row = null;
  public $start_column = null;
  public $start_inclusive = true;
  public $end_row = null;
  public $end_column = null;
  public $end_inclusive = true;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'start_row',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'start_column',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'start_inclusive',
          'type' => TType::BOOL,
          ),
        4 => array(
          'var' => 'end_row',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'end_column',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'end_inclusive',
          'type' => TType::BOOL,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['start_row'])) {
        $this->start_row = $vals['start_row'];
      }
      if (isset($vals['start_column'])) {
        $this->start_column = $vals['start_column'];
      }
      if (isset($vals['start_inclusive'])) {
        $this->start_inclusive = $vals['start_inclusive'];
      }
      if (isset($vals['end_row'])) {
        $this->end_row = $vals['end_row'];
      }
      if (isset($vals['end_column'])) {
        $this->end_column = $vals['end_column'];
      }
      if (isset($vals['end_inclusive'])) {
        $this->end_inclusive = $vals['end_inclusive'];
      }
    }
  }

  public function getName() {
    return 'CellInterval';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->start_row);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->start_column);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->start_inclusive);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->end_row);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->end_column);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->end_inclusive);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CellInterval');
    if ($this->start_row !== null) {
      $xfer += $output->writeFieldBegin('start_row', TType::STRING, 1);
      $xfer += $output->writeString($this->start_row);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->start_column !== null) {
      $xfer += $output->writeFieldBegin('start_column', TType::STRING, 2);
      $xfer += $output->writeString($this->start_column);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->start_inclusive !== null) {
      $xfer += $output->writeFieldBegin('start_inclusive', TType::BOOL, 3);
      $xfer += $output->writeBool($this->start_inclusive);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_row !== null) {
      $xfer += $output->writeFieldBegin('end_row', TType::STRING, 4);
      $xfer += $output->writeString($this->end_row);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_column !== null) {
      $xfer += $output->writeFieldBegin('end_column', TType::STRING, 5);
      $xfer += $output->writeString($this->end_column);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_inclusive !== null) {
      $xfer += $output->writeFieldBegin('end_inclusive', TType::BOOL, 6);
      $xfer += $output->writeBool($this->end_inclusive);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Hypertable_ThriftGen_ScanSpec {
  static $_TSPEC;

  public $row_intervals = null;
  public $cell_intervals = null;
  public $return_deletes = false;
  public $revs = 0;
  public $row_limit = 0;
  public $start_time = null;
  public $end_time = null;
  public $columns = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'row_intervals',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'Hypertable_ThriftGen_RowInterval',
            ),
          ),
        2 => array(
          'var' => 'cell_intervals',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'Hypertable_ThriftGen_CellInterval',
            ),
          ),
        3 => array(
          'var' => 'return_deletes',
          'type' => TType::BOOL,
          ),
        4 => array(
          'var' => 'revs',
          'type' => TType::I32,
          ),
        5 => array(
          'var' => 'row_limit',
          'type' => TType::I32,
          ),
        6 => array(
          'var' => 'start_time',
          'type' => TType::I64,
          ),
        7 => array(
          'var' => 'end_time',
          'type' => TType::I64,
          ),
        8 => array(
          'var' => 'columns',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['row_intervals'])) {
        $this->row_intervals = $vals['row_intervals'];
      }
      if (isset($vals['cell_intervals'])) {
        $this->cell_intervals = $vals['cell_intervals'];
      }
      if (isset($vals['return_deletes'])) {
        $this->return_deletes = $vals['return_deletes'];
      }
      if (isset($vals['revs'])) {
        $this->revs = $vals['revs'];
      }
      if (isset($vals['row_limit'])) {
        $this->row_limit = $vals['row_limit'];
      }
      if (isset($vals['start_time'])) {
        $this->start_time = $vals['start_time'];
      }
      if (isset($vals['end_time'])) {
        $this->end_time = $vals['end_time'];
      }
      if (isset($vals['columns'])) {
        $this->columns = $vals['columns'];
      }
    }
  }

  public function getName() {
    return 'ScanSpec';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->row_intervals = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new Hypertable_ThriftGen_RowInterval();
              $xfer += $elem5->read($input);
              $this->row_intervals []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->cell_intervals = array();
            $_size6 = 0;
            $_etype9 = 0;
            $xfer += $input->readListBegin($_etype9, $_size6);
            for ($_i10 = 0; $_i10 < $_size6; ++$_i10)
            {
              $elem11 = null;
              $elem11 = new Hypertable_ThriftGen_CellInterval();
              $xfer += $elem11->read($input);
              $this->cell_intervals []= $elem11;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->return_deletes);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->revs);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->row_limit);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->start_time);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->end_time);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::LST) {
            $this->columns = array();
            $_size12 = 0;
            $_etype15 = 0;
            $xfer += $input->readListBegin($_etype15, $_size12);
            for ($_i16 = 0; $_i16 < $_size12; ++$_i16)
            {
              $elem17 = null;
              $xfer += $input->readString($elem17);
              $this->columns []= $elem17;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('ScanSpec');
    if ($this->row_intervals !== null) {
      if (!is_array($this->row_intervals)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('row_intervals', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->row_intervals));
        {
          foreach ($this->row_intervals as $iter18)
          {
            $xfer += $iter18->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->cell_intervals !== null) {
      if (!is_array($this->cell_intervals)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('cell_intervals', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRUCT, count($this->cell_intervals));
        {
          foreach ($this->cell_intervals as $iter19)
          {
            $xfer += $iter19->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->return_deletes !== null) {
      $xfer += $output->writeFieldBegin('return_deletes', TType::BOOL, 3);
      $xfer += $output->writeBool($this->return_deletes);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->revs !== null) {
      $xfer += $output->writeFieldBegin('revs', TType::I32, 4);
      $xfer += $output->writeI32($this->revs);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->row_limit !== null) {
      $xfer += $output->writeFieldBegin('row_limit', TType::I32, 5);
      $xfer += $output->writeI32($this->row_limit);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->start_time !== null) {
      $xfer += $output->writeFieldBegin('start_time', TType::I64, 6);
      $xfer += $output->writeI64($this->start_time);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->end_time !== null) {
      $xfer += $output->writeFieldBegin('end_time', TType::I64, 7);
      $xfer += $output->writeI64($this->end_time);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->columns !== null) {
      if (!is_array($this->columns)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('columns', TType::LST, 8);
      {
        $output->writeListBegin(TType::STRING, count($this->columns));
        {
          foreach ($this->columns as $iter20)
          {
            $xfer += $output->writeString($iter20);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Hypertable_ThriftGen_Cell {
  static $_TSPEC;

  public $row_key = null;
  public $column_family = null;
  public $column_qualifier = null;
  public $value = null;
  public $timestamp = null;
  public $revision = null;
  public $flag = 255;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'row_key',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'column_family',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'column_qualifier',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'value',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'timestamp',
          'type' => TType::I64,
          ),
        6 => array(
          'var' => 'revision',
          'type' => TType::I64,
          ),
        7 => array(
          'var' => 'flag',
          'type' => TType::I16,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['row_key'])) {
        $this->row_key = $vals['row_key'];
      }
      if (isset($vals['column_family'])) {
        $this->column_family = $vals['column_family'];
      }
      if (isset($vals['column_qualifier'])) {
        $this->column_qualifier = $vals['column_qualifier'];
      }
      if (isset($vals['value'])) {
        $this->value = $vals['value'];
      }
      if (isset($vals['timestamp'])) {
        $this->timestamp = $vals['timestamp'];
      }
      if (isset($vals['revision'])) {
        $this->revision = $vals['revision'];
      }
      if (isset($vals['flag'])) {
        $this->flag = $vals['flag'];
      }
    }
  }

  public function getName() {
    return 'Cell';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->row_key);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->column_family);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->column_qualifier);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->value);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->timestamp);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->revision);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->flag);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Cell');
    if ($this->row_key !== null) {
      $xfer += $output->writeFieldBegin('row_key', TType::STRING, 1);
      $xfer += $output->writeString($this->row_key);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->column_family !== null) {
      $xfer += $output->writeFieldBegin('column_family', TType::STRING, 2);
      $xfer += $output->writeString($this->column_family);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->column_qualifier !== null) {
      $xfer += $output->writeFieldBegin('column_qualifier', TType::STRING, 3);
      $xfer += $output->writeString($this->column_qualifier);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->value !== null) {
      $xfer += $output->writeFieldBegin('value', TType::STRING, 4);
      $xfer += $output->writeString($this->value);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->timestamp !== null) {
      $xfer += $output->writeFieldBegin('timestamp', TType::I64, 5);
      $xfer += $output->writeI64($this->timestamp);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->revision !== null) {
      $xfer += $output->writeFieldBegin('revision', TType::I64, 6);
      $xfer += $output->writeI64($this->revision);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->flag !== null) {
      $xfer += $output->writeFieldBegin('flag', TType::I16, 7);
      $xfer += $output->writeI16($this->flag);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class Hypertable_ThriftGen_ClientException extends TException {
  static $_TSPEC;

  public $code = null;
  public $what = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'code',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'what',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['code'])) {
        $this->code = $vals['code'];
      }
      if (isset($vals['what'])) {
        $this->what = $vals['what'];
      }
    }
  }

  public function getName() {
    return 'ClientException';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->code);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->what);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('ClientException');
    if ($this->code !== null) {
      $xfer += $output->writeFieldBegin('code', TType::I32, 1);
      $xfer += $output->writeI32($this->code);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->what !== null) {
      $xfer += $output->writeFieldBegin('what', TType::STRING, 2);
      $xfer += $output->writeString($this->what);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>
