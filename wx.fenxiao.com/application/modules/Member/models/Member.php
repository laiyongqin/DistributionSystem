<?php

/**
 * 账号库模型
 *
 * @author: lindexin
 * @since : 2016/04/29
 */

class MemberModel extends BaseModel {

    const AUTH_KEY = 'M@x^@!e@($';

    private $_filed;
    public function __construct()
    {
        parent::__construct('www', 't_member', 'm_id');
        $this->_filed = 'm_id,m_openId,m_username,m_password,m_nickname,m_avatar,m_realname,m_phone,m_sex,m_point,m_consume,m_vip,m_status,m_regIp';
    }

    /**
     * 通过OPENID获得用户信息
     * @param $openId
     */
    public function getOpenInfo($openId){
        return $this->_db->select($this->_filed)->from($this->_table)->where('m_openId',$openId)->fetchOne();
    }

    /**
     * 通过id获得用户信息
     * @param $id
     */
    public function getInfo($id){
        return $this->_db->select($this->_filed)->from($this->_table)->where('m_id',$id)->fetchOne();
    }

    /**
     * 整合信息
     *
     * @param $data..0.0
     * @return mixed
     */
    public function mergData($data = array(), $key = 'm_id'){
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, $key, TRUE);
        if ( ! $ids) {return $data;}

        // 产品信息
        $info = $this->_db->select('m_id,m_nickname,m_vip,m_addtime,m_avatar')->from($this->_table)->where("m_id IN({$ids})")->fetchAll();
        if ( $info === FALSE ) {return $data;}

        $info = Helper_Array::setIdsKey($info, 'm_id');
        foreach ( $data AS $k => &$row ) {
            if(isset($info[ $row[$key] ])){
                $row['m_id']         = $info[ $row[$key] ]['m_id'];
                $row['m_nickname']   = $info[ $row[$key] ]['m_nickname'];
                $row['m_vip']        = $info[ $row[$key] ]['m_vip'];
                $row['m_addtime']    = $info[ $row[$key] ]['m_addtime'];
                $row['m_avatar']     = $info[ $row[$key] ]['m_avatar'];
            }else{
                unset($data[$k]);
            }

        }

        return $data;
    }

    /**
     * 设置密码
     *
     * @param $password
     * @return string
     */
    public function setMd5Password($password) {
        return md5(MemberModel::AUTH_KEY . $password);
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @param int   $id
     * @return mixed
     */
    public function saveData($data, $id=0) {
        if($id > 0){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }

    /**
     * 判断用户名是否存在
     *
     * @param $name
     * @return miexd
     */
    public function getUserName($name,$mid) {
        return $this->_db->select('m_username')->from($this->_table)->where('m_username',$name)->where('m_id !='.$mid)->fetchValue();
    }
}