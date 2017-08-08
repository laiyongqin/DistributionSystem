<?php

/**
 * 商品列表
 *
 * @author: monyyip
 * @since : 2016/8/18
 */
class ProductController extends BaseController {

    private $_productModel;
    private function init(){
        $this->initViewPath();

        $this->_productModel = $this->loadModel('Product');
    }

    /**
     * 商品详情
     */
    public function detailsAction($id = 0){

        //产品信息
        $data  = $this->_productModel->getInfo($id);
        if(!$data) {
            $this->redirect('/');
        }

        //获得轮播图
        $picBanner   = $this->loadModel('ProductPic')->getAllPic($id);
        //Sdk相关信息,分享，上传图片
        $jsSdk = new Open_Weixin_Js();
        $signPackage = $jsSdk->GetSignPackage();

        //模版赋值
        $this->getView()->assign(array(
            'signPackage' => $signPackage,
            'data'        => $data,
            'picBanner'   => $picBanner
        ));
    }

    /**
     * 商品详情
     */
    public function buyAction($id = 0){
        //产品信息
        $data  = $this->_productModel->getInfo($id);
        if(!$data) {
            $this->redirect('/');
        }

        //获得轮播图
        $picBanner   = $this->loadModel('ProductPic')->getAllPic($id);

        // 获得地址
        $address = $this->loadModel('Address', array(), 'Member')->getAddress(M_ID);
        if(empty($address)){
            $address = array(
                'a_phone'     => '',
                'a_realname'  => '',
                'a_wechat_id' => '',
                'a_province'  => '',
                'a_city'      => '',
                'a_area'      => '',
                'a_address'   => '',
            );

            $hasAddress = 0;
        } else {
            $hasAddress = 1;
        }

        // 获得套餐列表
        $ppList = array();
        $ppType = $this->loadModel('ProfileType')->getTypeList();
        $ppArr = $this->loadModel('ProductProfile')->getAllInfo($id);
        $ppids = array();
        if($ppArr){
            foreach($ppArr as $val){
                if(empty($ppType) || !array_key_exists($val['pt_id'], $ppType)){
                    continue;
                }

                $ppList[$val['pt_id']][] = $val;
            }

            foreach($ppList as $key => $val){
                $ppids[] = $val[0]['pp_id'];
            }
        }

        if($data['p_event_price'] > 0){
            $price = $data['p_event_price'];
        }else{
            $price = $data['p_original_price'];
        }

        //Sdk相关信息,分享，上传图片
        $jsSdk = new Open_Weixin_Js();
        $signPackage = $jsSdk->GetSignPackage();

        //模版赋值
        $this->getView()->assign(array(
            'hasAddress'  => $hasAddress,
            'signPackage' => $signPackage,
            'data'        => $data,
            'price'       => $price,
            'picBanner'   => $picBanner,
            'address'     => $address,
            'ppList'      => $ppList,
            'ppType'      => $ppType,
            'ppids'       => $ppids ? implode(',', $ppids) : ''
        ));
    }
}