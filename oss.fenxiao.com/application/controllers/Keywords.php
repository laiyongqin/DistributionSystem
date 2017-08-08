<?php

/**
 * 关键字配置管理
 *
 * @author: monyyip
 * @since : 2016/8/15
 */
class KeywordsController extends BaseController {

    private $_keywordsModel;
    private $_keywordsType;
    private $_keywordsStatus;
    private $_pageSize;
    public function init() {

        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_keywordsModel     = new KeywordsModel();
        $this->_keywordsType = array(
            'text' => '文字',
//            'image' => '图片',
//            'voice' => '语音',
//            'video' => '视频',
            'news' => '图文',
//            'default' => '默认',
        );

        $this->_keywordsStatus = array(
            1 => '启用',
            -1 => '禁用',
        );

//        $this->_keywordsReplyTypes = array(
//            1 => '关键字回复',
//            2 => '关注回复',
//        );

        $this->_pageSize = 12;
    }

    // 获得关键字列表
    public function indexAction($page = 1){
        $this->initPageTitle('关键字列表');
        $type = isset($_GET['ktype']) ? Helper_Filter::format($_GET['ktype']) : '';
//        $rtype = $_GET['krtype'] ? intval($_GET['krtype']) : 0;
        $status =  isset($_GET['kstatus']) ? intval($_GET['kstatus']) : 0;
        $title = isset($_GET['ktitle']) ?  Helper_Filter::format($_GET['ktitle']) : '';
//        $kbeginTime = $_GET['kbeginTime'] ?  Helper_Filter::format($_GET['kbeginTime']) : '';
//        $kendTime = $_GET['kendTime'] ?  Helper_Filter::format($_GET['kendTime']) : '';
        $where = array();
        if(!empty($type)){
            $where['ktype'] = $type;
        }

//        if(!empty($rtype)){
//            $where['krtype'] = $rtype;
//        }

        if(!empty($status)){
            $where['kstatus'] = $status;
        }

        if(!empty($title)){
            $where['ktitle'] = $title;
        }
//
//        if(!empty($kbeginTime)){
//            $where['kbeginTime'] = $kbeginTime;
//        }
//
//        if(!empty($kendTime)){
//            $where['kendTime'] = $kendTime;
//        }

        $page    = intval($page);
        $pagination = array('page' => $page, 'pagesize' => $this->_pageSize);
        //做分页
        $total    = $this->_keywordsModel->countData($where);
        //模型和控制器
        $baseUrl = '/Property/' . $this->getRequest()->getControllerName() . '/';
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));
        $allKeywordsData = $this->_keywordsModel->getAllKeywords($where, $pagination);
        $keywordsType = Helper_Form::option($this->_keywordsType, $type, '请选择内容类型');
