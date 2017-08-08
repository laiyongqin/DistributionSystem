<?php

/**
 * 商品管理
 *
 * @author: monyyip
 * @since : 2016/08/12
 */
class ProductController extends BaseController {
    private $_pageSize;
    private $_model;
    private $_categoryModel;
    private $_profileTypeModel;
    private $_profileModel;
    private $_profileType;
    private $_productPic;
    private $_status = array(
        1 => '正常',
        2 => '禁用'
    );

    private $_menuList = array(
        'basic'           => '基本信息',
        'profile'         => '套餐配置',
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new ProductModel();
        $this->_categoryModel = new CategoryModel();
        $this->_profileModel = new ProfileModel();
        $this->_profileTypeModel = new ProfiletypeModel();
        $this->_productPic = new ProductPicModel();
        // 获得该商品下所有套餐类型
        $this->_profileType = $this->_profileTypeModel->getTypeList(array('status' => 1));

        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('分类列表');
        $name        = isset($_GET['name']) ? Helper_Filter::format($_GET['name']) : '';
        $pid         = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
        $status      = isset($_GET['status']) ? intval($_GET['status']) : '';
        $page        = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('name' => $name, 'pid' => $pid, 'status' => $status);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));
        $category = $this->_categoryModel->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), $pid, '请选择分类');
        //数据列表
        $data           = $this->_model->getList( $where, $pagination );
        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'name'           => $name,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'category'       => $this->_categoryModel->getCategory(),
            'categoryOption' => $categoryOption,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }

    //表单页
    public function formAction($id = 0) {
        $this->initPageTitle('添加商品');
        $id = intval($id);
        $ppType = array();
        $ppList = array();
        $picRow = array();
        $count = 0;
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
            // 获得该商品下所有的套餐
            $ppList = $this->_profileModel->getList(array('p_id' => $id));
            if($ppList){
                foreach($ppList as $val){
                    $ppType[$val['pt_id']] = $val['pt_id'];
                }
            }

            //主图
            $picRow = $this->_productPic->getPicById($id);
            if(is_array($picRow)){
                $count = count($picRow);
            }else{
                $count = 0;
            }
        }else{
            $row = array('p_id' => 0,'pc_id' => 0,'p_rate' => '','p_title' => '','p_cover' => '','p_stock' => '','p_content' => '','p_sales'=>'','p_original_price' => '','p_event_price' => '','p_sort' => '','p_status' => '');
        }

        // 产品规格

        $profileTypeOption = Helper_Form::option($this->_profileType, '', '请选择产品规格');
        $category = $this->_categoryModel->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), intval($row['pc_id']), '请选择分类');
        $this->getView()->assign(array(
            'categoryOption'    => $categoryOption,
            'row'               => $row,
            'id'                => $id,
            'ppType'            => $ppType,
            'ppList'            => $ppList,
            'ppCount'           => $ppList ? count($ppList) : 0,
            'profileType'       => $this->_profileType,
            'profileTypeOption' => $profileTypeOption,
            'menuList'          => $this->_menuList,
            'picRow'            => $picRow,
            'count'             => $count,
            'statusOption'      => Helper_Form::option($this->_status, intval($row['p_status']), '请选择状态')
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

    //上传图片
    public function upload2Action() {
        $api = new Qiniu_Api('img');
        $params = array('category'=>'product', 'file' => $_FILES['uploadCover']);
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
        $productProfile = array();
        // 判断商品组合
        if(isset($_POST['pp_id'])){
            foreach($_POST['pp_id'] as $i => $val){
                foreach($val as $j => $v){
                    if(empty($_POST['pp_name'][$i][$j])){
                        Helper_Json::formJson('请填写价格类型名称', 'n');
                    }

                    if(!empty($_POST['pp_stock'][$i][$j]) && !is_numeric($_POST['pp_stock'][$i][$j])){
                        Helper_Json::formJson('请正确填写库存', 'n');
                    }


                    $productProfile[] = array(
                        'pp_id' => $_POST['pp_id'][$i][$j],
                        'pt_id' => $i,
                        'pp_name' => $_POST['pp_name'][$i][$j],
                        'pp_stock' => $_POST['pp_stock'][$i][$j],
                    );
                }
            }
        }



        $data = array(
            'pc_id' => $post['pc_id'],
            'p_title' => $post['p_title'],
            'p_cover' => $post['p_cover'],
            'p_stock' => $post['p_stock'],
            'p_content' => $post['p_content'],
            'p_rate' => $post['p_rate'],
            'p_original_price' => $post['p_original_price'],
            'p_event_price' => $post['p_event_price'],
            'p_sort' => $post['p_sort'],
        );

        $file = Helper_Filter::format( $this->getRequest()->getPost('file'), TRUE );
        if($file) {
            $picData['pp_url'] = $file;
        }

        $picData['pp_order'] = isset($post['pp_order']) ? $post['pp_order'] : '';
        $content = array();

        if($id){
            $msg = '修改';
            $data['p_updateTime'] = date('Y-m-d H:i:s');
            $ret = $this->_model->saveData($data, $id);

            //保存商品图片
            if(isset($picData['pp_url'])){
                for($i = 0; $i < count($picData['pp_url']); $i++){
                    $content[] = array(
                        'pp_url'   => trim($picData['pp_url'][$i]),
                        'pp_order' => intval($picData['pp_order'][$i]),
                        'p_id'     => $id
                    );
                }
            }


//            unset($content[0]);
            $this->_productPic->deletePic($id);
            foreach($content as $v){
                $this->_productPic->savePic($v);
            }

            $this->addProductProfile($productProfile, $id);
        }else{
            $msg = '添加';
            $data['p_addTime'] = date('Y-m-d H:i:s');
            $ret = $this->_model->saveData($data);
            //保存商品图片
            if(isset($picData['pp_url'])) {
                for ($i = 0; $i < count($picData['pp_url']); $i++) {
                    $content[] = array(
                        'pp_url' => trim($picData['pp_url'][$i]),
                        'pp_order' => intval($picData['pp_order'][$i]),
                        'p_id' => $ret
                    );
                }
            }
//            unset($content[0]);
            $this->_productPic->deletePic($ret);
            foreach($content as $v){
                $this->_productPic->savePic($v);
            }

            $this->addProductProfile($productProfile, $ret);
        }
        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }

    public function addProductProfile($data, $p_id){
        $profileModel = $this->_profileModel;
        $ppIdList = array();
        if(!empty($data)){
            foreach($data as $val){
                $val['p_id'] = $p_id;
                $pp_id = intval($val['pp_id']);
                if($profileModel->getInfo($pp_id)){
                    // 更新
                    $val['pp_editTime'] = date('Y-m-d H:i:s');
                    $profileModel->saveData($val, $pp_id);
                }else{
                    unset($val['pp_id']);
                    $val['pp_editTime'] = date('Y-m-d H:i:s');
                    $val['pp_addTime'] = date('Y-m-d H:i:s');
                    $pp_id = $profileModel->saveData($val);
                }

                $ppIdList[] = $pp_id;
            }
        }else{
            $ppIdList[] = -1;
        }

        // 清除所有该商品下非套餐列表的套餐
        if($ppIdList){
            $profileModel->clearList($p_id, $ppIdList);
        }
    }

    public function addProfileAction(){
        $pt_id = isset($_POST['pt_id']) ? intval($_POST['pt_id']) : 0;
        $count = isset($_POST['ppCount']) ? intval($_POST['ppCount']) : 0;
        $ptInfo = $this->_profileTypeModel->getInfo($pt_id);
        $this->getView()->assign('pt_id', $pt_id);
        $this->getView()->assign('ptInfo', $ptInfo);
        $this->getView()->assign('count', $count);
        $this->getView()->display('/product/load.html');
        die;
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
            if(empty($row['p_id'])){
                Helper_Json::formJson('参数错误');
            }
        }
        $content = $row['p_title'] . "\n\n";
        $content .= "<a href='".APP_WEB.'mall/product/details/id/'.$row['p_id']."/'>点击链接预览商品效果</a>\n\n";

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