<?php

/**
 * 广告管理
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class AdsgroupController extends BaseController
{

    private $_model;

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        $this->_model    = new AdsgroupModel();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    /**
     * 保存表单操作
     */
    public function saveAction() {
        $id     = intval( $this->getRequest()->getPost('id') );

        if ( $id > 0 ) {
            //编辑模式
            $row = $this->_model->getAdgroupById($id);
            if ( ! $row['ag_id'] ) {
                Helper_Json::formJson('参数错误。');
            }
        } else {
            $row = array();
        }

        $data = array();
        $data['ag_name']       = Helper_Filter::format( $this->getRequest()->getPost('ag_name'), TRUE );

        //验证基本信息;
        if ( ! $data['ag_name'] ) {
            Helper_Json::formJson('请填写广告组名称。');
        }

        if ( $id == 0 ) {
            //增加广告组 要求填写别名，编辑不允许修改别名。因为别名用于数据前台调用，作为获取条件
            $data['ag_cname']    = Helper_Filter::format( $this->getRequest()->getPost('ag_cname'), TRUE );
            if ( empty( $data['ag_cname'] ) )
                Helper_Json::formJson('请填写广告组别名。');

            if ( $this->_model->isGroupCNameExist( $data['ag_cname'] ) )
                Helper_Json::formJson('该广告别名已存在，请更换一个。');
        }

        //验证列表中
        if ( ! isset($_POST['aid']) OR ! is_array($_POST['aid']) OR empty($_POST['aid']) ) {
            Helper_Json::formJson('请选择隶属广告列表。');
        }

        $aids = array();
        foreach ($_POST['aid'] AS $a_id) {
            $aids[] = intval($a_id);
        }
        $data['a_ids'] = implode(',', $aids);

        if ( ! $data['a_ids'] ) {
            Helper_Json::formJson('请选择隶属广告列表。');
        }

        if ( $id ) {
            $this->_model->saveData($data, $id);
            Helper_Json::formJson('编辑广告组成功。', 'y');
        } else {
            $this->_model->saveData($data);
            Helper_Json::formJson('新增广告组成功。', 'y');
        }
    }
}