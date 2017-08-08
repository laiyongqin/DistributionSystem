<?php

/**
 * 微信客服消息中心
 *
 * @author: monyyip
 * @since : 2016/08/16
 */

class MessageController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(1=>'正常' ,2=>'禁用');

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new MessageModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('微信客服消息');

        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('status' => $status);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data = $this->_model->getList( $where, $pagination );
        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }


    //表单页
    public function formAction($id=0) {
        $this->initPageTitle('配置');
        $id = intval($id);
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array(
                'wm_id'      => '',
                'wm_key'     => '',
                'wm_content' => '',
                'wm_title'   => '',
                'wm_memo'    => '',
                'wm_status'  => '1',
            );
        }

        // 获得菜单列表
        $this->getView()->assign(array(
            'row'=> $row,
            'statusOption'=> Helper_Form::option($this->_status, intval($row['wm_status']), '请选择状态')
        ));
    }


    public function saveAction(){
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);
        unset($post['id']);

        if($id){
            $msg = '修改';
            $ret = $this->_model->saveData($post, $id);
        }else{
            $msg = '添加';
            $ret = $this->_model->saveData($post);
        }

        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }

    //修改状态
    public function statusAction($id = 0, $status = 1){
        if(empty($id)){
            Helper_Json::formJson('参数错误');
        }

        $data['wm_status'] = $status == 1 ? 2  : 1;
        $ret = $this->_model->saveData($data, $id);
        $msg = '修改';
        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }
}