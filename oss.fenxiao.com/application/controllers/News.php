<?php

/**
 * 新闻列表
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class NewsController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(
        1 => '正常',
        2 => '禁用'
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new NewsModel();
        $this->_pageSize = 12;
    }

    private $_menuList = array(
        'product' => '产品详情',

    );

    public function indexAction($page=1) {
        $this->initPageTitle('新闻列表');

        $pid    = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $title  = isset($_GET['title']) ? Helper_Filter::format($_GET['title']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('title'=>$title, 'pid' => $pid,'status' => $status);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        $category = NewscategoryModel::getInstance()->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), intval($pid), '请选择分类');

        //数据列表
        $data = $this->_model->getList( $where, $pagination );


        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'title'          => $title,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'categoryOption' => $categoryOption,
            'cateList'       => NewscategoryModel::getInstance()->getListArr(),
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }

    //表单页
    public function formAction($id=0) {

        $this->initPageTitle('新闻详情');
        $id = intval($id);
        $row = array();
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array(
                'n_id' => '',
                'nc_id' => '',
                'n_title' => '',
                'n_cover' => '',
                'n_content' => '',
                'n_des' => '',
                'n_sort' => 1,
                'n_status' => '',
                'n_addtime' => '',
                'nc_type' => '',
            );
        }
        $category = NewscategoryModel::getInstance()->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), intval($row['nc_id']), '请选择分类');

        $this->getView()->assign(array(
            'row'=> $row,
            'menuList'=> $this->_menuList,
            'categoryOption'=> $categoryOption,

            'statusOption'=> Helper_Form::option($this->_status, intval($row['n_status']), '请选择状态')
        ));
    }


    //上传图片
    public function uploadAction() {
        $api = new Qiniu_Api('img');
        $params = array('category'=>'news', 'file'=>$_FILES['upload']);
        $ret = $api->uploadImg($params);
        if($ret['code'] == 1) {
            Helper_Json::formJson($ret['data'], 'y');
        } else {
            Helper_Json::formJson($ret['msg'], 'n');
        }
    }

    public function saveAction(){
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);

        unset($post['file']);
        unset($post['id']);

        if($id){
            $msg = '修改';
            $ret = $this->_model->saveData($post, $id);
        }else{
            $msg = '添加';
            $post['n_addtime'] = date('Y-m-d H:i:s');
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

        $data['n_status'] = $status == 1 ? 2  : 1;
        $ret = $this->_model->saveData($data, $id);
        $msg = '修改';
        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
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

    public function changeMultiAction(){
        $ids = isset($_POST['ids']) ? Helper_Filter::format($_POST['ids']) : '';
        if(empty($ids)){
            Helper_Json::formJson('未选择项');
        }

        $ret = $this->_model->updateStatus($ids);
        $msg = '修改';
        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }

    /*
     * 预览商品
     * @param $id 商品id
     */
    public function viewAction(){

        $id      = intval($_GET['id']);
        $openId  = AdminModel::getInstance()->getOpendId(A_ID);
        if(!$openId){
            Helper_Json::formJson('OpenId不存在', 'n');
        }
        if($id > 0){
            $row = $this->_model->getInfo($id);
            if(empty($row['n_id'])){
                Helper_Json::formJson('参数错误');
            }
        }
        $content = $row['n_title'] . "\n\n";
        $content .= "<a href='".APP_WEB.'mall/news/details/id/'.$row['n_id']."/'>点击链接预览文章效果</a>\n\n";

        //第一个参数OPENDID 第二个内容
        $ret =  MessageModel::getInstance()->sendTextMessage($openId, $content);

        if($ret['errmsg']=='ok'){
            Helper_Json::formJson('推送商品成功', 'y');
        }elseif ($ret['errcode']==errcode){
            Helper_Json::formJson('OpenId错误请检查后重试', 'n');
        }elseif ($ret['errcode']==45015){
            Helper_Json::formJson('请访问网站后重试', 'n');
        }else{
            Helper_Json::formJson('推送商品失败', 'n');
        }
    }
}