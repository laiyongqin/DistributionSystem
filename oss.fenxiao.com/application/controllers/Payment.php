<?php

/**
 * 支付明细
 *
 * @author: monyyip
 * @since : 2016/08/17
 */

class PaymentController extends BaseController {

    private $_pageSize;
    private $_model;
    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new PaymentModel();
        $this->_pageSize =12;
    }


    /**
     * 分销列表
     */
    public function indexAction($page=1) {
        $this->initPageTitle('分销订单列表');

        //搜索数据
        $orderSn          = isset($_GET['orderSn']) ? Helper_Filter::format(trim($_GET['orderSn'])) : '';
        $startTime        = isset($_GET['beginTime']) ? $_GET['beginTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);
        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'orderSn'               => $orderSn,
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
            'orderSn'            => $orderSn,
            'startTime'          => $startTime,
            'endTime'            => $endTime,
            'pageMobile'         => $pageMobile,
            'pageSize'           => $this->_pageSize,
        ));
    }
}