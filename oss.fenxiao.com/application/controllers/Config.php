<?php

/**
 * 系统配置
 *
 * @author: lindexin
 * @since : 2016/07/06
 */
class ConfigController extends BaseController {

    private $_model;

    private $_type = array(
        '1' => 'SEO/分享配置',
        '2' => '提示信息',
        //'3' => '样式模版',
        '4' => '购买配置',
        '5' => '收货配置',
        '6' => '提现配置',
    );
    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new ConfigModel();
    }

    public function indexAction() {
        $this->initPageTitle('配置选项');
        $tid         = isset($_GET['tid']) ? intval($_GET['tid']) : 1;

        //分页参数，读取参数设置
        $where      = array('tid'=>$tid);

        //数据列表
        $data           = $this->_model->getList( $where);

        //模版赋值
        $this->getView()->assign(array(
            'typeList'       => $this->_type,
            'data'           => $data,
            'tid'           => $tid,
        ));
    }

    //表单页
    public function formAction($id = 0) {
        $id = intval($id);
        $row = array();
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array(
                'bc_id' => 0,'bc_type' => 0,'bc_title' => '','bc_key' => '','bc_value'=>'','bc_sort' => 1,'bc_addtime' => '',
            );
        }

        $this->getView()->assign(array(
            'id' => $id,
            'row' => $row,
        ));
    }

    public function saveAction(){
        $post = $this->getRequest()->getPost();
        
        $allData =array(
            1 => isset($_POST['bc_value_1']) ? array('bc_value'=>$post['bc_value_1']) : '',
            2 => isset($_POST['bc_value_2']) ? array('bc_value'=>$post['bc_value_2']) : '',
            3 => isset($_POST['bc_value_3']) ? array('bc_value'=>$post['bc_value_3']) : '',
            4 => isset($_POST['bc_value_4']) ? array('bc_value'=>$post['bc_value_4']) : '',
            5 => isset($_POST['bc_value_5']) ? array('bc_value'=>$post['bc_value_5']) : '',
            6 => isset($_POST['bc_value_6']) ? array('bc_value'=>$post['bc_value_6']) : '',
            7 => isset($_POST['bc_value_7']) ? array('bc_value'=>$post['bc_value_7']) : '',
            8 => isset($_POST['bc_value_8']) ? array('bc_value'=>$post['bc_value_8']) : '',
            9 => isset($_POST['bc_value_9']) ? array('bc_value'=>$post['bc_value_9']) : '',
            10 => isset($_POST['bc_value_10']) ? array('bc_value'=>$post['bc_value_10']) : '',
            11 => isset($_POST['bc_value_11']) ? array('bc_value'=>$post['bc_value_11']) : '',
            12 => isset($_POST['bc_value_12']) ? array('bc_value'=>$post['bc_value_12']) : '',
            13 => isset($_POST['bc_value_13']) ? array('bc_value'=>$post['bc_value_13']) : '',
            14 => isset($_POST['bc_value_14']) ? array('bc_value'=>$post['bc_value_14']) : '',
            15 => isset($_POST['bc_value_15']) ? array('bc_value'=>$post['bc_value_15']) : '',
            16 => isset($_POST['bc_value_16']) ? array('bc_value'=>$post['bc_value_16']) : '',
            17 => isset($_POST['bc_value_17']) ? array('bc_value'=>$post['bc_value_17']) : '',
            18 => isset($_POST['bc_value_18']) ? array('bc_value'=>$post['bc_value_18']) : '',
        );

        foreach($allData as $key=>$v){
            if(!empty($v['bc_value']) && isset($v['bc_value'])){
                $this->_model->saveData($v, $key);
            }
        }
        Helper_Json::formJson('修改成功', 'y');

    }
}