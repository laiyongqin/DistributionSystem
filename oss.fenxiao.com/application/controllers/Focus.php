<?php

/**
 * 关注自动回复配置管理
 *
 * @author: monyyip
 * @since : 2016/8/15
 */
class FocusController extends BaseController {

    private $_subscribeModel;
    private $_subscribeType;
    private $_subscribeStatus;
    private $_pageSize;
    public function init() {
        //检查权限
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_subscribeModel     = new SubscribeModel();
        $this->_subscribeType = array(
            'text' => '文字',
            'news' => '图文',
        );

        $this->_subscribeStatus = array(
            1 => '启用',
            -1 => '禁用',
        );

        $this->_subscribeCate = array(
            1 => '默认模板',
            2 => '普通模板',
        );

        $this->_pageSize = 12;
    }

    // 获得关键字列表
    public function indexAction($page = 1){
        $this->initPageTitle('关注回复列表');
        $type = isset($_GET['ktype']) ? Helper_Filter::format($_GET['ktype']) : '';
        $rcate = isset($_GET['kcate']) ? intval($_GET['kcate']) : 0;
        $status =  isset($_GET['kstatus']) ? intval($_GET['kstatus']) : 0;
        $title = isset($_GET['ktitle']) ?  Helper_Filter::format($_GET['ktitle']) : '';
        $kbeginTime = isset($_GET['kbeginTime']) ?  Helper_Filter::format($_GET['kbeginTime']) : '';
        $kendTime = isset($_GET['kendTime']) ?  Helper_Filter::format($_GET['kendTime']) : '';
        $where = array();
        if(!empty($type)){
            $where['ktype'] = $type;
        }

        if(!empty($rcate)){
            $where['kcate'] = $rcate;
        }

        if(!empty($status)){
            $where['kstatus'] = $status;
        }

        if(!empty($title)){
            $where['ktitle'] = $title;
        }
//
        if(!empty($kbeginTime)){
            $where['kbeginTime'] = $kbeginTime;
        }

        if(!empty($kendTime)){
            $where['kendTime'] = $kendTime;
        }

        $page    = intval($page);
        $pagination = array('page' => $page, 'pagesize' => $this->_pageSize);
        //做分页
        $total    = $this->_subscribeModel->countData($where);
        //模型和控制器
        $baseUrl = '/Property/' . $this->getRequest()->getControllerName() . '/';
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));
        $allsubscribeData = $this->_subscribeModel->getAllsubscribe($where, $pagination);
        $subscribeType = Helper_Form::option($this->_subscribeType, $type, '请选择内容类型');
        $subscribeCate = Helper_Form::option($this->_subscribeCate, intval($rcate), '请选择模板');
        $statusType = Helper_Form::option($this->_subscribeStatus, intval($status), '请选择状态');
        $this->getView()->assign(
            array(
                'subscribeType' => $subscribeType,
                'subscribeCate' => $subscribeCate,
                'subscribeList' => $this->_subscribeType,
                'statusType' => $statusType,
                'subscribeCateList' => $this->_subscribeCate,
                'page' => $pageCode,
                'allsubscribeData' => $allsubscribeData,
                'ktitle' => $title,
                'kendTime' => $kendTime,
                'kbeginTime' => $kbeginTime,
            )

        );
    }

    //上传图片
    public function uploadAction($id = 0) {
        $api = new Qiniu_Api('img');
        $params = array('category'=>'weixin', 'file'=>$_FILES['upload' . $id]);
        $ret = $api->uploadImg($params);
        if($ret['code'] == 1) {
            Helper_Json::formJson($ret['data'], 'y');
        } else {
            Helper_Json::formJson($ret['msg'], 'n');
        }
    }

    // 关键字编辑及修改
    public function addAction($id=0){
        $this->initPageTitle('关注回复详情');
        $id = intval($id);
        if ( $id > 0 ) {
            $row = $this->_subscribeModel->getsubscribeById($id);
            if ( !$row['s_id'] )
                Helper_Json::formJson('参数错误');
        }

        if ( isset( $row['s_id'] ) ) {
            $row = $this->_subscribeModel->getsubscribeById($id);
            $this->getView()->assign('row', $row);
        } else {
            $row = array('s_title'=>'','s_type'=>'','s_cate'=>'', 's_content'=>'','s_url'=>'', 's_status'=>'', 's_beginTime' => '', 's_endTime' => '');
            $this->getView()->assign('row', $row);
        }

        if($row['s_type'] == 'news'){
            if(!empty($row['s_content'])){
                $row['s_content'] = json_decode($row['s_content'], TRUE);
            }
        }

        if(is_array($row['s_content'])){
            $count = count($row['s_content']);
        }else{
            $count = 0;
        }

        $subscribeCate = Helper_Form::option($this->_subscribeCate, intval($row['s_cate']), '请选择模板');
        $subscribeType = Helper_Form::option($this->_subscribeType, $row['s_type'], '请选择内容类型');
        $statusType = Helper_Form::option($this->_subscribeStatus, $row['s_status'] ? intval($row['s_status']) : 1, '请选择状态');
        $this->getView()->assign(array(
            "subscribeType"      => $subscribeType,
            'subscribeCate' => $subscribeCate,
            'statusType'  => $statusType,
            'row'     => $row,
            'count'   => $count,
        ));
    }

    //保存关键字
    public function saveAction() {
        $param = $this->getRequest()->getPost();
        $id = intval($param['s_id']);
        $data = array();
        $data['s_title']      = $param['s_title'];
//        $data['s_keys']      = $param['s_keys'];
        $data['s_type']      = $param['s_type'];
        $data['s_cate']      = $param['s_cate'];
        $data['s_content']      = $param['s_content'];
//        $data['k_des']      = $param['k_des'];
        $data['s_url']      = $param['s_url'];
        $data['s_status']      = $param['s_status'];
        $data['s_endTime']      = $param['s_endTime'];
        $data['s_beginTime']      = $param['s_beginTime'];
        $s_order = $param['s_order'];
        $file = Helper_Filter::format( $this->getRequest()->getPost('file'), TRUE );
        if($file) {
            $data['s_thumb'] = $file;
        }

        if(!empty($data['s_content'])){
            $data['s_content'] = str_replace("\r\n", "\n", $data['s_content']);
        }

        $content = array();
        if($data['s_type'] == 'news'){
            for($i = 0; $i < count($data['s_title']); $i++){
                if(empty($data['s_title'][$i])){
                    Helper_Json::formJson('请输入标题' . ($i > 0 ? $i : ''),'n');
                }

                if(empty($data['s_url'][$i])){
                    Helper_Json::formJson('请输入链接' . ($i > 0 ? $i : ''),'n');
                }

                if(empty($data['s_thumb'][$i])){
                    Helper_Json::formJson('请上传图片' . ($i > 0 ? $i : ''),'n');
                }

                if(empty($s_order[$i]) || !is_numeric($s_order[$i])){
                    Helper_Json::formJson('请输入排序号' . ($i > 0 ? $i : ''),'n');
                }

                $content[] = array(
                    's_title' => trim($data['s_title'][$i]),
                    's_url' => trim($data['s_url'][$i]),
                    's_thumb' => trim($data['s_thumb'][$i]),
                    's_order' => trim($s_order[$i]),
                );
            }

            // 按数组中的排序号排序
            $content = Helper_Array::sort($content, 's_order');
            $data['s_content'] = json_encode($content);
            $data['s_title'] = '';
            $data['s_thumb'] = '';
            $data['s_url'] = '';
            if($data['s_endTime'] < $data['s_beginTime']){
                Helper_Json::formJson('结束时间不能小于开始时间','n');
            }
        }else{
            $data['s_title'] = trim($data['s_title'][0]);
            $data['s_thumb'] = trim($data['s_thumb'][0]);
            $data['s_url'] = trim($data['s_url'][0]);
        }

        if ( $id > 0 ) {
            if($data['s_cate'] == 1){ // 默认项只能有一个
                $where = array();
                $where['kcate'] = $data['s_cate'];
                $info = $this->_subscribeModel->getsubscribeInfo($where);
                if($info && $info['s_id'] != $id){
                    Helper_Json::formJson('已添加过默认模板','n');
                }else{
                    if($data['s_status'] == -1){
                        Helper_Json::formJson('默认模板不可禁用','n');
                    }
                }
            }

            $this->_subscribeModel->savesubscribe($data, $id);
            Helper_Json::formJson('修改成功','y');
        } else {
            if($data['s_cate'] == 1){ // 默认项只能有一个
                $where = array();
                $where['kcate'] = $data['s_cate'];
                if($this->_subscribeModel->getsubscribeInfo($where)){
                    Helper_Json::formJson('已添加过默认模板','n');
                }else{
                    if($data['s_status'] == -1){
                        Helper_Json::formJson('默认模板不可禁用','n');
                    }
                }
            }

            $data['s_status'] = 1;
            $this->_subscribeModel->savesubscribe($data);
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
        $data = array('s_status' => $status);
        $row = $this->_subscribeModel->getsubscribeById($id);
        if(empty($row)){
            Helper_Json::formJson('缺失参数');
        }else{
            if($row['s_cate'] == 1){
                // 默认项
                if($data['s_status'] == -1){
                    Helper_Json::formJson('不可禁用默认模板');
                }
            }
        }

        $result   = $this->_subscribeModel->changeData($id,$data);
        if($result) {
            Helper_Json::formJson('操作成功', 'y');
        } else {
            Helper_Json::formJson('操作失败');
        }
    }

}

