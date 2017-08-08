<?php
/**
 * 用户提现
 *
 * @author: moxiaobai
 * @since : 2016/8/23 14:38
 */

class WithdrawController extends BaseController
{

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //更改状态
    public function dealAction($id) {
        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        //用户提现信息
        $info = WithdrawModel::getInstance()->getInfo($id);
        if($info['pw_status'] == 2) {
            Helper_Json::formJson('用户提现已经处理完毕');
        }

        $openId = MemberModel::getInstance()->getOpenId($info['m_id']);
        $result = RedPackModel::getInstance()->send($openId, $info['pw_money']);
        if($result['code'] == 2) {
            //更新状态
            WithdrawModel::getInstance()->updateStatus($id, 2);

            Helper_Json::formJson('发送成功', 'y');
        } else {
            Helper_Json::formJson($result['data']);
        }
    }

}