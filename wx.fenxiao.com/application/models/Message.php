<?php

/**
 * 客服消息
 *
 * @author: moxiaobai
 * @since : 2016/8/15 10:22
 */

class MessageModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_weixin_message', 'wm_id');
    }

    /**
     * 成功支付订单通知
     *
     * @param $openId
     * @param $nickname  用户昵称
     * @param $orderNo   订单号
     * @param $moeny     订单金额
     * @param $award     提成金额
     * @return array
     */
    public function paymentOrderNotice($openId,$nickname,$orderNo,$moeny,$award) {
        $content = $this->getContentBykey('payment_order_notice');
        $search  = array('{nickname}', '{datetime}', '{orderNo}', '{money}', '{award}');
        $replace = array($nickname, date('Y-m-d H:i:s'), $orderNo, $moeny, $award);
        $content = str_replace($search, $replace, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 确认订单通知
     *
     * @param $openId
     * @param $nickname  用户昵称
     * @param $orderNo   订单号
     * @param $moeny     订单金额
     * @param $award     提成金额
     * @return array
     */
    public function confirmOrderNotice($openId,$nickname,$orderNo,$moeny,$award) {
        $content = $this->getContentBykey('confirm_order_notice');
        $search  = array('{nickname}', '{datetime}', '{orderNo}', '{money}', '{award}');
        $replace = array($nickname, date('Y-m-d H:i:s'), $orderNo, $moeny, $award);
        $content = str_replace($search, $replace, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 取消订单通知
     *
     * @param $openId
     * @param $nickname  用户昵称
     * @param $orderNo   订单号
     * @return array
     */
    public function cancleOrderNotice($openId,$nickname,$orderNo) {
        $content = $this->getContentBykey('cancle_order_notice');
        $search  = array('{nickname}', '{datetime}', '{orderNo}');
        $replace = array($nickname, date('Y-m-d H:i:s'), $orderNo);
        $content = str_replace($search, $replace, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 购买下单通知
     *
     * @param $openId
     * @param $nickname  用户昵称
     * @param $orderNo   订单号
     * @param $moeny     订单金额
     * @param $award     提成金额
     * @return array
     */
    public function purchaseOrderNotice($openId,$nickname,$orderNo,$moeny,$award) {
        $content = $this->getContentBykey('purchase_order_notice');
        $search  = array('{nickname}', '{datetime}', '{orderNo}', '{money}', '{award}');
        $replace = array($nickname, date('Y-m-d H:i:s'), $orderNo, $moeny, $award);
        $content = str_replace($search, $replace, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 成为推广人通知
     *
     * @param $openId
     * @param $nickname   用户昵称
     * @return array
     */
    public function becomePromoterNotice($openId, $nickname) {
        $content = $this->getContentBykey('become_promoter_notice');
        $content = str_replace('{nickname}', $nickname, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 通过推广二维码扫描关注
     *
     * @param $openId
     * @param $nickname  用户昵称
     * @return array
     */
    public function subscribeScanNotice($openId, $nickname) {
        $content = $this->getContentBykey('subscribe_scan_notice');
        $content = str_replace('{nickname}', $nickname, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 订阅通知
     *
     * @param $openId
     * @param $mid      会员ID
     * @return array
     */
    public function subscribeNotice($openId,$mid) {
        $content = $this->getContentBykey('subscribe_notice');
        $content = str_replace('{mid}', $mid, $content);

        return $this->sendTextMessage($openId, $content);
    }

    /**
     * 根据Key获取内容
     *
     * @param $key
     * @return mixed
     */
    private function getContentBykey($key) {
        return $this->_db->select('wm_content')->from('t_weixin_message')->where('wm_key', $key)->fetchValue();
    }

    // 替换
    public function rebuildMessage($key, $params = array()){
        $content = $this->getContentBykey($key);
        if(!empty($params)){
            foreach($params as $key => $val){
                $content = str_replace('{' . $key . '}', $val, $content);
            }
        }

        return $content;
    }

    /**
     * 发送文本消息
     *
     * @param $openId   OpenId
     * @param $content  发送内容
     * @return array
     */
    public function sendTextMessage($openId, $content) {
        $data = array(
            'touser'   => $openId,
            'msgtype'  => "text",
            'text'     => array('content'=>$content)
        );

        $weixin = new Open_Weixin_Auth;
        return $weixin->sendCustomMessage($data);
    }

    /**
     * 发送图片消息
     *
     * @param $openId
     * @param $images  媒体ID
     * @return array
     */
    public function sendImagesMessage($openId, $images) {
        $data = array(
            'touser'   => $openId,
            'msgtype'  => "image",
            'image'    => array('media_id'=>$images)
        );

        $weixin = new Open_Weixin_Auth;
        return $weixin->sendCustomMessage($data);
    }
}