<?php

/**
 * 微信关注订阅
 *
 * @author: moxiaobai
 * @since : 2016-08-26
 */

class SubscribeModel extends BaseModel{

	public function __construct()
	{
		parent::__construct('www', 't_weixin_subscribe', 's_id');
	}

	/**
	 * 关注微信公众号，欢迎信息
	 *
	 * @param  integer $eventKey
	 * @param  string  $openId
	 * @param  string  $type
	 * @return string
	 */
	public function getWelcomeTip($eventKey, $openId, $type='subscribe') {
		$weixin    = new Open_Weixin_Auth();
		$userInfo  = $weixin->getUserInfo($openId);

		//注册用户
		$nickname   = $userInfo['nickname'];
		$memberInfo = MemberModel::getInstance()->addMember($openId, $nickname, $userInfo['headimgurl']);
		$mid        = $memberInfo['m_id'];

		//判断是否是会员
		if($type == 'subscribe') {
			if($memberInfo['m_vip'] == 1 && $eventKey != '') {
				$data = array('nickname'=>$nickname);
				QueueModel::getInstance()->addQueue($openId, 'subscribe_scan_notice', $data);
			} else {
				$data = array('mid'=>$mid);
				QueueModel::getInstance()->addQueue($openId, 'subscribe_notice', $data);
			}
		}

		//绑定推广关系
		if($eventKey != '') {
			if($eventKey != $mid) {
				$ret = $this->loadModel('SalesPromoter', array(), 'Mall')->addPromoter($eventKey, $mid);
				if($ret) {
					//推送消息给一级代理商
					$openId  = MemberModel::getInstance()->getOpenIdByMid($eventKey);
					$data = array('nickname'=>$nickname);
					QueueModel::getInstance()->addQueue($openId, 'become_promoter_notice', $data);
				}
			}
		}

		return $this->getSubscribeContent();
	}

	/**
	 * 获取订阅推送内容
	 * @return string
	 */
	public function getSubscribeContent() {
		$data = array();
		$type = 'text';
		$now   = date('Y-m-d H:i:s');
		$where = array('time'=>$now);
		$content  = $this->getKeywordsInfo($where);
		if(!$content){
			// 获取默认
			$content = $this->getKeywordsInfo(array('s_cate'=>1));
			if(!$content){
				$data  = "谢谢您关注，祝您生活愉快！\n\n";
			}
		}

		if(!empty($content) && $content['s_type'] == 'news'){
			$list = !empty($content['s_content']) ? json_decode($content['s_content'], TRUE) : array();
			if($list){
				foreach($list as $val){
					$data[] = array(
						$val['s_title'], '', IMAGE_URL . $val['s_thumb'], $val['s_url']
					);
				}
			}

			$type = $content['s_type'];
		}else if(!empty($content) && $content['s_type'] == 'text'){
			$data = $content['s_content'];
		}

		return array(
			'content' => $data,
			'type'    => $type
		);
	}


	/**
	 * 根据关键字获取信息
	 *
	 * @param string $keywords
	 */
	public function getKeywordsInfo($where = array()){
		return $this->_setWhereSQL($where)->_db->select('s_content,s_type')->from($this->_table)->fetchOne();
	}

	/**
	 * SQL Where条件
	 * @param array $where
	 * @return $this
	 */
	private function _setWhereSQL ($where = array()) {
		if (isset($where['time']) AND $where['time']) {
			$this->_db->where("s_beginTime < '{$where['time']}'");
			$this->_db->where("s_endTime > '{$where['time']}'");
		}

		if (isset($where['s_cate']) AND $where['s_cate']) {
			$this->_db->where("s_cate", $where['s_cate']);
		}

		$this->_db->where("s_status", 1);
		return $this;
	}
}