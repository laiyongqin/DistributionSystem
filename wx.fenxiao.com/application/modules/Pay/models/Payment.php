<?php

/**
 * 支付成功表
 *
 * @author: moxiaobai
 * @since : 2016/4/19 19:46
 */

class PaymentModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_pay_payment', 'pp_id');
    }

    /**
     * 创建支付
     *
     * @param $orderNo         订单号
     * @param $transaction_id   第三方平台订单号
     * @param $mid              用户ID
     * @param $money            订单金额
     * @return mixed
     */
    public function createPayment($orderNo, $transaction_id, $mid, $money) {
        //判断订单是否存在
        if($this->isExistOrder($orderNo) > 0) {
            return false;
        }

        //写入支付数据
        $rows = array(
            'pp_order_no'       => $orderNo,
            'pp_transaction_id' => $transaction_id,
            'm_id'              => $mid,
            'pp_money'          => $money,
            'pp_addtime'        => date("Y-m-d H:i:s")
        );
        $ret = $this->_db->insert('t_pay_payment')->rows($rows)->execute();

        if($ret) {
            //更新订单
            $this->loadModel('Order', array(), 'Mall')->dealOrder($orderNo);

            //成为代言人
            //MemberModel::getInstance()->updateVipLevel($mid, 2);

            //增加销量
        }

        return true;
    }

    /**
     * 生成微信支付参数
     *
     * @param $oderNo
     * @param $name
     * @param $money
     * @return json数据
     * @throws WxPayException
     */
    public function getJsApiParameters($orderNo, $name, $money) {
        $input = Pay_Weixin_Pay::instanceUnifiedOrder();

        //支付金额
        $total_fee = $money * 100;

        $input->SetAppid(APP_ID);
        $input->SetMch_id(MCH_ID);
        $input->SetBody($name);
        $input->SetOut_trade_no($orderNo);
        $input->SetTotal_fee($total_fee);
        $input->SetSpbill_create_ip(Helper_Location::getIp());
        $input->SetNotify_url(APP_DOMAIN . "/pay/weixin/notify/");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid(OPEN_ID);

        $order = Pay_Weixin_Pay::unifiedOrder($input);

        $jsApiPay = Pay_Weixin_Pay::instanceJsApiPay();
        $jsApiParameters = $jsApiPay->GetJsApiParameters($order);

        return $jsApiParameters;
    }

    /**
     * 订单是否存在
     *
     * @param $order_no  订单ID
     * @return mixed
     */
    private function isExistOrder($order_no) {
        return $this->_db->select("count(*)")->from('t_pay_payment')->where('pp_order_no', $order_no)->fetchValue();
    }
}

