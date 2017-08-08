<?php

/**
 * 申请提现
 *
 * @author: lindexin
 * @since : 2016/08/20
 */


class CashController extends BaseController {

    //初始化
    private function init(){
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //提交申请
    public function saveAction() {

        $data  = $this->getRequest()->getPost();
        $id    = M_ID;
        unset($data['action']);
        $data['pw_money'] = floatval($data['pw_money']);
        if(empty($data['pw_money'])){
            Helper_Json::formJson('提现金额不能为空');
        }

        //为提现金额
        $withdrawMoney = $this->loadModel('MemberWealth',array(),'Member')->getWithdraw($id);
        if($data['pw_money'] > $withdrawMoney){
            Helper_Json::formJson('申请提现金额不能大于账户可提现金额');
        }

        $row = array(
            'm_id' => $id,
            'pw_money' => $data['pw_money'],
            'pw_status' => 1,
            'pw_addtime' => date('Y-m-d H:i:s',time())
        );

        //单日申请提现次数
        $cashNum     = $this->loadModel('PayWithdraw',array(),'Pay')->getDayCount($id);//单日提现次数
        $withdrawNum = ConfigModel::getInstance()->getValueByKey('withdraw_times');//每日最多提现次数

        if($cashNum > $withdrawNum){
            Helper_Json::formJson('今天的提现次数已用完');
        }
        //当日申请提现金额
        $withdrawMoney = ConfigModel::getInstance()->getValueByKey('withdraw_money');//每日最多提现金额
        if($data['pw_money'] > $withdrawMoney){
            Helper_Json::formJson('提现金额超过限制');
        }

        $ret = $this->loadModel('PayWithdraw',array(),'Pay')->saveData($row);
        if($ret){
            //操作财富表
            $this->loadModel('MemberWealth',array(),'Member')->updateWithdraw($id,'-'.$data['pw_money']);

            Helper_Json::formJson('申请提现成功', 'y');
        }


    }
}