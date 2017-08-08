<?php

/**
 * 商品分类
 *
 * @author: monyyip
 * @since : 2016/08/13
 */
class ProfiletypeController extends BaseController {
    private $_pageSize;
    private $_model;

    private $_status = array(
        1 => '正常',
        2 => '禁用'
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new ProfiletypeModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('分类列表');
        $name        = isset($_GET['name']) ? Helper_Filter::format($_GET['name']) : '';
        $status      = isset($_GET['status']) ? intval($_GET['status']) : '';
        $page        = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('name' => $name, 'status' => $status);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));
        //数据列表
        $data           = $this->_model->getList( $where, $pagination );
        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'name'           => $name,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }

    //表单页
    public function formAction($id = 0) {
        $id = intval($id);
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array('pt_id' => 0,'pt_name' => '','pt_status' => '','pt_addtime' => date('Y-m-d H:i:s'));
        }

        $this->getView()->assign(array(
            'row'            => $row,
            'id'             => $id,
            'statusOption'   => Helper_Form::option($this->_status, intval($row['pt_status']), '请选择状态')
        ));
    }


}