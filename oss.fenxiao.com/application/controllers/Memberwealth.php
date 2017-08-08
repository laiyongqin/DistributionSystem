<?php

/**
 * 用户管理
 *
 * @author: lindexin
 * @since : 2016/07/11
 */

class MemberwealthController extends BaseController {

    private $_pageSize;
    private $_model;

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new MemberwealthModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('用户财富');
        //搜索数据
        $mid          = isset($_GET['mid']) ? intval(trim($_GET['mid'])) : '';
        $startTime        = isset($_GET['beginTime']) ? $_GET['beginTime'] : '';
        $endTime          = isset($_GET['endTime']) ? $_GET['endTime'] : '';

        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where  = array(
            'mid'                   => $mid,
            'startTime'             => $startTime,
            'endTime'               => $endTime,
        );
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data = $this->_model->getList( $where, $pagination );
        $data = MemberModel::getInstance()->mergData($data,'m_id');

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'   => $baseUrl,
            'data'      => $data,
            'total'     => $total,
            'page'      => $pageCode,
            'mid'            => $mid,
            'startTime'          => $startTime,
            'endTime'            => $endTime,
        ));
    }
}