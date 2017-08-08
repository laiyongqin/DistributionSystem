<?php

/**
 * 支付页面
 *
 * @author: monyyip
 * @since : 2016/8/19 9:50
 */

class PaymentController extends BaseController
{
    //统计支付页面
    public function orderAction($orderNo = ''){
        // 获得订单信息
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->getOrderInfoByOrderNo($orderNo, 1, 'm_id, p_title, pp_title, p_price,o_pay_status,o_payment_amount,o_number');
        if(empty($orderInfo)){
            $this->redirect('/');
        }

        //如果已经支付，跳转到订单列表
        if($orderInfo['o_pay_status'] == 3) {
            $this->redirect('/mall/order/index/');
        }

        // 地址信息
        $addressInfo = $this->loadModel('Address', array(), 'Member')->getAddress($orderInfo['m_id']);

        // 订单信息
        $jsSdk = new Open_Weixin_Js();
        $signPackage = $jsSdk->GetSignPackage();
        $this->setViewPath( APP_PATH . '/application/modules/Mall/views/');
        $this->getView()->assign(
            array(
                'orderInfo'   => $orderInfo,
                'addressInfo' => $addressInfo,
                'signPackage' => $signPackage,
                'orderNo'     => $orderNo,
            )
        );

        $this->getView()->display('product/order.html');
        die;
    }
}