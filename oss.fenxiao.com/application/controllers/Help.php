<?php

/**
 * 帮助文档
 *
 * @author: moxiaobai
 * @since : 2016/3/21 10:33
 */

Class HelpController extends BaseController
{

    private $_pageSize;
    private $_model;
    private $_cateModel;
    public function init()
    {
        parent::init();
        $this->_model = new NewsModel();
        $this->_cateModel = new NewscategoryModel();
        $this->checkRight(A_ID, A_ROLE);
        $this->_pageSize = 12;
    }


    public function indexAction($page = 1) {

        $this->initPageTitle('帮助文档');
        $page    = intval($page);
        // 获得faq的分类
        $nc_id = $this->_cateModel->getCateIdByTag('help');

        $where = array();
        if($nc_id){
            $where['pid'] = $nc_id;
        }

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);
        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        $data = $this->_model->getList($where, $pagination);
        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'   => $baseUrl,
            'data'      => $data,
            'total'     => $total,
            'page'      => $pageCode,
        ));
    }

    public function detailAction() {
        $this->initPageTitle('帮助文档');
        $id = $this->getRequest()->get('id');
        $detail = $this->_model->getInfo($id);
        $this->getView()->assign(array(
            'detail' => $detail
        ));
    }
}