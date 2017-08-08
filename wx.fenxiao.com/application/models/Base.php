<?php

/**
 * 数据库模式基类
 * 
 * @author xiaogang
 * @since  2012-11-12
 */

class BaseModel extends ExpandModel {

    protected $_db;
    protected $_table;
    protected $_primary_key;

    const AUTH_KEY = 'M@x^@!e@($';

    public function __construct($database, $table, $primaryKey)
    {
        $this->_db             = $this->linkdb($database);
        $this->_table          = $table;
        $this->_primary_key   = $primaryKey;
    }

    /**
     * 载入modules下的model类(注意大小写)
     *
     * @param string $class_name   类名称
     * @param array  $param        参数
     * @param string $module_name 模块名称
     * @return
     */
    protected function loadModel($class_name,$param=array(),$module_name=false){
        if(!$module_name){
            exit('Module Name Not Set');
        }
        $class_name  = ucwords($class_name);

        $key   = "{$module_name}[{$class_name}]";
        $model = Yaf_Registry::get($key);

        //Is model has instance.
        if ( ! $model ) {
            //Is model file exists.
            $model_file = APP_PATH . '/application/modules/' . $module_name . '/models/' . $class_name.'.php';
            if ( ! file_exists( $model_file ) )
                exit('Model file not exists: ' . $model_file);

            require $model_file;

            $code_str = "";
            foreach ($param as $key => $value) {
                $code_str.='$param['.$key.'],';
            }
            if($code_str!=""){
                $code_str=substr($code_str,0,-1);
            }
            $class_name = $class_name . 'Model';
            $code_str    = '$model = new '.$class_name.'('.$code_str.');';
            eval($code_str);
            Yaf_Registry::set($key, $model);

            if( ! defined('MODULES_NAME') ) {
                define('MODULES_NAME', $module_name);
            }
        }
        return $model;
    }
}