<?php

/**
 * 单篇文章
 *
 * @author: lindexin
 * @since : 2016/08/16
 */

class ArticleController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(1=>'正常' ,2=>'禁用');

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new ArticleModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('公告列表');
        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $title  = isset($_GET['title']) ? Helper_Filter::format($_GET['title']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('title'=>$title, 'status' => $status);
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
            'title'          => $title,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }

    //表单页
    public function formAction($id = 0) {

        $this->initPageTitle('公告管理');
        if($id > 0){
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array(
                'a_id' => '',
                'a_title' => '',
                'a_content' => '',
                'a_status' => '',
                'a_desc' => '',
            );
        }


        $statusOption = Helper_Form::option($this->_status,intval($row['a_status']),'请选择状态');
        $this->getView()->assign(array(
            'row'=> $row,
            'statusOption'=> $statusOption,
        ));
    }


    public function deleteAction($id = 0){
        if(empty($id)){
            Helper_Json::formJson('参数错误');
        }

        $ret = $this->_model->delete($id);
        if($ret){
            Helper_Json::formJson('删除成功', 'y');
        }else{
            Helper_Json::formJson('删除失败');
        }
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

    public function statusAction($id = 0, $status = 1){
        if(empty($id)){
            Helper_Json::formJson('参数错误');
        }

        $data['a_status'] = $status == 1 ? 2  : 1;
        $ret = $this->_model->saveData($data, $id);
        $msg = '修改';
        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }
}