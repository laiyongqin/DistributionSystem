<?php

/**
 * 通知日志
 *
 * @author: moxiaobai
 * @since : 2016/4/19 10:45
 */

class NotifyLogModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_pay_payment', 'pp_id');
    }

    /**
     * 插入日志
     *
     * @param $platform        支付平台类型
     * @param $out_trade_no    平台订单号
     * @param $transaction_id  第三方平台订单号
     * @param $data            日志数据
     * @return mixed
     */
    public function addNotifyLog($platform, $out_trade_no, $transaction_id, $data) {
        $rows = array(
            'nl_platform'    => $platform,
            'out_trade_no'   => $out_trade_no,
            'transaction_id' => $transaction_id,
            'nl_data'        => json_encode($data),
            'nl_datetime'    => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_notify_log')->rows($rows)->execute();
    }
}
