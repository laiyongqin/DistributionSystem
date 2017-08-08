<?php

/**
 * 订单
 *
 * @author: moxiaobai
 * @since : 2016/8/19 10:32
 */

class OrderController extends BaseController {

    private $_requestUri;


    private function init() {
        Yaf_Dispatcher::getInstance()->disableView();

        $this->_requestUri = $this->getRequest()->getRequestUri();
    }

    //收集自动取消的订单
    public function collectCancleOrderAction() {
        $closeOrderModel = $this->loadModel('CloseOrder', array(), 'Cron');

        //获取临时订单
        $expireOrder = $closeOrderModel->getExpireOrder();
        if(!$expireOrder) {
            $this->echoJson(1,  'No data processing');
        }

        //写入临时表
        $closeOrder      = $closeOrderModel->getCloseOrder($expireOrder);

        //取入插入的数据
        $result = array_diff_key($expireOrder, $closeOrder);
        if($result) {
            foreach($result as $rows) {
                $closeOrderModel->addCloseOrder($rows['o_id']);
            }

            $this->echoJson(1,  "Count:" . count($result));
        } else {
            $this->echoJson(1,  'No data processing');
        }
    }

    //处理自动取消的订单
    public function dealCancleOrderAction() {
        $closeOrderModel = $this->loadModel('CloseOrder', array(), 'Cron');

        //获取需要处理订单的信息
        $orderInfo       = $closeOrderModel->getOrderInfo();
        if(!$orderInfo) {
            $this->echoJson(1,  'No data processing');
        }

        //订单ID
        $oid = $orderInfo['o_id'];

        //关闭订单
        $mallOrderModel = $this->loadModel('Order', array(), 'Mall');
        $ret = $mallOrderModel->updateOrderPayStatus($oid, 2);
        if($ret) {
            //更改临时表状态
            $closeOrderModel->updateOrderStatus($oid);

            //处理订单
            $mallOrderModel->cancleOrder($oid);

            $this->echoJson(1,  '订单取消成功');
        } else {
            $this->echoJson(1,  '订单状态更改失败');
        }
    }

    //手机自动完成的订单
    public function collectCompleteOrderAction() {
        $confirmOrderModel    = $this->loadModel('ConfirmOrder', array(), 'Cron');

        //获取临时表
        $completeOrder    = $confirmOrderModel->getCompleteOrder();
        if(!$completeOrder) {
            $this->echoJson(1,  'No data processing');
        }

        //写入临时表
        $confirmOrder  = $confirmOrderModel->getConfirmOrder($completeOrder);

        //取入插入的数据
        $result = array_diff_key($completeOrder, $confirmOrder);
        if($result) {
            foreach($result as $rows) {
                $confirmOrderModel->addConfirmOrder($rows['o_id']);
            }

            $this->echoJson(1,  "Count:" . count($result));
        } else {
            $this->echoJson(1,  'No data processing');
        }
    }

    //处理自动完成的订单
    public function dealCompleteOrderAction() {
        $confirmOrderModel    = $this->loadModel('ConfirmOrder', array(), 'Cron');

        //获取需要处理订单的信息
        $orderInfo            = $confirmOrderModel->getOrderInfo();
        if(!$orderInfo) {
            $this->echoJson(1,  'No data processing');
        }

        //订单状态改成已收货
        $oid = $orderInfo['o_id'];

        $mallOrderModel = $this->loadModel('Order', array(), 'Mall');
        $ret = $mallOrderModel->updateOrderConfirmStatus($oid,3);
        if($ret) {
            //更改临时表状态
            $confirmOrderModel->updateOrderStatus($oid);

            //处理订单
            $mallOrderModel->completeOrder($oid);

            $this->echoJson(1,  '订单确认成功');
        } else {
            $this->echoJson(1,  '订单确认失败');
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

