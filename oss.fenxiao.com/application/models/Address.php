<?php

/**
 * 地址管理
 *
 * @author: lindexin
 * @since : 2016/1/29 10:36
 */

class AddressModel extends BaseModel {

    private $_field;
    public function __construct()
    {
        parent::__construct('www', 't_address', 'a_id');
        $this->_field = 'a_id,m_id,a_phone,a_realname,a_wechat_id,a_province,a_city,a_area,a_address,a_addtime';
    }

    /**
     * 通过用户 获得单条数据
     * @param $id 订单id
     * @return miexd
     */
    public function getUserInfo($id){
        return $this->_db->select($this->_field)->from($this->_table)->where('m_id',$id)->fetchOne();
    }

}