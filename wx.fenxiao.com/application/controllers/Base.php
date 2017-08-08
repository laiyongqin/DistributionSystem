<?php

/**
 * 一些公用的控制器方法,需要继承此类.
 * 
 * @author moxiaobai
 * @since  2015-03-21
 */
Abstract Class BaseController extends ExpandController {

    /**
     * 初始化页面标题
     * @param string $title
     */
    protected function initPageTitle($pageTitle='') {
        $this->getView()->assign('pageTitle',$pageTitle);
    }

    /**
     * 自动设置所在模块的模板路径
     */
    protected function initViewPath(){
        $this->setViewPath( APP_PATH . '/application/modules/' . $this->getModuleName() . '/views/');
    }

    //判断是否是Ajax请求，防止非法请求
    protected function isAjaxRequest() {
        if(! $this->getRequest()->isXmlHttpRequest()) {
            Helper_Json::formJson('非法请求!', 'n');
        }
    }

    //检查是否登录
    protected function isLogin() {
        if(!defined('M_ID')) {
            Helper_Json::formJson('请先登录!', 'n');
        }
    }

    /**
     * 载入modules下的model类(注意大小写)
     *
     * @param string $class_name   类名称
     * @param array  $param        参数
     * @param string $module_name 模块名称
     * @return
     */
    protected function loadModel($class_name,$param=array(),$module_name=false){
        //return module name;
        if(!$module_name){
            $module_name = $this->getModuleName();
        }
        $class_name  = ucwords($class_name);

        $key   = "{$module_name}[{$class_name}]";
        $model = Yaf_Registry::get($key);

        //Is model has instance.
        if ( ! $model ) {
            //Is model file exists.
            $model_file = APP_PATH . '/application/modules/' . $module_name . '/models/' . $class_name.'.php';
            if ( ! file_exists( $model_file ) )
                exit('Model file not exists: ' . $model_file);

            require $model_file;

            $code_str = "";
            foreach ($param as $key => $value) {
                $code_str.='$param['.$key.'],';
            }
            if($code_str!=""){
                $code_str=substr($code_str,0,-1);
            }
            $class_name = $class_name . 'Model';
            $code_str    = '$model = new '.$class_name.'('.$code_str.');';
            eval($code_str);
            Yaf_Registry::set($key, $model);

            if( ! defined('MODULES_NAME') ) {
                define('MODULES_NAME', $module_name);
            }
        }
        return $model;
    }
}