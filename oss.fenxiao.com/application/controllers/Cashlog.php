<?php

/**
 * 支付明细
 *
 * @author: monyyip
 * @since : 2016/08/17
 */

class CashlogController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(
        1 => '未处理',
        2 => '已完成',
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new WithdrawModel();
        $this->_pageSize =12;
    }


    /**
     * 分销列表
     */
    public function indexAction($page=1) {
        $this->initPageTitle('分销订单列表');
        //搜索数据
        $startTime        = isset($_GET['beginTime']) ? $_GET['beginTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);
        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'startTime'             => $startTime,
            'endTime'               => $endTime,
        );

        $pagination        = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total             = $this->_model->countData($where);
        $pageUrl           = $baseUrl .  'index/';
        $pageCode          = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data    = $this->_model->getList( $where, $pagination );
        $data    = MemberModel::getInstance()->mergData($data,'m_id');

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'            => $baseUrl,
            'data'               => $data,
            'total'              => $total,
            'page'               => $pageCode,
            'startTime'          => $startTime,
            'endTime'            => $endTime,
            'pageMobile'         => $pageMobile,
            'status'             => $this->_status,
            'pageSize'           => $this->_pageSize,
        ));
    }

    public function testAction() {
        //发送红包
        $orderNo = '1227754902' . date('YmdHis') . mt_rand(0,10);
        $amout   = 1 * 100;

        $input = Pay_Weixin_Pay::instanceSendRedPack();
        $input->SetMch_billno($orderNo);
        $input->SetSend_name('上善网络');
        $input->SetOpen_ID('oBp4Jt0jr95a3XzWJci7BKK-sHOk');
        $input->SetTotal_amount($amout);
        $input->SetTotal_num(1);
        $input->Set_wishing('红包提现');
        $input->SetAct_name('红包提现');
        $input->Set_remark('代言人推广奖励');

        $result = WxPayApi::sendRedPack($input);
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        exit;
    }
}