<?php

/**
 * 登录日志
 *
 * @author: moxiaobai
 * @since : 2016/8/24 11:46
 */

class LoginLogModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_login_log', 'll_id');
    }

    public function getList($aid, $limit=10) {
        $rows = $this->_db->select('ll_username,ll_realname,ll_login_ip,ll_login_time')
                    ->from('t_login_log')
                    ->where('ll_aid', $aid)
                    ->limit($limit)
                    ->order("ll_id", "DESC")
                    ->fetchAll();

        if($rows === false) { return false;}

        foreach($rows as &$row) {
            $row['ll_login_ip'] = Helper_Location::getIpByString($row['ll_login_ip']);
        }

        return $rows;
    }
}