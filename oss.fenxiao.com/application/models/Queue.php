<?php

/**
 * 微信客服消息队列
 *
 * @author: moxiaobai
 * @since : 2016/8/25 14:34
 */

class QueueModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_weixin_queue', 'wq_id');
    }

    /**
     * 添加消息队列
     *
     * @param $openId
     * @param $key
     * @param $data
     * @return mixed
     */
    public function addQueue($openId, $key, $data) {
        $rows = array(
            'wq_openId'  => $openId,
            'wq_key'     => $key,
            'wq_data'    => json_encode($data),
            'wq_addtime' => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_weixin_queue')->rows($rows)->execute();
    }

    /**
     * 获取队列
     * @return mixed
     */
    public function getQueue() {
        return $this->_db->select('wq_id,wq_openId,wq_key,wq_data')->from('t_weixin_queue')->where('wq_status',1)->order('wq_id', 'ASC')->fetchOne();
    }

    /**
     * 更新队列
     * @param $id
     * @return mixed
     */
    public function updateQueue($id) {
        $rows = array(
            'wq_status'     => 2,
            'wq_updatetime' => date('Y-m-d H:i:s')
        );

        return $this->_db->update('t_weixin_queue')->where('wq_id', $id)->rows($rows)->execute();
    }
}