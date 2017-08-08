<?php

/**
 * 分销首页
 *
 * @author: monyyip
 * @since : 2016/8/18 16:43
 */

class IndexController extends BaseController {
    public function indexAction() {
        $title = isset($_GET['title']) ? Helper_Filter::format($_GET['title'], FALSE, TRUE) : '';
        $pid = isset($_GET['pid']) ? Helper_Filter::format($_GET['pid'], FALSE, TRUE) : '';
        // 获得首页轮播
        $adList = AdModel::getInstance()->getAdGroupByName('home_focus');
        // 获得产品分类
        $cateList = $this->loadModel('Category', array(), 'Mall')->getCategory();
        // 获得产品列表
        $where = array('status' => 1, 'name' => $title,'pid'=>$pid);
        $productList = $this->loadModel('Product', array(), 'Mall')->getList($where);

        $this->getView()->assign(array(
            'cateList'    => $cateList,
            'adList'      => $adList,
            'productList' => $productList,
            'title'       => $title,
            'nav'         => 1
        ));

    }
}