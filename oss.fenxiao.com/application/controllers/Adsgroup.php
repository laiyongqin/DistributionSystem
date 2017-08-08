<?php

/**
 * 广告组管理
 *
 * @author: lindexin
 * @since : 2016/07/18
 */

class AdsgroupController extends BaseController {

    private $_pageSize;
    private $_model;

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new AdsgroupModel();
        $this->_pageSize = 12;
    }


    public function indexAction($page=1) {
        $this->initPageTitle('广告组列表');

        $title  = isset($_GET['title']) ? Helper_Filter::format($_GET['title']) : '';
        $page   = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('title'=>$title);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));

        //数据列表
        $data = $this->_model->getList( $where, $pagination );

        $ids = Helper_Array::setIds( $data, 'a_ids', TRUE);

        $ids = trim($ids, ",");

        $ads = AdsModel::getInstance()->getList(array('ids' => $ids) );

        $ads = Helper_Array::setIdsKey($ads, 'a_id');

        if($data) {
            foreach ( $data AS &$row ) {
                $row['a_ids'] = explode(',', $row['a_ids']);
                foreach ($row['a_ids'] as $key => $id) {
                    if(array_key_exists($id,$ads)){
                        $row['a_ids'][$key] = $ads[$id];
                    }else{
                        unset($row['a_ids'][$key]);
                    }
                }
                $row['a_counts'] = count($row['a_ids']);
            }
        }

        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'title'          => $title,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
        ));
    }
    /**
     * 获取添加或者编辑表单Form
     */
    public function formAction($id=0) {
        $id = intval($id);

        if ( $id > 0 ) {
            $row = $this->_model->getAdgroupById($id);
        }else{
            $row = array(
                'ag_id'=>'',
                'ag_name'=>'',
                'ag_cname'=>'',
                'a_ids'=>'',
                'ag_addtime'=>'',
            );
        }

        //模版赋值
        $this->getView()->assign(array(
            'row'        => $row,
            'id'        => $id,
        ));
    }



    /**
     * Ajax 返回所属域名下的所有广告用于选择
     */
    public function getAdAction() {
        $data   = AdsModel::getInstance()->getAdMapByDomain();
        //print_r($data);
        $option = Helper_Form::checkbox('ids[]', $data);
        Helper_Json::echoJson(1, $option);
    }
}