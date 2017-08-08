<?php

/**
 * 订单操作
 *
 * @author: moxiaobai
 * @since : 2016/4/19 20:33
 */


class OrderController extends BaseController {
    //初始化
    private function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //创建订单
    public function createAction() {
        $paymentModel = $this->loadModel('Payment', array(), 'Pay');
        $orderNo = isset($_GET['orderNo']) ? Helper_Filter::format($_GET['orderNo'], FALSE, TRUE) : '';
        // 获得订单信息
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->getOrderInfoByOrderNo($orderNo, 1, 'm_id, p_title, pp_title,o_pay_status, p_price,o_payment_amount,o_number');
        if(empty($orderInfo)){
            Helper_Json::formJson('订单信息错误');
        }

        $info = $paymentModel->getJsApiParameters($orderNo, $orderInfo['p_title'], $orderInfo['o_payment_amount']);
        Helper_Json::formJson(json_decode($info, TRUE), 'y');
    }

    //重新支付
    public function repayAction(){
        $orderNo = isset($_POST['orderNo']) ? Helper_Filter::format($_POST['orderNo'], FALSE, TRUE) : '';
        // 获得订单信息
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->getOrderInfoByOrderNo($orderNo, 1, 'o_pay_status,o_addtime');
        if(empty($orderInfo)){
            Helper_Json::formJson('订单信息错误');
        }

        if($orderInfo['o_pay_status'] != 1){
            Helper_Json::formJson('只有未支付订单才可重新支付');
        }

        // 计算过期时间
        $expireTime  = ConfigModel::getInstance()->getValueByKey('auto_cancle_order');
        if(strtotime($orderInfo['o_addtime']) + $expireTime * 3600 - time() <=0){
            Helper_Json::formJson('该订单已过期');
        }

        Helper_Json::formJson('可以支付', 'y');
    }

    public function cancelAction(){
        $orderNo = isset($_POST['orderNo']) ? Helper_Filter::format($_POST['orderNo'], FALSE, TRUE) : '';
        // 获得订单信息
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->getOrderInfoByOrderNo($orderNo, 1, 'o_id');
        if(empty($orderInfo)){
            Helper_Json::formJson('订单信息错误');
        }

        $ret = $this->loadModel('Order', array(), 'Mall')->cancleOrder($orderInfo['o_id']);
        if(!$ret){
            Helper_Json::formJson('取消订单失败');
        }

        // 修改订单状态
        $ret = $this->loadModel('Order', array(), 'Mall')->updateOrderPayStatus($orderInfo['o_id'], 2);
        if($ret){
            Helper_Json::formJson('取消订单成功', 'y');
        }else{
            Helper_Json::formJson('订单状态修改错误');
        }

    }

    public function confirmAction(){
        $orderNo = isset($_POST['orderNo']) ? Helper_Filter::format($_POST['orderNo'], FALSE, TRUE) : '';
        // 获得订单信息
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->getOrderInfoByOrderNo($orderNo, 1, 'o_id');
        if(empty($orderInfo)){
            Helper_Json::formJson('订单信息错误');
        }

        $ret = $this->loadModel('Order', array(), 'Mall')->completeOrder($orderInfo['o_id']);
        if(!$ret){
            Helper_Json::formJson('确认订单失败');
        }

        // 修改订单状态
        $ret = $this->loadModel('Order', array(), 'Mall')->updateOrderConfirmStatus($orderInfo['o_id'], 3);
        if($ret){
            Helper_Json::formJson('确认收货成功', 'y');
        }else{
            Helper_Json::formJson('订单状态修改错误');
        }
    }
}