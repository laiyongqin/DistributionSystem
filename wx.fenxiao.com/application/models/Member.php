<?php

/**
 * 帐号系统
 *
 * @author: moxiaobai
 * @since : 2016/3/18 14:21
 */

class MemberModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_member', 'm_id');
    }

    /**
     * 生成帐号
     * @param array $data  网页授权获取的用户数据
     */
    public function login($data) {
        $openId    = isset($data['openid']) ? $data['openid'] : null;
        $nickname  = isset($data['nickname']) ? $data['nickname'] : null;
        $avatar    = isset($data['headimgurl']) ? $data['headimgurl'] : null;

        //如果获取不到用户信息
        if(is_null($openId)) {
            return false;
        }

        $userInfo = $this->addMember($openId, $nickname, $avatar);

        //用户数据写入session
        $userInfo = array(
            'mid'      => $userInfo['m_id'],
            'nickname' => $nickname,
            'openId'   => $openId,
            'avatar'   => $avatar
        );
        Yaf_Session::getInstance()->set('userInfo', $userInfo);

        return true;
    }

    /**
     * 添加用户
     *
     * @param $openId    OpenId
     * @param $nickname  昵称
     * @param $avatar    用户头像
     * @return mixed
     */
    public function addMember($openId, $nickname="", $avatar="") {
        $userInfo = $this->getUserInfoByOpenId($openId);
        if(!$userInfo) {
            //写入用户表数据
            $ip   = Helper_Location::getIpString();
            $rows = array(
                'm_openId'   => $openId,
                'm_nickname' => $nickname,
                'm_avatar'   => $avatar,
                'm_regIp'    => $ip,
                'm_addtime'  => date('Y-m-d H:i:s')
            );
            $mid = $this->_db->insert('t_member')->rows($rows)->execute();
            $userInfo = array('m_id'=>$mid, 'm_vip'=>1);
        }

        return $userInfo;
    }

    /**
     * 根据用户ID获取用户信息
     *
     * @param $mid
     * @return mixed
     */
    public function getUserInfoByMid($mid) {
        return $this->_db->select('m_id,m_openId,m_vip,m_username')->from('t_member')->where('m_id', $mid)->fetchOne();
    }

    /**
     * 通过OpenID获得用户信息
     *
     * @param $openId
     * @return mixed
     */
    public function getUserInfoByOpenId($openId) {
        return $this->_db->select('m_id,m_vip')->from('t_member')->where('m_openId', $openId)->fetchOne();
    }

    /**
     * 通过mid获取用户昵称
     *
     * @param $mid
     * @return mixed
     */
    public function getNicknameByMid($mid) {
        return $this->_db->select('m_nickname')->from('t_member')->where('m_id', $mid)->fetchValue();
    }

    /**
     * 通过mid获取open id
     * @param $mid
     * @return mixed
     */
    public function getOpenIdByMid($mid) {
        return $this->_db->select('m_openId')->from('t_member')->where('m_id', $mid)->fetchValue();
    }

    /**
     * 判断是否为VIP
     * @param $mid
     * @return bool
     */
    public function isVip($mid) {
        $vip = $this->_db->select('m_vip')->from('t_member')->where('m_id', $mid)->fetchValue();
        if($vip == 2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新用户手机号码
     *
     * @param $phone
     * @return mixed
     */
    public function updatePhone($mid, $phone) {
        return $this->_db->update('t_member')->set('m_phone', $phone)->where('m_id', $mid)->execute();
    }


    /**
     * 更新用户VIP等级
     *
     * @param $mid
     * @param $level
     * @return mixed
     */
    public function updateVipLevel($mid, $level) {
        return $this->_db->update('t_member')->set('m_vip', $level)->where('m_id', $mid)->execute();
    }

    /**
     * 新增消费金额
     *
     * @param $mid
     * @param $money
     * @return mixed
     */
    public function updateConsume($mid, $money) {
        return $this->_db->update('t_member')->set('m_consume', $money, true)->where('m_id', $mid)->execute();
    }
}