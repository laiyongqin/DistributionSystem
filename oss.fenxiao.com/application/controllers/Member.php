<?php

/**
 * 用户管理
 *
 * @author: lindexin
 * @since : 2016/07/11
 */

class MemberController extends BaseController {

    private $_pageSize = 12;
    private $_model;

    private $_status = array(1=>'正常',2=>'禁用');
    private $_vip    = array(1=>'平台用户', 2=>'代言人');

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model    = new MemberModel();
    }

    public function indexAction($page=1) {
        $this->initPageTitle('用户管理');

        $status = isset($_GET['status']) ? intval($_GET['status']) : '';
        $vip    = isset($_GET['vip']) ? intval($_GET['vip']) : '';
        $name   = isset($_GET['name']) ? Helper_Filter::format($_GET['name']) : '';
        $mid    = isset($_GET['mid']) ? Helper_Filter::format($_GET['mid']) : '';
        $phone  = isset($_GET['phone']) ? trim($_GET['phone']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('username'=>$name, 'status'=>$status,'id'=>$mid,'phone'=>$phone,'vip'=>$vip);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data = $this->_model->getList( $where, $pagination );

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'   => $baseUrl,
            'name'      => $name,
            'data'      => $data,
            'total'     => $total,
            'page'      => $pageCode,
            'mid'       => $mid,
            'phone'     => $phone,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态'),
            'vipOption'      => Helper_Form::option($this->_vip, intval($vip), '请选择用户等级'),
        ));
    }

    //修改密码表单页
    public function formPasswordAction($id=0) {
        $id = intval($id);
        $this->getView()->assign('id', $id);
    }

    //表单页
    public function formAction($id=0) {
        $id = intval($id);

        $row = array(
            'm_status' => '',
            'm_vip'    => ''
        );
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }
        //类型数据
        $statusOption = Helper_Form::option($this->_status,isset($row) ? intval($row['m_status']) : '','请选择状态');
        $vipOption    = Helper_Form::option($this->_vip,isset($row) ? intval($row['m_vip']) : '','请选择用户等级');

        $this->getView()->assign(array(
            'id'                => isset($row['m_id']) ? $row['m_id'] : '',
            'username'          => isset($row['m_username']) ? $row['m_username'] : '',
            'realname'          => isset($row['m_realname']) ? $row['m_realname'] : '',
            'password'          => isset($row['m_password']) ? $row['m_password'] : '',
            'addtime'           => isset($row['m_addtime']) ? $row['m_addtime'] : '',
            'statusOption'      => $statusOption,
            'vipOption'         => $vipOption
        ));
    }

    /**
     * 推广人列表
     */
    public function salespromoterAction($mid=0,$page=1) {
        $this->initPageTitle('推广人列表');
        $mid              = intval($mid);
        $startTime        = isset($_GET['startTime']) ? $_GET['startTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);

        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'mid'                   => $mid,
            'startTime'             => $startTime,
            'endTime'               => $endTime,
        );

        $pagination        = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total             = SalespromoterModel::getInstance()->countData($where);
        $pageUrl           = $baseUrl .  'salespromoter/' . 'mid/'. $mid.'/';
        $pageCode          = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data    = SalespromoterModel::getInstance()->getList( $where, $pagination );
        $data    = MemberModel::getInstance()->mergData($data,'sp_spokesman');


        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'            => $baseUrl,
            'data'               => $data,
            'total'              => $total,
            'page'               => $pageCode,


            'startTime'         => $startTime,
            'endTime'           => $endTime,
            'pageMobile'        => $pageMobile,
            'pageSize'          => $this->_pageSize,
        ));
    }


    /**
     * 分销列表
     */
    public function salesAction($mid=0,$page=1) {
        $this->initPageTitle('分销订单列表');

        //搜索数据
        $orderSn          = isset($_GET['orderSn']) ? Helper_Filter::format(trim($_GET['orderSn'])) : '';

        $mid              = intval($mid);

        $tid              = isset($_GET['tid']) ? intval($_GET['tid']) : ''; //支付状态
        $startTime        = isset($_GET['startTime']) ? $_GET['startTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);


        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'orderSn'               => $orderSn,
            'tid'                   => $tid,
            'mid'                   => $mid,
            'startTime'             => $startTime,
            'endTime'               => $endTime,
        );

        $pagination        = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total             = SalesorderModel::getInstance()->countData($where);
        $pageUrl           = $baseUrl .  'sales/' . 'mid/'. $mid.'/';
        $pageCode          = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data    = SalesorderModel::getInstance()->getList( $where, $pagination );

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

            'pageSize'          => $this->_pageSize,
        ));
    }
}