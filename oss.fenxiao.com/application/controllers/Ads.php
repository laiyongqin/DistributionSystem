<?php

/**
 * 广告管理
 *
 * @author: lindexin
 * @since : 2016/07/18
 */

class AdsController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(1=>'正常' ,2=>'禁用');

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new AdsModel();
        $this->_pageSize = 12;
    }


    public function indexAction($page=1) {
        $this->initPageTitle('广告列表');

        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $title  = isset($_GET['title']) ? Helper_Filter::format($_GET['title']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('title'=>$title,'status' => $status);
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

    //上传图片
    public function uploadAction() {
        $api = new Qiniu_Api('img');
        $params = array('category'=>'product', 'file' => $_FILES['upload']);
        $ret = $api->uploadImg($params);
        if($ret['code'] == 1) {
            Helper_Json::formJson($ret['data'], 'y');
        } else {
            Helper_Json::formJson($ret['msg'], 'n');
        }
    }

    //表单页
    public function formAction($id=0) {

        $this->initPageTitle('广告');
        $id = intval($id);
        $row = array();
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array(
                'a_id' => '',
                'a_title' => '',
                'a_alias' => '',
                'a_picture' => '',
                'a_link' => '',
                'a_status' => 1,
                'a_addtime' => '',
            );
        }
        $this->getView()->assign(array(
            'row'=> $row,
            'id'=> $id,
            'statusOption'=> Helper_Form::option($this->_status, intval($row['a_status']), '请选择状态')
        ));
    }

    //修改状态
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