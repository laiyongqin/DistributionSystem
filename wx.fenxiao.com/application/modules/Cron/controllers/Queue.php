<?php

/**
 * 微信客服消息消息队列
 *
 * @author: moxiaobai
 * @since : 2016/8/25 15:18
 */

class QueueController extends BaseController
{

    private $_requestUri;


    private function init()
    {
        Yaf_Dispatcher::getInstance()->disableView();

        $this->_requestUri = $this->getRequest()->getRequestUri();
    }

    //收集自动取消的订单
    public function dealQueueAction()
    {

        //获取队列数据
        $info = QueueModel::getInstance()->getQueue();
        if (!$info) {
            $this->echoJson(1, 'No data processing');
        }

        //取入插入的数据
        $result = QueueModel::getInstance()->updateQueue($info['wq_id']);
        if ($result) {
            $data = json_decode($info['wq_data'], true);
            $message = MessageModel::getInstance()->rebuildMessage($info['wq_key'], $data);
            MessageModel::getInstance()->sendTextMessage($info['wq_openId'], $message);

            $this->echoJson(1, "Deal Success!ID:" . $info['wq_id']);
        } else {
            $this->echoJson(1, 'Deal Fail');
        }
    }

    /**
     * 输出Json数据
     *
     * @param $code  1正常，其他都是错误
     * @param $info
     */
    protected function echoJson($code, $info) {
        $data = array('code'=>$code, 'info'=>$info);
        $data = json_encode($data);

        $this->loadModel('Log', array(), 'Cron')->addLog($this->_requestUri, $code, $data);

        echo $data;
        exit;
    }

}