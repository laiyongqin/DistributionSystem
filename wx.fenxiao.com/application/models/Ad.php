<?php
/**
 * 广告管理
 *
 * @author: moxiaobai
 * @since : 2016/7/22 11:30
 */

class AdModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_ad', 'a_id');
    }

    /**
     * 根据别名获取广告列表
     *
     * @param $cname
     * @return bool
     */
    public function getAdGroupByName($cname) {
        $adsId =  $this->_db->select('a_ids')->from('t_ad_group')->where('ag_cname', $cname)->fetchValue();
        if(!$adsId) return false;

        $rows =  $this->_db->select('a_title,a_picture,a_link')->from('t_ad')->where('a_status', 1)->where("a_id in ($adsId)")->fetchAll();
        if($rows === false) return false;

        return $rows;
    }
}