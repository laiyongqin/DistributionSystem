<?php

/**
 * 资讯列表
 *
 * @author: monyyip
 * @since : 2016/8/20
 */
class NewsController extends BaseController {
    private $_model = '';
    //单页数量
    private $_pageSize = 5;

    private function init(){
        $this->_model = $this->loadModel('News');
        $this->initViewPath();
    }

    /**
     * 资讯列表
     *
     * @param int $page
     * @return bool
     */
    public function indexAction($page = 1) {
        $type     = isset($_GET['type']) ? $_GET['type'] : '';
        $alias    = isset($_GET['alias']) ? $_GET['alias'] : '';

        // 获得产品分类
        $cateList = $this->loadModel('NewsCategory', array(), 'Mall')->getList(array('status'=>1),array('limit'=>4));
        if(!$alias){
            $alias = $cateList[0]['nc_alias'];
        }

        $nc_id = $this->loadModel('NewsCategory')->getIdByAlias($alias);
        if(empty($nc_id)){
            $this->redirect('/');
        }

        //所有选项数据
        $where = array();
        $where['nc_id']   = $nc_id;
        $where['status']  = 1;
        //分类列表
        //订单列表数据
        $pagination = array('page'=> $page, 'pagesize'=> $this->_pageSize);
        $allData    = $this->_model->getList($where, $pagination);



        //下拉加载数据
        if($type == 'load') {
            if(!$allData){return FALSE;}

            $this->getView()->assign(array(
                'allData'     => $allData,
            ));

            $this->getView()->display('news/load.html');
            exit;
        }

        // 获得首页轮播
        $adList = AdModel::getInstance()->getAdGroupByName('news_focus');

        $this->initPageTitle('新闻资讯');
        $this->getView()->assign(array(
            'alias'       => $alias,
            'allData'     => $allData,
            'total'       => $allData ? count($allData) : 0,
            'pageSize'    => $this->_pageSize,
            'adList'      => $adList,
            'cateList'      => $cateList,
            'nav'      => 2,
        ));
    }

    public function detailsAction($id = 0){
        $newsInfo = $this->_model->getInfo($id);
        if(!$newsInfo) {
            $this->redirect('/');
        }
        //Sdk相关信息,分享，上传图片
        $jsSdk = new Open_Weixin_Js();
        $signPackage = $jsSdk->GetSignPackage();

        $this->getView()->assign('data', $newsInfo);
        $this->getView()->assign('signPackage', $signPackage);
    }

}