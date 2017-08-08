<?php

/**
 * 菜单管理
 *
 * @author: lindexin
 * @since : 2016/07/11
 */

class MenuController extends BaseController
{

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }


    /**
     * 添加修改记录
     */
    public function saveAction() {
        $id      = $_POST['id'];

        $parent  = isset($_POST['menuEdit']) ? $_POST['menuEdit'] : 0;
        $name    = $_POST['name'];
        $tag     = $_POST['tag'];
        $url     = $_POST['url'];
        $order   = $_POST['order'];
        //$content = $_POST['content'];
        // 基本数据过滤

        $data = array(
            'm_parent_id' => $parent,
            'm_name'      => $name,
            'm_url'       => $url,
            'm_tag'       => $tag,
            'm_order'     => $order,
            'm_memo'      => '',
            'm_addtime'   => date('Y-m-d H:i:s'),
        );

        $urlInfo = MenuModel::getInstance()->getMidByUrl($url);
        if ( $id > 0 ) {

            // 判断url是否存在
            if(!empty($urlInfo) && $urlInfo != $id){
                Helper_Json::formJson('菜单URL已存在');
            }

            MenuModel::getInstance()->saveMenu($data, $id);
            Helper_Json::formJson('修改成功','y');
        } else {
            if(!empty($urlInfo)){
                Helper_Json::formJson('菜单URL已存在');
            }

            MenuModel::getInstance()->saveMenu($data);
            Helper_Json::formJson('添加成功','y');
        }
    }

}