<?php

/**
 * 订单详情
 *
 * @author: lindexin
 * @since : 2016/05/04
 */

class OrderController extends BaseController {

    private $_pageSize;
    private $_model;

    private $_payStatus = array(
        1 => '未支付',
        2 => '取消订单',
        3 => '已支付',
    );

    private $_orderStatus = array(
        1 => '未发货',
        2 => '已发货',
        3 => '确认订单',
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model    = new OrderModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('订单列表');

        //搜索数据
        $title            = isset($_GET['name']) ? Helper_Filter::format(trim($_GET['name'])) : '';
        $orderSn          = isset($_GET['orderSn']) ? Helper_Filter::format(trim($_GET['orderSn'])) : '';

        $psid              = isset($_GET['psid']) ? intval($_GET['psid']) : ''; //支付状态
        $osid              = isset($_GET['osid']) ? intval($_GET['osid']) : ''; //订单状态
        $startTime        = isset($_GET['startTime']) ? $_GET['startTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        //手机分页
        $pageMobile        = isset($_GET['page']) ? intval($_GET['page']) : '1';

        $page              = intval($page);

        //类型数据
        $pay_Option       = Helper_Form::option($this->_payStatus,$psid,'请选择支付状态');
        $order_Option      = Helper_Form::option($this->_orderStatus,$osid,'请选择订单状态');

        //模型和控制器
        $baseUrl           = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'title'                 => $title,
            'orderSn'               => $orderSn,
            'psid'                  => $psid,
            'osid'                  => $osid,

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

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'            => $baseUrl,
            'data'               => $data,
            'total'              => $total,
            'page'               => $pageCode,

            'title'             => $title,
            'orderSn'           => $orderSn,

            'startTime'         => $startTime,
            'endTime'           => $endTime,
            'psid'              => $psid,
            'osid'              => $osid,
            'pageMobile'        => $pageMobile,

            'payOption'         => $pay_Option,
            'orderOption'       => $order_Option,
            'pageSize'          => $this->_pageSize,
        ));
    }

    //改价表单
    public function priceFormAction($id=0) {
        $id = intval($id);

        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }
        $data  = $this->_model->getInfo($id);
        $this->getView()->assign(array(
            'id'   => $id,
            'data' => $data,
        ));
    }

    //关闭订单表单
    public function closeFormAction($id=0) {
        $id = intval($id);

        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }
        $data  = $this->_model->getInfo($id);
        $this->getView()->assign(array(
            'id'   => $id,
            'data' => $data,
        ));
    }

    //填写快递表单
    public function expressFormAction($id=0) {
        $id = intval($id);

        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }
        $data  = $this->_model->getInfo($id);
        $this->getView()->assign(array(
            'id'   => $id,
            'data' => $data,
        ));
    }

    //发货
    public function sendAction($id=0) {

        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }
        $row    = $this->_model->getInfo($id);
        $openId = MemberModel::getInstance()->getOpenId(intval($row['m_id']));

        $data = array(
            'o_order_status' => 2,
            'o_updatetime' => date('Y-m-d H:i:s',time()),
        );
        $ret = $this->_model->saveData($data, $id);
        if($ret){

            //订单进度
            $result = array(
                'o_id'   => $id,
                'op_memo' => '发货成功',
                'op_addtime' => date('Y-m-d H:i:s',time()),
            );
            OrderprogressModel::getInstance()->saveData($result);

            //发送通知短信
            $data = array(
                'title'    => $row['p_title'],
                'orderNo'  => $row['o_order_no'],
            );
            QueueModel::getInstance()->addQueue($openId, 'deliver_goods_notice', $data);
            //$message = MessageModel::getInstance()->rebuildMessage('deliver_goods_notice', $data);
            //MessageModel::getInstance()->sendTextMessage($openId, $message);

            Helper_Json::formJson('发货成功', 'y');
        }else{
            Helper_Json::formJson('发货失败');
        }
    }

    //确认收货
    public function statusAction($id=0) {

        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        $data = array(
            'o_order_status' => 3,
            'o_updatetime' => date('Y-m-d H:i:s',time()),
        );
        $ret = $this->_model->saveData($data, $id);
        if($ret){
            //订单进度
            $result = array(
                'o_id'   => $id,
                'op_memo' => '确认收货',
                'op_addtime' => date('Y-m-d H:i:s',time()),
            );
            OrderprogressModel::getInstance()->saveData($result);
            Helper_Json::formJson('确认收货成功', 'y');
        }else{
            Helper_Json::formJson('确认收货失败');
        }
    }

    /**
     * 商品详情
     */
    public function detailsAction($id=0){

        $this->initPageTitle('订单详情');
        $id = intval($id);
        if(empty($id)){
            Helper_Json::formJson('缺失参数');
        }

        //订单信息
        $data        = $this->_model->getInfo($id);

        //购买人数据
        $progressData  = OrderprogressModel::getInstance()->getAllInfo(intval($data['o_id']));

        //地址数据
        $address      = AddressModel::getInstance()->getUserInfo(intval($data['m_id']));

        //套餐数据
//        $profileData = ProductprofileModel::getInstance()->getAllInfo(intval($data['p_id']));
//        $profileData = profiletypeModel::getInstance()->mergData($profileData,'pt_id');

        //模版赋值
        $this->getView()->assign(array(
            'data'           => $data,
            'address'        => $address,
            'progressData'   => $progressData,
        ));
    }

    /**
     * 异步物流信息
     */
    public function getAjaxExpressAction($number){

        $number = intval($number);
        $expressData = array();
        if($number){
            $dateObj = new Express_Tracking();
            $expressData = $dateObj->query($number);
        }

        $this->getView()->assign('expressData',$expressData);
        $this->getView()->display('order/load.html');
        exit;
    }

}