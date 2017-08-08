<?php

/**
 * 微信支付
 *
 * @author: moxiaobai
 * @since : 2016/4/18 14:52
 */

require_once 'WxPay.Api.php';
require_once 'WxPay.JsApiPay.php';

class Pay_Weixin_Pay {

    //实例化生成订单类
    public static function instanceUnifiedOrder()
    {
        return new WxPayUnifiedOrder();
    }

    //生成订单
    public static function unifiedOrder($input) {
        return WxPayApi::unifiedOrder($input);
    }

    //实例化发送红包类
    public static function instanceSendRedPack()
    {
        return new WxPaySendRedPack();
    }

    //发送红包
    public static function sendRedPack($input) {
        return WxPayApi::sendRedPack($input);
    }

    //实例化转账类
    public static function instanceTransfers() {
        return new WxPayTransfers();
    }

    //企业转账
    public static function transfers($input) {
        return WxPayApi::transfers($input);
    }

    //实例化Js Api Pay
    public static function instanceJsApiPay() {
        return new JsApiPay();
    }

    /**
     * 查询订单情况
     *
     * @param    $transaction_id  微信订单号
     * @return   boolean
     */
    public static function queryOrder($transaction_id) {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);

        $result = WxPayApi::orderQuery($input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    /**
     * 退款
     *
     * @param $transaction_id    微信订单号
     * @param $total_fee         退款金额
     * @return 成功时返回
     * @throws WxPayException
     */
    public static function payRefund($transaction_id, $total_fee) {
        $input = new WxPayRefund();
        $input->SetTransaction_id($transaction_id);
        $input->SetTotal_fee($total_fee);
        $input->SetRefund_fee($total_fee);
        $input->SetOut_refund_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetOp_user_id(WxPayConfig::MCHID);

        return WxPayApi::refund($input);
    }
}