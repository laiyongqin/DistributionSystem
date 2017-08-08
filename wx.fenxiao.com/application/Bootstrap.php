<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

class Bootstrap extends Yaf_Bootstrap_Abstract {

    private $_config;

    /**
     * 初始化系统配置
     */
    public function _initConfig(Yaf_Dispatcher $dispatcher) {
        $this->_config = Yaf_Application::app()->getConfig();
    }

    /**
     * 初始化系统环境
     */
    public function _initEnvironment(Yaf_Dispatcher $dispatcher) {
        header('Content-Type: text/html; charset=UTF-8');
        date_default_timezone_set('Asia/Chongqing');

        /* 定义常量 */
        define('APP_DOMAIN',     $this->_config->application->domain_url);
        define('APP_IMAGE_URL',  $this->_config->application->image_url);

        /* 微信配置 */
//        define('APP_ID',     $this->_config->weixin->app_id);
//        define('APP_SECRET', $this->_config->weixin->app_secret);
//        define('TOKEN',      $this->_config->weixin->app_token);

        /* Session */
        Yaf_Session::getInstance()->start();
    }

    /**
     * 载入Yaf扩展
     */
    public function _initExpand(Yaf_Dispatcher $dispatcher){
        /* 扩展方法 */
        new Init_Expand();

        $showErrors = $this->_config->application->showErrors;

        /* 检测调试 */
        if(isset($_GET['DEBUG']) && $_GET['DEBUG']=='hmyj'){
            $showErrors = 1;
        }

        /* 是否开启错误报告 */
        if($showErrors) {
            define('APP_DEBUG',true);
            error_reporting(E_ALL);
            ini_set('display_errors','On');

            //开发测试模拟数据
            $userInfo = array(
                'mid'        => 1,
                'openId'     => 'opz6Fv1EQ9PfwXbhkEB3CDIKqbVY',
                'nickname'   => '林大仙',
                'avatar'     => 'http://wx.qlogo.cn/mmopen/ezTU5wa6lSpJBfeMBbYdZcicepnDEQmAjz8nbWIJ6CFRndZFmqKliatIO5A5iaVpsiaOmM4gxGO7bmvT7ibXcPcpK6Cq2n8AWwTSJ/0',
            );
            Yaf_Session::getInstance()->set('userInfo', $userInfo);
        } else {
            define('APP_DEBUG',false);
            error_reporting(0);
            ini_set('display_errors','Off');
        }
    }

    public function _initLoginAuth(Yaf_Dispatcher $dispatcher) {
        $request_uri = $dispatcher->getRequest()->getRequestUri();

        //不需要验证权限的控制器
        $withoutAuth = array('chat', 'pay', 'cron','mall','member','ajax');
        if(Yaf_Session::getInstance()->has('userInfo')) {
            //定义用户信息
            $userInfo = Yaf_Session::getInstance()->get('userInfo');

            define('IS_LOGIN', TRUE);
            define('M_ID',    $userInfo['mid']);
            define('OPEN_ID', $userInfo['openId']);
            return FALSE;
        }

        foreach($withoutAuth as $val) {
            if( strpos($request_uri, "/{$val}/") !== FALSE ){
                return FALSE;
            }
        }



        if(!Yaf_Session::getInstance()->has('userInfo') AND strpos($request_uri, 'auth') === FALSE ) {
            $redirectUrl  = APP_DOMAIN  . '/auth/index/?redirect=' . $request_uri;
            $redirectUrl  = urlencode($redirectUrl);
            $loginAuth = new Open_Weixin_Login();
            $authUrl   = $loginAuth->getLoginAuthUrl($redirectUrl);

            header("Location: {$authUrl}");
            exit;
        }
    }

    /**
     * 初始化Smarty模版
     */
    public function _initSmarty(Yaf_Dispatcher $dispatcher) {
        $config     = $this->_config->smarty->toArray();
        $requestUri = ltrim( $dispatcher->getRequest()->getRequestUri(), '/');
        $urls       = explode('/', $requestUri);

        if ( FALSE !== strpos($requestUri, '.html') ) {
            $config['compile_id'] = $requestUri;
        } elseif ( count($urls) >= 3 ) {
            //路由URL 结构大于3个，表示有模块，防止模板重名加载，在编译上文件名加上模块作为参数
            $config['compile_id'] = array_shift($urls);
        }

        $smarty = new Smarty_Adapter(null, $config);
        $dispatcher->setView($smarty);
    }
}
