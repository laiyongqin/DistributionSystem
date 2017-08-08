<?php

/**
 * 用户财富模型
 *
 * @author: lindexin
 * @since : 2016/04/29
 */

class MemberWealthModel extends BaseModel {

    private $_filed;
    public function __construct()
    {
        parent::__construct('www', 't_member_wealth', 'mw_id');
        $this->_filed = 'mw_id,m_id,mw_had_withdraw_money,mw_not_withdraw_money,mw_withdraw_money,mw_sales_money,mw_award_money,mw_addtime';
    }

    /**
     * 通过id获得用户信息
     * @param $id
     */
    public function getInfo($id){
        return $this->_db->select($this->_filed)->from($this->_table)->where('m_id',$id)->fetchOne();
    }

    /**
     * 更新用户财富
     *
     * @param $mid
     * @param  $sales   销售额
     * @param  $award   奖励
     * @param  $type    1为新增，2减少
     * @return mixed
     */
    public function updateWealth($mid, $sales, $award, $type=1){
        $ret = $this->isExistMember($mid);
        if($ret) {
            if($type == 1) {
                return $this->_db->update($this->_table)->set('mw_sales_money', $sales, true)->set('mw_award_money', $award, true)->where('mw_id', $ret)->execute();
            } else {
                return $this->_db->update($this->_table)
                    ->set('mw_sales_money', '-' . $sales, true)
                    ->set('mw_award_money', '-' . $award, true)
                    ->where('mw_id', $ret)
                    ->where('mw_sales_money > 0')
                    ->where('mw_award_money > 0')
                    ->execute();
            }

        } else {
            $data = array(
                'm_id'           => $mid,
                'mw_sales_money' => $sales,
                'mw_award_money' => $award,
                'mw_addtime'     => date('Y-m-d H:i:s')
            );
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }

    /**
     * 更新提现信息
     *
     * @param $mid   会员ID
     * @return bool
     */
    public function updateWithdraw($mid, $money) {
        $ret = $this->isExistMember($mid);
        if(!$ret) {
            return false;
        }

        if($money > 0) {
            return $this->_db->update($this->_table)
                ->set('mw_not_withdraw_money', $money, true)
                ->set('mw_withdraw_money', $money, true)
                ->where('mw_id', $ret)
                ->execute();
        } else {
            return $this->_db->update($this->_table)
                            ->set('mw_had_withdraw_money', abs($money), true)
                            ->set('mw_not_withdraw_money', $money, true)
                            ->where('mw_id', $ret)
                            ->where('mw_not_withdraw_money >=' . abs($money))
                            ->execute();
        }
    }

    /**
     * 判断会员是否存在
     *
     * @param $mid
     * @return mixed
     */
    private function isExistMember($mid) {
        return $this->_db->select('mw_id')->from($this->_table)->where('m_id', $mid)->fetchValue();
    }

    /**
     * 通过id获得可提现金额
     * @param $mid 用户id
     */
    public function getWithdraw($mid){
        return $this->_db->select('mw_not_withdraw_money')->from($this->_table)->where('m_id',$mid)->fetchValue();
    }
}