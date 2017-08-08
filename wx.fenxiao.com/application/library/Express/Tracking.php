<?php

/**
 * 物流跟踪查询
 *
 * @author: moxiaobai
 * @since : 2016/5/13 11:48
 */

class Express_Tracking {

    static $_state = array(
        0 => '在途',
        1 => '揽件',
        2 => '疑难',
        3 => '签收',
        4 => '退签',
        5 => '派件',
        6 => '退回',
    );

    /**
     * 物流查询
     * @param $num    订单号
     * @return bool|mixed
     */
    public static function query($num) {
        $com = Express_Company::getCode($num);
        if(!$com) {
            return false;
        }

        $post_data = array();
        $post_data["customer"] = Express_Config::CUSTOMER;
        $post_data["param"] = '{"com":"' . $com . '","num":"' . $num . '"}';

        $url='http://poll.kuaidi100.com/poll/query.do';

        $key= Express_Config::KEY;
        $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
        $post_data["sign"] = strtoupper($post_data["sign"]);
        $o="";
        foreach ($post_data as $k=>$v) {
            $o.= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($ch);


        $data = str_replace("\&quot;",'"',$result);
        $data = json_decode($data,true);

        if($data) {
            $returnCode = isset($data['returnCode']) ? $data['returnCode'] : 0;
            if($returnCode > 200) {
                return false;
            } else {
                $data['stateStatus'] = self::$_state[$data['state']];
            }
        } else {
            return false;
        }
        return $data;
    }
}