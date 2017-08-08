<?php

/**
 * 一些公用的控制器方法,需要继承此类.
 *
 * @author moxiaobai
 * @since  2015-03-21
 */
Abstract Class BaseController extends ExpandController {

    protected $_menuInfo = array();

    public function init(){

        //顶级菜单
        if ( ! defined('A_ROLE') )  {
            $this->redirect('/login');
            exit();
        }

        //菜单
        if ( A_ROLE == 1 ) {
            $menuList = MenuModel::getInstance()->getMenuList();
        } else {
            $menuList = MenuModel::getInstance()->getRightMenuList();
        }
        $this->getView()->assign('menuLeftList', $menuList);
    }

    /**
     * 初始化页面标题
     * @param string $title
     */
    protected function initPageTitle($title='') {
        $pageTitle = "管理系统-{$title}";
        $this->getView()->assign(array(
            'pageTitle'   => $pageTitle,
            'breadTitle'  => $title
        ));
    }

    /**
     * 初始化表单token
     *
     * @param $name
     * @return string
     */
    protected function initFormToken($name) {
        if(! Yaf_Session::getInstance()->has($name)) {
            $token = Helper_Code::getRandCode(12);
            Yaf_Session::getInstance()->set($name, $token);
        } else {
            $token = Yaf_Session::getInstance()->get($name);
        }
        return $token;
    }

    //判断是否是Ajax请求，防止非法请求
    protected function isAjaxRequest() {
        if(! $this->getRequest()->isXmlHttpRequest()) {
            Helper_Json::formJson('非法请求!', 'n');
        }
    }

    //检查是否登录
    protected function isLogin() {
        if(!defined('A_ID')) {
            Helper_Json::formJson('请先登录!', 'n');
        }
    }

    //输出JSON数据
    protected function eachJson($result) {
        if($result['code'] == 1) {
            Helper_Json::formJson($result['data'], 'y');
        } else {
            Helper_Json::formJson($result['data'], 'n');
        }
    }

    /**
     * 设置分页
     *
     * @param int $page
     * @param int $per
     * @param $total
     * @param $base_url
     * @param null $ajax_function
     * @param bool $get_method
     * @return string
     */
    protected function setPage($page=1, $per=10, $total, $base_url, $ajax_function=null, $get_method=false) {
        $page = intval($page);
        $page = $page == 0 ? 1 : $page;

        $base_url = rtrim($base_url, '/');

        if ( ($page - 1) * $per > $total ) {
            $this->redirect( $base_url );
        }

        if($get_method == false) {
            $url = $base_url . '/page/';
        } else {
            $url = $base_url . '?page=';
        }
        $obj = new Page(array(
            'total'     => $total,
            'perpage'   => $per,
            'nowindex'  => $page,
            'url'       => $url,
        ), true);

        if ($ajax_function) {
            $obj->open_ajax($ajax_function);
        }

        $obj->current_class = 'current';
        $pagecode = $obj->show(7);
        return $pagecode;
    }

    /**
     * 显示404页面
     */
    function show404($modules = '') {
        Header("HTTP/1.1 404 Not Found");
        if($modules){
            $this->getView()->setScriptPath(APP_PATH. '/application/views/' . $modules . '/');
        }else{
            $this->getView()->setScriptPath(APP_PATH. '/application/views/');
        }

        $this->getView()->display('error/error.html');
        exit();
    }

    /**
     * 检查用户权限
     *
     * @param bool $uid   用户ID
     * @param bool $role  用户权限
     * @return bool       没有权限返回bool值，有权限返回菜单信息
     */
    protected function checkRight($uid=false, $role=false) {
        $requestUri = $this->getRequest()->getRequestUri();
        $menuInfo   = System_Right::getMeunInfoByUri($requestUri);

        if($menuInfo) {
            $right = System_Right::checkRight($uid, $menuInfo['m_id']);
            if($right || $role == 1) {
                $this->_menuInfo = $menuInfo;
            } else {
                echo '无权限，请联系技术部';
                exit;
            }
        } else {
            echo '无权限，请联系技术部';
            exit;
        }

        return true;
    }
}