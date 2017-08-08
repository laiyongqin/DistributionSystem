<?php

/**
 * 登录验证
 *
 * @author: moxiaobai
 * @since : 2016/3/7 17:24
 */

class AuthController extends BaseController {

    public function indexAction() {
        $code      = isset($_GET['code']) ? $_GET['code'] : '';
        $redirect  = isset($_GET['redirect']) ? $_GET['redirect'] : '/';
        if($code) {
            $loginAuth = new Open_Weixin_Login();
            $userInfo  = $loginAuth->getUserInfo($code);
            $userInfo  = json_decode($userInfo, true);

            //绑定数据
            $result = MemberModel::getInstance()->login($userInfo);
            if(!$result) {
                $this->redirect('/');
            } else {
                $this->redirect($redirect);
            }
            exit;
        } else {
            $this->redirect('/');
            exit;
        }
    }
}