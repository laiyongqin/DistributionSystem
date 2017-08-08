<?

/**
 * 时间格式化
 */
class Helper_DateFormat {

    /**
     * 过去式时间
     * @param $time 时间戳
     * @return mixed
     */
    static function agotime($time) {
        $diff =  time() - $time;
        if ($diff<60)
            return $diff . "秒前";
        $diff = round($diff/60);
        if ($diff<60)
            return $diff . "分钟前";
        $diff = round($diff/60);
        if ($diff<24)
            return $diff . "小时前";
        $diff = round($diff/24);
        if ($diff<7)
            return $diff . "天前";
        $diff = round($diff/7);
        if ($diff<4)
            return $diff . "周前";
        $diff = round($diff/4);
        if($diff < 12) 
            return $diff . '月前';
        return date("Y-m-d H:i:s", $time);
    }

	/**
     * 剩余时间
     */
    static function overtime($begin_time,$end_time) {
    	 if($begin_time < $end_time){
            $starttime = $begin_time;
            $endtime   = $end_time;
         }else{
            $starttime = $end_time;
            $endtime   = $begin_time;
         }
         $timediff = $endtime-$starttime;
         $days     = intval($timediff/86400);
         $remain   = $timediff%86400;
         $hours    = intval($remain/3600);
         $remain   = $remain%3600;
         $mins = intval($remain/60);
         $secs = $remain%60;
         //$res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
    	 $str = "";
    	 if($days){
    		$str.= $days.'天';
    	 }
    	 if($hours){
    		$str.= $hours.'时';
    	 }
    	 if($mins){
    		$str.= $mins.'分';
    	 }
    	 if($secs){
    		$str.= $secs.'秒';
    	 }
         return $str;
    }

    /**
     * 时间转为周几
     * @param $time 时间
     * @return mixed
     */
    function getWeekDay($time){
        $week = date("w",strtotime($time));
        switch($week){
            case 1:
                return "周一";
                break;
            case 2:
                return "周二";
                break;
            case 3:
                return "周三";
                break;
            case 4:
                return "周四";
                break;
            case 5:
                return "周五";
                break;
            case 6:
                return "周六";
                break;
            case 0:
                return "周日";
                break;
        }
    }

}