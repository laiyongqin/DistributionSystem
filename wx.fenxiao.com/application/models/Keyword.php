<?php

/**
 * 微信关键字回复
 *
 * @author: moxiaobai
 * @since : 2016-08-26
 */

class KeywordModel extends BaseModel{
	public function __construct()
	{
		parent::__construct('www', 't_weixin_keywords', 'k_id');
	}
	/**
	 * 根据关键字获取内容
	 *
	 * @param string $keyword
	 * @return array
	 */
	public function getContentByKeyword($keyword) {
		$keywordsList = $this->getKeywordsList();
		if($keywordsList) {
			foreach ($keywordsList as $value) {
				if(strrpos($keyword, $value['k_keys']) !== false) {
					$keyword = $value['k_keys'];
				}
			}
		}

		$where = array();
		$where['keywords'] = $keyword;
		$keywordInfo = $this->getKeywordsInfo($where);
		if(!empty($keywordInfo)){
			$content = trim($keywordInfo['k_content']);
			$type = $keywordInfo['k_type'];
		}else{
			// 获取默认
			$type = 'text';
			$where = array();
			$where['title'] = 'default';
			$keywordInfo = $this->getKeywordsInfo($where);
			if(!empty($keywordInfo)){
				$content = trim($keywordInfo['k_content']);
				$type = $keywordInfo['k_type'];
			}else {
				switch ($keyword) {
					case '#我要提建议#':
						$content = '很高兴收到您的反馈，祝您生活愉快，生活幸福！';
						break;
					default:
						$content = $keyword;
						$type    = 'transfer_customer_service';
						break;
				}
			}
		}

		switch($type){
			case 'news':
				$content = array(
					array(
						$keywordInfo['k_title'],$keywordInfo['k_content'],IMAGE_URL . $keywordInfo['k_thumb'],$keywordInfo['k_url']
					)
				);

				break;
		}

		//返回数据
		$data = array(
			'content' => $content,
			'type'    => $type
		);

		return $data;
	}

	/**
	 * 获取关键字列表
	 * @return bool
	 */
	public function getKeywordsList() {
		$rows =  $this->_db->select('k_keys')->from($this->_table)->where('k_status', 1)->fetchAll();
		if($rows === false) return false;

		return $rows;
	}

	/**
	 * 根据关键字获取信息
	 *
	 * @param string $keywords
	 */
	public function getKeywordsInfo($where = array()){
		return $this->_setWhereSQL($where)->_db->select('k_title,k_type,k_content,k_url,k_thumb')->from($this->_table)->fetchOne();
	}

	/**
	 * SQL Where条件
	 * @param array $where
	 * @return $this
	 */
	private function _setWhereSQL ($where = array()) {
		if (isset($where['keywords']) AND $where['keywords']) {
			$this->_db->where("k_keys", $where['keywords']);
		}

		if (isset($where['title']) AND $where['title']) {
			$this->_db->where("k_title", $where['title']);
		}

		$this->_db->where("k_status", 1);
		return $this;
	}
}