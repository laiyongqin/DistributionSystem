<?php

/**
 * 发送红包
 *
 * @author: moxiaobai
 * @since : 2016/8/20 17:15
 */


class RedPackModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_red_pack', 'rp_id');
    }

    /**
     * 发送红包
     *
     * @param $amout   红包金额
     * @param $openId  Open_ID
     * @return int
     */
    public function send($openId, $amout) {
        //发送红包
        $orderNo = '1227754902' . date('YmdHis') . mt_rand(0,10);
        $amout   = $amout * 100;

        $input = Pay_Weixin_Pay::instanceSendRedPack();
        $input->SetMch_billno($orderNo);
        $input->SetSend_name('上善网络');
        $input->SetOpen_ID($openId);
        $input->SetTotal_amount($amout);
        $input->SetTotal_num(1);
        $input->Set_wishing('红包提现');
        $input->SetAct_name('红包提现');
        $input->Set_remark('代言人推广奖励');

        $result = WxPayApi::sendRedPack($input);
        if($result['result_code'] == 'SUCCESS') {
            $status = 2;
            $msg    = '红包发送成功';
        } else {
            $status = 1;
            $msg    = $result['err_code_des'];
        }

        //记录日志
        $this->addLog($openId,$amout,$orderNo,$status, $result);

        return $this->result($status, $msg);
    }

    private function addLog($openId, $amout, $orderNo, $status, $log) {
        $data = array(
            'openID'       => $openId,
            'rp_amout'     => ($amout/100),
            'rp_order_sn'  => $orderNo,
            'rp_status'    => $status,
            'rp_log'       => json_encode($log),
            'rp_addtime'   => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_red_pack')->rows($data)->execute();
    }
}