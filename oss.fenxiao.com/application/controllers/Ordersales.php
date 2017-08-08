<?php

/**
 * 佣金明细管理管理
 *
 * @author: lindexin
 * @since : 2016/08/16
 */

class OrdersalesController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_type = array(
        1 => '下单未购买',
        2 => '下单已购买',
        3 => '已收货',
        4 => '已完成',
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new SalesorderModel();
        $this->_pageSize =12;
    }


    /**
     * 分销列表
     */
    public function indexAction($page=1) {
        $this->initPageTitle('分销订单列表');

        //搜索数据
        $orderSn          = isset($_GET['orderSn']) ? Helper_Filter::format(trim($_GET['orderSn'])) : '';
        $tid              = isset($_GET['tid']) ? intval($_GET['tid']) : ''; //支付状态
        $startTime        = isset($_GET['startTime']) ? $_GET['startTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);

        //类型数据
        $type_Option       = Helper_Form::option($this->_type,$tid,'请选择类型');

        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'orderSn'               => $orderSn,
            'tid'                   => $tid,
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

            'orderSn'           => $orderSn,

            'startTime'         => $startTime,
            'endTime'           => $endTime,
            'tid'              => $tid,
            'pageMobile'        => $pageMobile,

            'typeOption'         => $type_Option,
            'pageSize'          => $this->_pageSize,
        ));
    }
}