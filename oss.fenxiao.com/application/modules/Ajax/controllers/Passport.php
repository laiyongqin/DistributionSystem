<?php

/**
 * 帐号登录
 *
 * @author: moxiaobai
 * @since : 2016/1/29 11:14
 */

class PassportController extends BaseController {

    //初始化
    public function init() {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //修改密码
    public function passwordAction() {
        $params   = $this->getRequest()->getPost();

        $oldPassword     = $params['oldPassword'];
        $newPassword     = $params['newPassword'];
        $confirmPassword = $params['confirmPassword'];

        if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
            Helper_Json::formJson('内容填写不完整');
        }

        $result = AdminModel::getInstance()->updateUserPassword($oldPassword, $newPassword);
        if($result['code'] == 1) {
            Yaf_Session::getInstance()->del('login');
        }

        $this->eachJson($result);
    }
}