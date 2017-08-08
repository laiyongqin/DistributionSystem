<?php

/**
 * 地理位置接口(百度地图)
 *
 * @author: moxiaobai
 * @since : 2016/2/1 12:14
 */

class Helper_Map {

    const AK = '4KxvdO9TGsPESnr17HorRxk4nD9gHPWO';
    const SK = 'kOdrjduVKuofvsP2NsqfQG8SzW6L3u9E';

    /**
     * 根据位置获取经度和纬度
     *
     * @param $address
     * @return array|bool
     */
    public static function getLocation($address) {
        //API控制台申请得到的ak（此处ak值仅供验证参考使用）
        $ak = Helper_Map::AK;

        //应用类型为for server, 请求校验方式为sn校验方式时，系统会自动生成sk，可以在应用配置-设置中选择Security Key显示进行查看（此处sk值仅供验证参考使用）
        $sk = Helper_Map::SK;

        //以Geocoding服务为例，地理编码的请求url，参数待填
        $url = "http://api.map.baidu.com/geocoder/v2/?address=%s&output=%s&ak=%s&sn=%s";

        //get请求uri前缀
        $uri = '/geocoder/v2/';

        //地理编码的请求output参数
        $output = 'json';

        //构造请求串数组
        $querystring_arrays = array (
            'address' => $address,
            'output' => $output,
            'ak' => $ak
        );

        //调用sn计算函数，默认get请求
        $sn = self::caculateAKSN($ak, $sk, $uri, $querystring_arrays);

        //请求参数中有中文、特殊字符等需要进行urlencode，确保请求串与sn对应
        $target = sprintf($url, urlencode($address), $output, $ak, $sn);


        $ret = self::curlGet($target);

        $ret = json_decode($ret, true);
        if($ret['status'] == 0) {
            $location = $ret['result']['location'];
            return array('latitude'=>$location['lat'], 'longitude'=>$location['lng']);
        } else {
            return false;
        }
    }

    /**
     * 根据经度纬度获取位置
     *
     * @param $location
     * @return array|bool
     */
    public static function getAddress($location) {
        $ak = Helper_Map::AK;
        $sk = Helper_Map::SK;

        $url = "http://api.map.baidu.com/geocoder/v2/?location=%s&output=%s&ak=%s&sn=%s";

        $uri = '/geocoder/v2/';
        $output = 'json';

        //构造请求串数组
        $querystring_arrays = array (
            'location' => $location,
            'output'   => $output,
            'ak'       => $ak
        );

        //调用sn计算函数，默认get请求
        $sn = self::caculateAKSN($ak, $sk, $uri, $querystring_arrays);

        //请求参数中有中文、特殊字符等需要进行urlencode，确保请求串与sn对应
        $target = sprintf($url, urlencode($location), $output, $ak, $sn);

        $ret = self::curlGet($target);
        $ret = json_decode($ret, true);
        if($ret['status'] == 0) {
            return array(
                'address'  =>  $ret['result']['formatted_address'],
                'province' =>  $ret['result']['addressComponent']['province'],
                'city'     =>  $ret['result']['addressComponent']['city'],
                'district' =>  $ret['result']['addressComponent']['district'],
                'street'   => $ret['result']['addressComponent']['street'],
            );
        } else {
            return false;
        }
    }

    public static function caculateAKSN($ak, $sk, $url, $querystring_arrays, $method = 'GET')
    {
        if ($method === 'POST'){
            ksort($querystring_arrays);
        }
        $querystring = http_build_query($querystring_arrays);
        return md5(urlencode($url.'?'.$querystring.$sk));
    }

    public static function curlGet($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }
}