<?php

/**
 * 关注
 *
 * @auther monyyip
 * @since  2016-3-28
 */

class SubscribeModel extends BaseModel {
	public function __construct(){
		parent::__construct('www', 't_weixin_subscribe', 's_id');
	}

	/**
	 * SQL分页查询
	 */
	protected  function _setPaginationSQL( $pagination = array() ) {
		if ( isset($pagination['page']) AND isset($pagination['pagesize']) ) {
			$page      = isset( $pagination['page'] ) ? intval($pagination['page']) : 1;
			$pagesize  = isset( $pagination['pagesize']  ) ? intval($pagination['pagesize'])  : 10;
			$this->_db->page($page, $pagesize);
		} elseif ( isset($pagination['limit']) ) {
			$this->_db->limit( intval($pagination['limit']) );
		}
		return $this;
	}

	/**
	 * 改变状态
	 *
	 * @param $id
	 * @param array $data 修改数据
	 * @return mixed
	 */
	public function changeData($id, $data) {
		return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
	}

	/**
	 * SQL Where条件
	 * @param array $where
	 * @return $this
	 */
	private function _setWhereSQL ($where = array()) {
		if (isset($where['ktype']) AND $where['ktype']) {
			$this->_db->where("{$this->_table}.s_type", $where['ktype']);
		}

		if (isset($where['kcate']) AND $where['kcate']) {
			$this->_db->where("{$this->_table}.s_cate", $where['kcate']);
		}

		if (isset($where['kstatus']) AND $where['kstatus']) {
			$this->_db->where("{$this->_table}.s_status", $where['kstatus']);
		}

		if(isset($where['ktitle']) AND $where['ktitle']){
			$this->_db->where("{$this->_table}.s_title like '%{$where['ktitle']}%'");
		}

		return $this;
	}

	/**
	 * 查询所有关键字
	 */
	public function getAllsubscribe($where, $pagination) {
		$data = $this->_setWhereSQL($where)->_setPaginationSQL($pagination)->_db
				->select('s_id','s_title','s_type','s_cate','s_content','s_url','addtime', 's_status','s_thumb','s_beginTime','s_endTime')->from($this->_table)->order($this->_primary_key,'ASC')->fetchAll();
		$allData =array();
		if($data){
			foreach($data as $v){
				$v['addtime'] = date('Y-m-d',strtotime($v['addtime']));
				$allData[]      = $v;
			}
		}

		return $allData;
	}

	public function getsubscribeInfo($where){
		$data = $this->_setWhereSQL($where)->_db
				->select('s_id','s_title','s_type','s_cate','s_content','s_url','addtime', 's_status','s_thumb','s_beginTime','s_endTime')->from($this->_table)->fetchOne();
		return $data ? $data : FALSE;
	}

	/**
	 * 统计数量
	 *
	 * @param array $where
	 */
	public function countData($where=array()) {
		return $this->_setWhereSQL($where)->_db->select('COUNT(*)')->from($this->_table)->fetchValue();
	}

	/**
	 * 删除事件新闻
	 */
	public function deletesubscribe($id){
		return $this->_db->update($this->_table)->from($this->_table)->rows(array('s_status' => -1))->where('s_id',$id)->execute();
	}


	/**
	 * 根据id获取关键字
	 * @param $id
	 * @return bool
	 */
	public function getsubscribeById($id) {
		$row = $this->_db->select('s_id','s_title','s_cate','s_type','s_content','s_url','addtime', 's_status','s_thumb','s_beginTime','s_endTime')
				->from($this->_table)
				->where($this->_primary_key, $id)
				->fetchOne();

		return isset($row) ? $row : FALSE;
	}



	/**
	 * 新增，编辑关键字
	 * @param $data
	 * @param int $id
	 * @return mixed
	 */
	public function savesubscribe($data, $id=0) {
		if ( $id > 0 ) {
			return $this->_db->update($this->_table)->rows($data)->where('s_id', $id)->execute();
		} else {
			$data['addtime'] = date('Y-m-d H:i:s');
			return $this->_db->insert($this->_table)->rows($data)->execute();
		}
	}

}