//        $keywordsReplyType = Helper_Form::option($this->_keywordsReplyTypes, intval($rtype), '请选择回复类型');
        $statusType = Helper_Form::option($this->_keywordsStatus, intval($status), '请选择状态');
        $this->getView()->assign(
            array(
                'keywordsType' => $keywordsType,
//                'keywordsReplyType' => $keywordsReplyType,
                'keywordsList' => $this->_keywordsType,
                'statusType' => $statusType,
//                'keyReplyType' => $this->_keywordsReplyTypes,
                'page' => $pageCode,
                'allKeywordsData' => $allKeywordsData,
                'ktitle' => $title,
            )

        );
    }

    //上传图片
    public function uploadAction() {
        $api = new Qiniu_Api('img');

        $params = array('category'=>'weixin', 'file'=>$_FILES['upload']);
        $ret = $api->uploadImg($params);
        if($ret['code'] == 1) {
            Helper_Json::formJson($ret['data'], 'y');
        } else {
            Helper_Json::formJson($ret['msg'], 'n');
        }
    }

    // 关键字编辑及修改
    public function addAction($id=0){
        $this->initPageTitle('关键字详情');
        $id = intval($id);
        if ( $id > 0 ) {
            $row = $this->_keywordsModel->getKeywordsById($id);
            if ( !$row['k_id'] )
                Helper_Json::formJson('参数错误');
        }

        if ( isset( $row['k_id'] ) ) {
            $row = $this->_keywordsModel->getKeywordsById($id);
            $this->getView()->assign('row', $row);
        } else {
            $row = array('k_title'=>'','k_keys'=>'','k_type'=>'', 'k_content'=>'','k_url'=>'', 'k_status'=>'', 'k_thumb' => '');
            $this->getView()->assign('row', $row);
        }

//        $keywordsReplyType = Helper_Form::option($this->_keywordsReplyTypes, intval($row['k_rtype']), '请选择回复类型');
        $keywordsType = Helper_Form::option($this->_keywordsType, $row['k_type'], '请选择内容类型');
        $statusType = Helper_Form::option($this->_keywordsStatus, $row['k_status'] ? intval($row['k_status']) : 1, '请选择状态');
        $this->getView()->assign(array(
            "keywordsType"      => $keywordsType,
//            'keywordsReplyType' => $keywordsReplyType,
            'statusType'  => $statusType,
            'row'     => $row,
        ));
    }

    //保存关键字
    public function saveAction() {
        $param = $this->getRequest()->getPost();
        $id = intval($param['k_id']);
        $data = array();
        $data['k_title']      = $param['k_title'];
        $data['k_keys']      = $param['k_keys'];
        $data['k_type']      = $param['k_type'];
//        $data['k_rtype']      = $param['k_rtype'];
        $data['k_content']      = $param['k_content'];
//        $data['k_des']      = $param['k_des'];
        $data['k_url']      = $param['k_url'];
        $data['k_status']      = $param['k_status'];
//        $data['k_endTime']      = $param['k_endTime'];
//        $data['k_beginTime']      = $param['k_beginTime'];
        $file = Helper_Filter::format( $this->getRequest()->getPost('file'), TRUE );
        if($file) {
            $data['k_thumb'] = $file;
        }

//        if(!empty($data['k_des'])){
//            $data['k_des'] = str_replace("\r\n", "\n", $data['k_des']);
//        }

        if(!empty($data['k_content'])){
            $data['k_content'] = str_replace("\r\n", "\n", $data['k_content']);
        }

        if ( $id > 0 ) {
            // 判断关键字是否使用过
            if(!empty($data['k_keys'])){
                $res = $this->_keywordsModel->getKeywordsByKey($data['k_keys']);
                if($res && $res['k_id'] != $id){
                    Helper_Json::formJson('已添加过此关键字','n');
                }
            }

            if($data['k_title'] == 'default'){ // 默认项只能有一个
                $where = array();
//                $where['krtype'] = $data['k_rtype'];
//                $where['ktype'] = $data['k_type'];
                $where['ktitle'] = $data['k_title'];
                $info = $this->_keywordsModel->getKeywordInfo($where);
                if($info && $info['k_id'] != $id){
                    Helper_Json::formJson('已添加过默认项'. $info['k_id'] . $id,'n');
                }
            }

            $this->_keywordsModel->saveKeywords($data, $id);
            Helper_Json::formJson('修改成功','y');
        } else {
            if(!empty($data['k_keys'])){
                $res = $this->_keywordsModel->getKeywordsByKey($data['k_keys']);
                if($res){
                    Helper_Json::formJson('已添加过此关键字','n');
                }
            }

            if($data['k_title'] == 'default'){ // 默认项只能有一个
                $where = array();
//                $where['krtype'] = $data['k_rtype'];
//                $where['ktype'] = $data['k_type'];
                $where['ktitle'] = $data['k_title'];
                if($this->_keywordsModel->getKeywordInfo($where)){
                    Helper_Json::formJson('已添加过默认项','n');
                }
            }

            $this->_keywordsModel->saveKeywords($data);
            Helper_Json::formJson('添加成功','y');
        }
    }


    //更改状态
    public function statusAction($id, $status) {
        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        $status = ($status == 1) ? -1 : 1;
        $data = array('k_status' => $status);
        $result   = $this->_keywordsModel->changeData($id,$data);
        if($result) {
            Helper_Json::formJson('操作成功', 'y');
        } else {
            Helper_Json::formJson('操作失败');
        }
    }

}

