<?php

/**
 * 会员中心
 *
 * @author: lindexin
 * @since : 2016/08/18
 */

class MemberController extends BaseController {

    private $_model;
    private $_pageSize = 5;

    private $_salesOrderModel;
    private $_salesPromoterModel;

    public function init() {
        $this->_model = $this->loadModel('Member');
        $this->initViewPath();

        $this->_salesOrderModel      = $this->loadModel('SalesOrder',array(),'Mall');
        $this->_salesPromoterModel   = $this->loadModel('SalesPromoter',array(),'Mall');
    }

    //个人资料
    public function indexAction() {
        $this->initPageTitle("会员中心");

        //用户信息
        $userData         = $this->_model->getInfo(M_ID);
        $on               = isset($_GET['on']) ? $_GET['on'] : 3;

        //代言人信息
        $promoterNumber   = $this->_salesPromoterModel->countPromoter($userData['m_id']);

        //推广人
        $spokesId   = $this->_salesPromoterModel->getMid(intval($userData['m_id']));
        $spokesman  = $this->_model->getInfo(intval($spokesId));

        //代言人推广
        $salesOrderAlread  = $this->_salesOrderModel->getAllAlready(intval($userData['m_id']));//下单未购买订单
        $salesOrderEnd     = $this->_salesOrderModel->getAllEnd(intval($userData['m_id']));//下单已购买订单

        //推荐配置名称
        $configName   = ConfigModel::getInstance()->getValueByKey('weixin_service_name');

        //用户财富
        $wealth       = $this->loadModel('MemberWealth')->getInfo(intval($userData['m_id']));
        $noPayData    = $this->loadModel('SalesOrder',array(),'Mall')->getNoPay(intval($userData['m_id']));//未付款金额
        $goPayData    = $this->loadModel('SalesOrder',array(),'Mall')->getGoPay(intval($userData['m_id']));//已付款金额
        $takeData     = $this->loadModel('SalesOrder',array(),'Mall')->getTake(intval($userData['m_id']));//已确认收货金额

        $this->getView()->assign(array(
            'userData'     => $userData,
            'spokesman'     => $spokesman,
            'wealth'        => $wealth,
            'configName'    => $configName,

            'salesOrderAlread'    => $salesOrderAlread,
            'salesOrderEnd'       => $salesOrderEnd,

            'noPayData'      => $noPayData,
            'goPayData'      => $goPayData,
            'takeData'       => $takeData,
            'promoterNumber' => $promoterNumber,
            'on'             => $on,
            'nav'            => 4
        ));
    }

    //代言人列表
    public function listAction() {
        $this->initPageTitle("代言人列表");

        $page   = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $type   = isset($_GET['type']) ? $_GET['type'] : '';
        $smid   = isset($_POST['smid']) ? intval($_POST['smid']) : '';


        //用户信息
        $userData         = $this->_model->getInfo(M_ID);
        //代言人信息
        $promoterNumber   = $this->_salesPromoterModel->countPromoter($userData['m_id']);

        //分页参数，读取参数设置
        $where      = array('mid'=>M_ID,'smid'=>$smid);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //数据列表
        $promoterList  = $this->_salesPromoterModel->getList($where, $pagination);
        $promoterList  = $this->_model->mergData($promoterList,'sp_spokesman');

        if($promoterList){
            foreach($promoterList as &$v){
                $v['m_addtime'] = date('Y-m-d',strtotime($v['m_addtime']));
            }
        }

        if($type == 'load') {
            if(!$promoterList){return FALSE;}
            $this->getView()->assign(array(
                'promoterList' => $promoterList,
            ));

            $this->getView()->display('/member/load.html');
            exit;
        }

        //模版赋值
        $this->getView()->assign(array(
            'userData'         => $userData,
            'smid'             => $smid,
            'promoterNumber'   => $promoterNumber,
            'promoterList'     => $promoterList,
            'total'            => count($promoterList),
            'pageSize'         => $this->_pageSize,
            'nav'          => 4
        ));

    }

    //推广订单列表
    public function orderAction() {
        $this->initPageTitle("代言人订单列表");

        $page         = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $type         = isset($_GET['type']) ? intval($_GET['type']) : '';
        $mobileType   = isset($_GET['mobileType']) ? $_GET['mobileType'] : '';
        $smid         = isset($_POST['smid']) ? intval($_POST['smid']) : '';


        //用户信息
        $userData          = $this->_model->getInfo(M_ID);

        //代言人信息
        if($type==1){
            $numb  = $this->_salesOrderModel->getAllAlready(intval($userData['m_id']));//下单未购买订单
        }else{
            $numb  = $this->_salesOrderModel->getAllEnd(intval($userData['m_id']));//下单已购买订单
        }

        //分页参数，读取参数设置
        if(!$type){
            $this->redirect('/member/member/index');
        }
        $where      = array('mid'=>M_ID,'smid'=>$smid,'type'=>$type);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //数据列表
        $data  = $this->_salesOrderModel->getList($where, $pagination);
        $data  = $this->_model->mergData($data,'so_spokesman');

        if($mobileType == 'load') {
            if(!$data){return FALSE;}
            $this->getView()->assign(array(
                'data' => $data,
            ));

            $this->getView()->display('/member/orderload.html');
            exit;
        }

        //模版赋值
        $this->getView()->assign(array(
            'userData'          => $userData,
            'smid'              => $smid,
            'type'              => $type,
            'numb'              => $numb,
            'data'              => $data,
            'total'             => count($data),
            'pageSize'          => $this->_pageSize,
            'nav'          => 4
        ));

    }
}