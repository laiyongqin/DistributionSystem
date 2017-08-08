<?php

/**
 * 权限模型
 *
 * @author moxiaobai
 * @since  2015-3-20
 */

class RightModel extends BaseModel {

    public function __construct() {
        parent::__construct('www', 't_right', 'r_id');
    }

    /**
     * 获取用户权限菜单ID
     *
     * @param $a_id   用户ID
     * @return bool
     */
    public function getRight($a_id) {
        $this->_db->select('m_ids')->from('t_right')->where('u_id', $a_id);
        $row = $this->_db->fetchOne();

        return isset($row['m_ids']) ? $row['m_ids'] : FALSE;
    }

    /**
     * 查询未分配权限的用户
     *
     * @return array
     */
    public function getRightUserMap() {
        $this->_db->select('a_id','a_realname,a_username')->from('t_admin')->where('a_role = 2 AND a_status =1');
        $temp= $this->_db->fetchAll();

        $data= array();
        if($temp) {
            foreach ($temp AS $row) {
                $data[ $row['a_id'] ] = $row['a_realname'] . "[{$row['a_username']}]";
            }
        }

        return $data;
    }

    public function saveRight($a_id, $rights) {
        $rights = implode(',', $rights);
        $m_ids  = $this->getRight($a_id);
        if ( $m_ids !== FALSE ) {
            //更新权限
            return $this->_db->update('t_right')->rows( array('m_ids' => $rights) )->where('u_id', $a_id)->execute();
        } else {
            return $this->_db->insert('t_right')->rows( array('m_ids' => $rights, 'u_id' => $a_id) )->execute();
        }
    }
}