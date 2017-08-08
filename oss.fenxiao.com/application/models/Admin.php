<?php

/**
 * 管理员
 *
 * @author: moxiaobai
 * @since : 2016/1/29 10:36
 */

class AdminModel extends BaseModel {

    const AUTH_KEY = 'M@x^@!e@($';

    public function __construct()
    {
        parent::__construct('www', 't_admin', 'a_id');
    }

    /**
     * 用户登录
     *
     * @param $username
     * @param $password
     * @return miexd
     */
    public function login($username, $password) {
        if(Helper_Check::isEmptyString($username)) {
            return $this->result(101, '用户名不能为空');
        }

        if(Helper_Check::isEmptyString($password)) {
            return $this->result(102, '密码不能为空');
        }

        //用户是否存在
        if(! $this->isExistData(array('username'=>$username))) {
            return $this->result(103, '用户名不存在');
        }

        $password = $this->setMd5Password($password);
        $where    = array('username'=>$username, 'password'=>$password);
        $rows     = $this->_setWhereSQL($where)
                            ->_db->select('a_id,a_username,a_realname,a_role,a_status')
                            ->from($this->_table)
                            ->fetchOne();

        if(!$rows) {
            return $this->result(104, '密码错误');
        } else {
            if($rows['a_status'] == 2) {
                return $this->result(105, '帐号被禁用');
            }
            Yaf_Session::getInstance()->set('userInfo', $rows);

            //记录最后登录日志
            $this->updateLoginTime($rows['a_id']);
            $this->addLoginLog($rows);

            return $this->result(1, '登录成功');
        }
    }

    /**
     * 更新最后登录时间
     *
     * @param $aid
     * @return mixed
     */
    private function updateLoginTime($aid) {
        return $this->_db->update($this->_table)->set('a_login_time', date('Y-m-d H:i:s'))->where('a_id', $aid)->execute();
    }

    /**
     * 添加登录日志
     *
     * @param $userInfo
     * @return mixed
     */
    private function addLoginLog($userInfo) {
        $data = array(
            'll_aid'        => $userInfo['a_id'],
            'll_username'   => $userInfo['a_username'],
            'll_realname'   => $userInfo['a_realname'],
            'll_login_ip'   => Helper_Location::getIpString(),
            'll_login_time' => date('Y-m-d H:i:s')
        );
        return $this->_db->insert('t_login_log')->rows($data)->execute();
    }

    /**
     * 修改密码
     *
     * @param $oldPasword
     * @param $newPassword
     * @return array
     */
    public function updateUserPassword($oldPasword, $newPassword) {
        if(Helper_Check::isEmptyString($oldPasword)) {
            return $this->result(101, '原密码不能为空');
        }

        if(Helper_Check::isEmptyString($newPassword)) {
            return $this->result(102, '新密码不能为空');
        }

        if($oldPasword == $newPassword) {
            return $this->result(102, '旧密码与新密码一样');
        }

        //原密码是否正确
        $oldPasword = $this->setMd5Password($oldPasword);
        $where      = array('password'=>$oldPasword, 'id'=>A_ID);
        if(! $this->isExistData($where)) {
            return $this->result(104, '原密码不正确');
        }

        $newPassword = $this->setMd5Password($newPassword);
        $result      = $this->_db->update($this->_table)->set('a_password', $newPassword)->where('a_id', A_ID)->execute();
        if($result) {
            return $this->result(1, '密码修改成功');
        } else {
            $this->result(105, '密码修改失败');
        }
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
     * 设置密码
     *
     * @param $password
     * @return string
     */
    private function setMd5Password($password) {
        return md5(AdminModel::AUTH_KEY . $password);
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
                    ->_db->select('a_id,a_username,a_realname,a_phone,a_status,a_addtime,a_login_time,a_role,a_openId')
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
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select('a_id,a_username,a_realname,a_phone,a_openId')->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @param int   $id
     * @return mixed
     */
    public function saveData($data, $id=0) {
        $data['a_realname'] = Helper_Filter::format($data['a_realname'], true);


        if ( $id > 0 ) {
            if($this->isExistData(array('phone'=>$data['a_phone'], 'a_id'=>$id)) ) {
                return $this->result(100, '手机号码已经存在');
            }

            if($this->isExistData(array('username'=>$data['a_username'], 'a_id'=>$id)) ) {
                return $this->result(101, '登录用户名已经存在');
            }
            if($data['a_openId']){
                if($this->isExistData(array('openId'=>$data['a_openId'], 'a_id'=>$id)) ) {
                    return $this->result(101, 'openId已经存在');
                }
            }
            $result = $this->_db->update($this->_table)->rows( $data )->where($this->_primary_key, $id)->execute();
        } else {
            if($this->isExistData(array('phone'=>$data['a_phone'])) ) {
                return $this->result(100, '手机号码已经存在');
            }

            if($this->isExistData(array('username'=>$data['a_username'])) ) {
                return $this->result(101, '登录用户名已经存在');
            }
            if($data['a_openId']){
                if($this->isExistData(array('openId'=>$data['a_openId'], 'a_id'=>$id)) ) {
                    return $this->result(101, 'openId已经存在');
                }
            }

            $data['a_password'] = $this->setMd5Password($data['a_password']);
            $data['a_addtime']  = date('Y-m-d H:i:s');
            $result = $this->_db->insert($this->_table)->rows( $data )->execute();
        }

        if($result) {
            return $this->result(1, '操作成功');
        } else {
            return $this->result(102, '没有修改');
        }
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
        $password = $this->setMd5Password($password);
        return $this->_db->update($this->_table)->set('a_password', $password)->where($this->_primary_key, $id)->execute();
    }

    /**根据用户id获得名称
     * @param $id
     */
    public function getOpendId($id) {
        return $this->_db->select('a_openId')->from($this->_table)->where($this->_primary_key, $id)->fetchValue();
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
            $this->_db->where("a_id", $where['id']);
        }

        if (isset($where['a_id']) AND $where['a_id']) {
            $this->_db->where("a_id != " . $where['a_id']);
        }

        if (isset($where['username']) AND $where['username']) {
            $this->_db->where("a_username like '%{$where['username']}%'");
        }

        if (isset($where['password']) AND $where['password']) {
            $this->_db->where("a_password", $where['password']);
        }

        if (isset($where['phone']) AND $where['phone']) {
            $this->_db->where("a_phone", $where['phone']);
        }

        if (isset($where['openId']) AND $where['openId']) {
            $this->_db->where("a_openId", $where['openId']);
        }

        return $this;
    }

}