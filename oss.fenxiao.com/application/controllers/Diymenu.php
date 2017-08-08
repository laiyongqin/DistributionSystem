<?php

/**
 * 微信自定义菜单
 *
 * @author: monyyip
 * @since : 2016/08/16
 */

class DiymenuController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(1=>'正常' ,2=>'禁用');

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new DiymenuModel();
        $this->_pageSize = 12;
    }


    public function indexAction() {
        $this->initPageTitle('微信自定义菜单配置');

        //搜索条件
        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $pid    = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

        //数据列表
        $where      = array('pid' => $pid, 'status'=>$status);
        $data = $this->_model->getList( $where );

        //模版赋值
        $this->getView()->assign(array(
            'data'           => $data,
            'menuList'       => ($list = $this->_model->getMenuMap()) ?  $list : array(),
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态'),
            'menuOption'     => Helper_Form::option($this->_model->getMenuMap(), intval($pid))
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
                'wm_id'     => '',
                'wm_pid'    => '',
                'wm_type'   => '',
                'wm_key'    => '',
                'wm_name'   => '',
                'wm_status' => 1,
                'wm_sort'   => 1,
            );
        }

        // 获得菜单列表
        $menuOption = Helper_Form::option($this->_model->getListByPid(), intval($row['wm_pid']), '请选择上级菜单');
        $typeOption = Helper_Form::option($this->_model->getType(), $row['wm_type'],     '请选择菜单类型');
        $this->getView()->assign(array(
            'row'           => $row,
            'menuOption'    => $menuOption,
            'typeOption'    => $typeOption,
            'statusOption'  => Helper_Form::option($this->_status, intval($row['wm_status']), '请选择状态')
        ));
    }

    public function saveAction(){
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);
        unset($post['id']);
        if($post['wm_pid'] > 0){
            // 判断菜单类型和菜单key是否有
            if(empty($post['wm_type'])){
                Helper_Json::formJson('请填写菜单类型');
            }

            if(empty($post['wm_key'])){
                Helper_Json::formJson('请填写菜单键值');
            }
        }

        if($id){
            $msg = '修改';
            $ret = $this->_model->saveData($post, $id);
        }else{
            $msg = '添加';
            $post['wm_addtime'] = date('Y-m-d H:i:s');
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

    //生成菜单
    public function createAction() {
        $list = $this->_model->getList( array('status'=>1) );
        if(!$list) {
            Helper_Json::formJson('请先添加微信菜单');
        }

        $menu = array();
        foreach($list as $k => $row) {
            if($row['wm_pid'] == 0) {
                $key = $row['wm_id'];
                $menu[$key]['name'] = $row['wm_name'];
                if($row['wm_type'] != '') {
                    $menu[$key]['type'] = $row['wm_type'];
                }

                if($row['wm_key'] != '') {
                    $type = ($row['wm_type'] == 'view') ? 'url' : 'key';
                    $menu[$key][$type] = $row['wm_key'];
                }
            } else {
                $key = $row['wm_pid'];
                $menu[$key]['sub_button'][$k]['name'] = $row['wm_name'];

                if($row['wm_type'] != '') {
                    $menu[$key]['sub_button'][$k]['type'] = $row['wm_type'];
                }

                if($row['wm_key'] != '') {
                    $type = ($row['wm_type'] == 'view') ? 'url' : 'key';
                    $menu[$key]['sub_button'][$k][$type] = $row['wm_key'];
                }
            }
        }

        $menu = array_values($menu);
        foreach($menu as &$val) {
            if(isset($val['sub_button'])) {
                $val['sub_button'] = array_values($val['sub_button']);
            }
        }

        $menu = array("button"=>array_values($menu));
        $weixinAuth = new Open_Weixin_Auth();
        $ret = $weixinAuth->menuCreate($menu);
        print_r($ret);
        if($ret['errcode'] == 0) {
            Helper_Json::formJson('菜单生成成功', 'Y');
        } else {
            Helper_Json::formJson('菜单生成失败');
        }
    }
}