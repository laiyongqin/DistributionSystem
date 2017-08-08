<?php

/**
 * 网页授权
 
 * @author: moxiaobai(mlkom@live.com)
 * @since : 2015-06-22
 */

class Open_Weixin_Login {

    private $appId;
    private $appSecret;

    public function __construct() {
        $this->appId        = APP_ID;
        $this->appSecret   = APP_SECRET;
    }

    /**
     * 获取授权登陆地址：如果用户同意授权，页面将跳转至 redirect_uri/?code=CODE&state=STATE
     *
     * @param $redirect 回掉地址
     * @param $scope    授权作用域:snsapi_base不弹出授权页面
     * @return string
     */
    public function getLoginAuthUrl($redirect, $scope = "snsapi_userinfo") {
        $authUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appId}&redirect_uri=$redirect&response_type=code&scope={$scope}&state=1#wechat_redirect";
        return $authUrl;
    }

    /**
     * 获取用户信息
     *
     * @param $code
     * @return mixed
     */
    public function getUserInfo($code) {
        $info = $this->getAccessToken($code);

        $accessToken = $info['access_token'];
        $openId      = $info['openid'];

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openId}&lang=zh_CN";
        $http    =  Helper_Http::factory($url, Helper_Http::TYPE_CURL );
        $result  =  $http->get();

        return $result;
    }


    /**
     * 通过code换取网页授权access_token
     *
     * @param $code
     * @return mixed
     */
    private function getAccessToken($code) {
        //获取access_token
        $url     =  "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";
        $http    =  Helper_Http::factory($url, Helper_Http::TYPE_CURL );
        $result  =  $http->get();

        return $info    = json_decode($result, true);
    }
}