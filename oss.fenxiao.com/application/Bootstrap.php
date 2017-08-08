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
        define('APP_DOMAIN',    $this->_config->application->host);
        define('APP_WEB',       $this->_config->application->web);
        define('APP_IMAGE_URL', $this->_config->application->image_url);

        /* 上传配置 */
        define('APP_UPLOAD_DIR', $this->_config->application->upload_url);

        /* 微信配置 */
        System_Config::initWeixinConfig();

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
        } else {
            define('APP_DEBUG',false);
            error_reporting(0);
            ini_set('display_errors','Off');
        }
    }

    /**
     * 验证权限
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initAuth(Yaf_Dispatcher $dispatcher) {
        $request_uri = $dispatcher->getRequest()->getRequestUri();

        if( ! Yaf_Session::getInstance()->has('userInfo') && strpos($request_uri, 'login') === FALSE ) {
            $loginUrl = APP_DOMAIN . "login/";
            header("Location:  {$loginUrl}");
            exit;
        } else {
            $userInfo = Yaf_Session::getInstance()->get('userInfo');
            define('A_ID',          $userInfo['a_id'] );
            define('A_REALNAME',    $userInfo['a_realname'] );
            define('A_ROLE',        $userInfo['a_role']);
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
