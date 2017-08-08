<?php

/**
 * 提现
 *
 * @author: lindexin
 * @since : 2016/08/20
 */

class WithdrawController extends BaseController {

    private $_model;
    private $_pageSize;

    public function init() {
        $this->_model = $this->loadModel('PayWithdraw',array(),'Pay');
        $this->_pageSize = 5;
        $this->initViewPath();

    }

    //提现列表
    public function indexAction() {
        $this->initPageTitle("提现列表");

        $page   = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $type   = isset($_GET['type']) ? $_GET['type'] : '';

        //用户信息
        $userData          = $this->loadModel('Member',array(),'Member')->getInfo(M_ID);

        //可提现金额
        $wealth = $this->loadModel('MemberWealth')->getWithdraw(M_ID);
        if(!$wealth) {
            $wealth=0;
        }

        //分页参数，读取参数设置
        $where      = array('mid'=>M_ID);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //数据列表
        $data  = $this->_model->getList($where, $pagination);

        if($type == 'load') {
            if(!$data){return FALSE;}
            $this->getView()->assign(array(
                'data' => $data,
            ));

            $this->getView()->display('/withdraw/load.html');
            exit;
        }

        //模版赋值
        $this->getView()->assign(array(
            'wealth'       => $wealth,
            'userData'     => $userData,
            'type'         => $type,
            'data'         => $data,
            'total'        => count($data),
            'pageSize'     => $this->_pageSize,
            'nav'          => 4
        ));

    }

}