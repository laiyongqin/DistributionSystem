<?php

/**
 * 文件说明
 *
 * @author: moxiaobai
 * @since : 2016/4/18 15:12
 */

class OrderController extends BaseController {

    public function init() {
        $this->initViewPath();
    }

    public function indexAction() {
        //Sdk相关信息,分享，上传图片
        $jsSdk = new Open_Weixin_Js();
        $signPackage = $jsSdk->GetSignPackage();

        $this->getView()->assign('signPackage', $signPackage);
    }

    public function successAction() {

    }

    //处理订单
    public function handleAction($order) {
        //处理订单
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->dealOrder($order);

        //处理订单成功,记录支付信息
        if($orderInfo) {
            echo '处理成功';
        } else {
            echo '已经处理';
        }
        exit;
    }
}