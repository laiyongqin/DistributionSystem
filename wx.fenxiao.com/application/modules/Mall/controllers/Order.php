<?php

/**
 * 订单列表
 *
 * @author: monyyip
 * @since : 2016/8/18
 */
class OrderController extends BaseController {

    private $_orderModel;
    private $_payStatus = array(
        1 => '未支付',
        2 => '取消订单',
        3 => '已经支付',
    );

    private $_expressStatus = array(
        1 => '未发货',
        2 => '已发货',
        3 => '确认收货',
    );
    //单页数量
    private $_pageSize = 5;

    private function init(){
        $this->_orderModel = $this->loadModel('Order');
        $this->initViewPath();
    }

    /**
     * 订单列表
     *
     * @param int $page
     * @return bool
     */
    public function indexAction($page = 1) {
        $this->initPageTitle('订单列表');
        $type     = isset($_GET['type']) ? $_GET['type'] : '';
        //所有选项数据
        $where = array();
        $where['m_id']     = M_ID;
        //订单列表数据
        $pagination = array('page'=> $page, 'pagesize'=> $this->_pageSize);
        $allData    = $this->_orderModel->getList($where, $pagination);
        if($allData){
            // 计算过期时间
            $expireTime  = ConfigModel::getInstance()->getValueByKey('auto_cancle_order');
            foreach($allData as &$val){
                $expire = strtotime($val['o_addtime']) + $expireTime * 3600;
                $val['p_title'] = Helper_Filter::cutString($val['p_title'],36);
                $val['leftTime'] = $expire > time() ? date('Y-m-d H:i:s', intval($expire)) : 0;
            }
        }

        //下拉加载数据
        if($type == 'load') {
            if(!$allData){return FALSE;}

            $this->getView()->assign(array(
                'allData'     => $allData,
                'payStatus'   => $this->_payStatus,
                'orderStatus' => $this->_expressStatus
            ));

            $this->getView()->display('order/load.html');
            exit;
        }

        $this->getView()->assign(array(
            'allData'     => $allData,
            'total'       => $allData ? count($allData) : 0,
            'pageSize'    => $this->_pageSize,
            'payStatus'   => $this->_payStatus,
            'orderStatus' => $this->_expressStatus,
            'nav' => 2
        ));
    }


    /**
     * 订单物流
     */
    public function expressAction(){

        $this->initPageTitle('订单详情');
        $id     = isset($_GET['id']) ? $_GET['id'] : '';

        if(empty($id)){
            $this->redirect('/');
        }

        //订单信息
        $data        = $this->_orderModel->getOrderInfoByOrderNo($id,2);

        //获得物流信息
        $expressData = array();
        if($data['o_express_number'] ){
            $dateObj = new Express_Tracking();
            $expressData = $dateObj->query($data['o_express_number']);
        }

        //模版赋值
        $this->getView()->assign(array(
            'data'   => $data,
            'expressData'   => $expressData,
        ));
    }

}