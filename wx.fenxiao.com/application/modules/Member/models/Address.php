<?php

/**
 * 地址
 *
 * @author: monyyip
     * @since : 2016/8/18 17:37
 */

class AddressModel extends BaseModel
{

    private $_field = 'a_id,m_id,a_phone,a_realname,a_wechat_id,a_province,a_city,a_area,a_address,a_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_address', 'a_id');
    }

    public function getAddress($mid = 0, $field = ''){
        return $this->_db->select($field ? $field : $this->_field)->from($this->_table)->where('m_id', $mid)->fetchOne();
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @param int   $id
     * @return mixed
     */
    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }
}