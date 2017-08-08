<?php

/**
 * 数据库模式基类
 * 
 * @author xiaogang
 * @since  2012-11-12
 */

class BaseModel extends ExpandModel {

    protected $_db;
    protected $_table;
    protected $_primary_key;

    const AUTH_KEY = 'M@x^@!e@($';

    public function __construct($database, $table, $primaryKey)
    {
        $this->_db             = $this->linkdb($database);
        $this->_table          = $table;
        $this->_primary_key   = $primaryKey;
    }


}

