<?php

/**
 * 管理员
 *
 * @author: moxiaobai
 * @since : 2016/1/29 16:06
 */

class AdminController extends BaseController {

    private $_pageSize = 12;
    private $_model;

    public function init() {
        $this->checkRight(A_ID, A_ROLE);

        parent::init();

        //超级管理员，才能管理帐号
        if(A_ROLE == 2) {
            $this->redirect('/');
            exit;
        }

        $this->_model = new AdminModel();
    }

    public function indexAction($page=1) {
        $this->initPageTitle('后台管理员');

        $name   = isset($_GET['name']) ? Helper_Filter::format($_GET['name']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('username'=>$name);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data = $this->_model->getList( $where, $pagination );

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'   => $baseUrl,
            'name'      => $name,
            'data'      => $data,
            'total'     => $total,
            'page'      => $pageCode
        ));
    }

    //表单页
    public function formAction($id=0) {
        $id = intval($id);

        $row = array();
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }

        $this->getView()->assign(array(
            'id'        => isset($row['a_id']) ? $row['a_id'] : '',
            'username'  => isset($row['a_username']) ? $row['a_username'] : '',
            'realname'  => isset($row['a_realname']) ? $row['a_realname'] : '',
            'phone'     => isset($row['a_phone']) ? $row['a_phone'] : '',
            'openId'     => isset($row['a_openId']) ? $row['a_openId'] : ''
        ));
    }

    //修改密码表单页
    public function formPasswordAction($id=0) {
        $id = intval($id);
        $this->getView()->assign('id', $id);
    }
}