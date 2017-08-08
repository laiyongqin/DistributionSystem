<?php

/**
 * 用户管理
 *
 * @author: lindexin
 * @since : 2016/1/29 10:36
 */

class MemberModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_member', 'm_id');
    }

    /**
     * 获取列表
     *
     * @param array $where
     * @param array $pagination
     * @return bool
     */
    public function getList($where=array(), $pagination=array()) {
        $data = $this->_setWhereSQL($where)
                    ->_setPaginationSQL($pagination)
                    ->_db->select('m_id,m_openId,m_username,m_realname,m_password,m_status,m_addtime,m_sex,m_nickname,m_phone,m_consume,m_vip,m_regIp')
                    ->from($this->_table)
                    ->order($this->_primary_key, 'DESC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }

    /**
     * 统计数量
     *
     * @param array $where
     */
    public function countData($where=array()) {
        return $this->_setWhereSQL($where)->_db->select('COUNT(*)')->from($this->_table)->fetchValue();
    }

    /**
     * 改变状态
     *
     * @param $id
     * @param array $data 修改数据
     * @return mixed
     */
    public function changeData($id, $data) {
        return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
    }

    /**
     * 修改密码
     *
     * @param $id
     * @param $password
     * @return mixed
     */
    public function editPassword($id, $password) {
        return $this->_db->update($this->_table)->set('m_password', $password)->where($this->_primary_key, $id)->execute();
    }


    /**
     * SQL分页查询
     */
    private function _setPaginationSQL( $pagination = array() ) {
        if ( isset($pagination['page']) AND isset($pagination['pagesize']) ) {
            $page      = isset( $pagination['page'] ) ? intval($pagination['page']) : 1;
            $pagesize  = isset( $pagination['pagesize']  ) ? intval($pagination['pagesize'])  : 10;
            $this->_db->page($page, $pagesize);
        } elseif ( isset($pagination['limit']) ) {
            $this->_db->limit( intval($pagination['limit']) );
        }
        return $this;
    }

    /**
     * SQL Where条件
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if (isset($where['id']) AND $where['id']) {
            $this->_db->where("m_id", $where['id']);
        }

        if (isset($where['mid']) AND $where['mid']) {
            $this->_db->where("m_id !=" . $where['mid']);
        }

        if (isset($where['username']) AND $where['username']) {
            $this->_db->where('m_username',$where['username']);
        }

        if (isset($where['status']) AND $where['status']) {
            $this->_db->where('m_status',$where['status']);
        }

        if (isset($where['vip']) AND $where['vip']) {
            $this->_db->where('m_vip',$where['vip']);
        }

        if (isset($where['phone']) AND $where['phone']) {
            $this->_db->where('m_phone',$where['phone']);
        }

        return $this;
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @param int   $id
     * @return mixed
     */
    public function saveData($data, $id=0) {
        $data['m_username'] = Helper_Filter::format($data['m_username'], true);

        if ( $id > 0 ) {

            if($this->isExistData(array('username'=>$data['m_username'], 'mid'=>$id)) ) {
                return $this->result(101, '登录用户名已经存在');
            }
            $result = $this->_db->update($this->_table)->rows( $data )->where($this->_primary_key, $id)->execute();
        } else {
            if($this->isExistData(array('username'=>$data['m_username'])) ) {
                return $this->result(101, '登录用户名已经存在');
            }

            $data['m_password'] = Helper_Secret::encode($data['m_password']);
            $data['m_addtime']  = date('Y-m-d H:i:s');
            $result = $this->_db->insert($this->_table)->rows( $data )->execute();
        }

        if($result) {
            return $this->result(1, '操作成功');
        } else {
            return $this->result(102, '没有修改');
        }
    }

    /**
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select('m_id,m_username,m_realname,m_password,m_vip,m_status,m_addtime')->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**根据用户id获得名称
     * @param $id
     */
    public function getRealName($id) {
        return $this->_db->select('m_phone,m_realname')->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**根据用户id获得openID
     * @param $id
     */
    public function getOpenId($id) {
        return $this->_db->select('m_openId')->from($this->_table)->where($this->_primary_key, $id)->fetchValue();
    }

    /**
     * 是否存在用户
     *
     * @param $username
     * @return mixed
     */
    private function isExistData($where) {
        return $this->_setWhereSQL($where)->_db->select($this->_primary_key)->from($this->_table)->fetchValue();
    }

    /**
     * 整合信息
     *
     * @param $data
     * @return mixed
     */
    public function mergData($data,$key='m_id') {
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, $key, TRUE);
        if ( ! $ids) {return $data;}

        //订单信息
        $info = $this->_db->select('m_id,m_nickname,m_realname')->from($this->_table)->where("m_id IN({$ids})")->fetchAll();
        if ( $info === FALSE ) {return $data;}

        $info = Helper_Array::setIdsKey($info, 'm_id');

        foreach ( $data AS &$row ) {
            $row['m_nickname']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['m_nickname'] : '';
            $row['m_realname']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['m_realname'] : '';
            $row['m_id']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['m_id'] : '';
        }
        return $data;
    }

}