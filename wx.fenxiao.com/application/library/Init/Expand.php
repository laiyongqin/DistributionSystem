<?php

/**
 * 全局扩展
 * Class Init_Expand
 *
 * @author moxiaobai(mlkom@live.com)
 * @since  2015.12.03
 */
class Init_Expand{}

/* 控制器方法 */
class ExpandController extends Yaf_Controller_Abstract {

	public $api = null;

	/**
	 * 调用api接口
	 * @param $site  站点前缀
	 * @param $class 类名称
	 */
    function api($site,$class, $type='serial'){
        $key = $site . '_' . $class;
        if(!isset($this->api[$key])){
            $this->api[$key] = new Yar_Api($site, $class,$type);
        }
        return $this->api[$key];
    }

    function yarServer($model) {
        $service = new Yar_Server($model);
        $service->handle();
        return;
    }

	/**
	 * 断点调试
	 * @param $message  内容
	 * @param $isexit   是否中断
	 */
	function debug($message, $isexit=false){
		if(!APP_DEBUG){
			return false;
		}
		echo '<pre style="font-family: Microsoft YaHei;background:#9999CC;color:#fff;padding:0.5em 0.5em;border-bottom: #333366 1px solid;border-top: #333366 1px solid;">';
		print_r($message);
		echo "</pre>";
		if($isexit===true){
			exit;
		}
	}

	/**
	 * 显示404页面
	 */
	function show404() {
		Header("HTTP/1.1 404 Not Found");
		$this->getView()->setScriptPath(APP_PATH. '/application/views/');
        $this->getView()->display('error/error.html');
        exit();
	}
}

/* 模型方法 */
class ExpandModel{

	static  $_instance = array();
	private $Memcache_Db;
    private $mongoDb;
	private $Redis_Db;
    private $Mysql_db;
	private $api = null;

	/**
	 * 调用api接口
	 * @param $site  站点前缀
	 * @param $class 类名称
	 */
	protected function api($site,$class, $type='serial'){
        $key = $site . '_' . $class;
        if(!isset($this->api[$key])){
            $this->api[$key] = new Yar_Api($site, $class,$type);
        }
        return $this->api[$key];
	}

	/**
	 * 断点调试
	 * @param $message  内容
	 * @param $isexit   是否中断
	 */
	protected function debug($message,$isexit=false){
		if(!APP_DEBUG){
			return false;
		}
		echo '<pre style="font-family: Microsoft YaHei;background:#9999CC;color:#fff;padding:0.5em 0.5em;border-bottom: #333366 1px solid;border-top: #333366 1px solid;">';
		print_r($message);
		echo "</pre>";
		if($isexit===true){
			exit;
		}
	}

	/**
	 * 数据库链式sql操作
	 *
	 * @return Db_LinkMySQL
	 */
	protected function linkdb($database){
        if(!$database) {
            exit("Missing the database configuration");
        }

		if(!$this->Mysql_db) {
            $this->Mysql_db = Db_LinkMySQL::get($database);
        }

        return $this->Mysql_db;
	}

	/**
	 * memcache
	 */
	protected function memcache($project=null){
		if(!$this->Memcache_Db){
			$this->Memcache_Db = new Cache_Memcache($project);
		}
		return $this->Memcache_Db;
	}

	/**
	 * redis
	 */
	protected function redis($project=null){
		if(!$this->Redis_Db){
			$this->Redis_Db = new Cache_Redis($project);
		}
		return $this->Redis_Db;
	}

    /**
     * 实例化MongoDb
     *
     * @param string $db
     * @return Db_MongoDB
     */
	protected function mongodb($database) {
		if(!$database) {
			exit("Missing the Mongodb configuration");
		}

        if(!$this->mongoDb) {
            $this->mongoDb = Db_MongoDB::get($database);
        }
        return $this->mongoDb;
    }

	/**
	 * 返回结果
	 * @param $status 状态值
	 * @param $msg 提示信息
	 * @param $result 操作结果
	 */
	protected function result( $code=1, $data='' ){
		return array( 'code'=>$code, 'data'=>$data );
	}

	/**
     * 返回单例对象
     * @return object
     */
    static public function getInstance() {   
        $called_class_name = get_called_class();
        
        if ( ! isset( self::$_instance[$called_class_name] ) ) {
            self::$_instance[$called_class_name] = new $called_class_name();
        }
        
        return self::$_instance[$called_class_name];
    }
}

class Yar_Api {

    private $site;
    private $model;
    private $type;

    function __construct($controller, $action, $type='serial'){
        $this->site  = $controller;
        $this->model = $action;
        $this->type  = $type;
    }

    function __call($method, $params){
		$apiurl = APP_API . "/{$this->site}/{$this->model}";

        try {
            if($this->type == 'serial') {
                $this->apiObject = new Yar_Client($apiurl);
                $result = call_user_func_array(array($this->apiObject, $method), $params);
                return $result;
            } else if ($this->type == 'sync') {
                Yar_Concurrent_Client::call($apiurl, $method, $params);
            }
        } catch (Exception $e) {
            if(APP_DEBUG==true){
                $message = "API:{$e->getMessage()} ";
                $file    = $e->getFile();
                $errarr  = array(
                    '#调用YAF接口时产生错误',
                    '#url:'.$apiurl,
                    '#function:'.$method,
                    '#param:'
                );
                $errarr  = array_merge($errarr,$params);
            }else{
                return false;
            }
        }
        return false;
    }
}