<?php

/**
 * 微信系统消息
 *
 * @author: moxiaobai
 * @since : 2016/2/23 11:23
 */

class LogModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_weixin_log', 'l_id');
    }

    /**
     * 添加日志数据
     *
     * @param $data
     * @return mixed
     */
    public function addLog($data) {
        $openId = $data['FromUserName'];
        $type   = $data['MsgType'];
        $log    = json_encode($data);

        $data = array(
            'cl_openId'    => $openId,
            'cl_type'      => $type,
            'cl_data'      => $log,
            'cl_datetime'  => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_weixin_log')->rows( $data )->execute();
    }
}