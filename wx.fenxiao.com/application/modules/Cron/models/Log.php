<?php

/**
 * 计划任务日志
 *
 * @author: moxiaobai
 * @since : 2016/8/19 10:22
 */

class LogModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_cron_log', 'cl_id');
    }

    /**
     * 添加计划任务日志
     *
     * @param $url     任务Url
     * @param $status  状态
     * @param $result  输出结果
     * @return mixed
     */
    public function addLog($url, $status, $result) {
        $data = array(
            'cl_url'       => $url,
            'cl_status'    => $status,
            'cl_result'    => $result,
            'cl_datetime'  => date('Y-m-d H:i:s')
        );
        return $this->_db->insert('t_cron_log')->rows($data)->execute();
    }
}