<?php

/**
 * 系统配置
 *
 * @author: moxiaobai
 * @since : 2016/8/19 10:39
 */

class ConfigModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_basic_config', 'bc_id');
    }

    /**
     * 根据Key获取键值
     * @param $key
     * @return mixed
     */
    public function getValueByKey($key) {
        return $this->_db->select('bc_value')->from('t_basic_config')->where('bc_key', $key)->fetchValue();
    }
}