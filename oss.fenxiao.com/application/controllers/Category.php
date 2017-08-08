<?php

/**
 * 商品分类
 *
 * @author: monyyip
 * @since : 2016/08/12
 */
class CategoryController extends BaseController {
    private $_pageSize;
    private $_model;

    private $_status = array(
        1 => '正常',
        2 => '禁用'
    );

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new CategoryModel();
        $this->_pageSize = 12;
    }

    public function indexAction($page=1) {
        $this->initPageTitle('分类列表');
        $name        = isset($_GET['name']) ? Helper_Filter::format($_GET['name']) : '';
        $pid         = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
        $status      = isset($_GET['status']) ? intval($_GET['status']) : '';
        $page        = intval($page);

        //模型和控制器
        $baseUrl = '/' . $this->getRequest()->getControllerName() . '/';

        //分页参数，读取参数设置
        $where      = array('name' => $name, 'pid' => $pid, 'status' => $status);
        $pagination = array('page'=>$page, 'pagesize'=>$this->_pageSize);

        //做分页
        $total    = $this->_model->countData($where);
        $pageUrl  = $baseUrl .  'index/';
        $pageCode = $this->setPage($page, $this->_pageSize, $total, strtolower($pageUrl));
        $category = $this->_model->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), $pid, '请选择分类');
        //数据列表
        $data           = $this->_model->getList( $where, $pagination );
        //模版赋值
        $this->getView()->assign(array(
            'baseUrl'        => $baseUrl,
            'name'           => $name,
            'data'           => $data,
            'total'          => $total,
            'page'           => $pageCode,
            'categoryOption' => $categoryOption,
            'statusOption'   => Helper_Form::option($this->_status, intval($status), '请选择状态')
        ));
    }

    //表单页
    public function formAction($id = 0) {
        $id = intval($id);
        if($id > 0) {
            $row  = $this->_model->getInfo($id);
        }else{
            $row = array('pc_id' => 0,'pc_pid' => 0,'pc_img' => '','pc_name' => '','pc_alise'=>'','pc_order' => 1,'pc_status' => 1);
        }

        $category = $this->_model->getListByPid();
        $categoryOption = Helper_Form::option($category ? $category : array(), intval($row['pc_pid']), '请选择分类');
        $this->getView()->assign($row);
        $this->getView()->assign(array(
            'categoryOption' => $categoryOption,
            'row'            => $row,
            'id'             => $id,
            'statusOption'   => Helper_Form::option($this->_status, intval($row['pc_status']), '请选择状态')
        ));
    }


}