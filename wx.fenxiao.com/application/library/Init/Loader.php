<?php

/**
 * Init_Loader  加载文件
 *
 * @category Library
 * @package  Core
 * @author   moxiaobai(@mlkom@live.com)
 * @version  1.0  
 */
class Init_Loader {

    /**
     * 加载指定配置文件返回文件列表数组
     * 
     * @param object $config  Yaf Config object
     * @param string $index   加载指定索引
     *
     * @access public
     * @static
     *
     * @return array  文件列表数组
     */
	public static function files($config, $indexs=array()) {
		$config = $config->toArray();
		$files  = array();

		//若有存在全局文件，优先加载
		if ( isset( $config['common'] ) ) {
			foreach ( $config['common'] AS $file) {
				$files[] = ltrim($file, '/');
			}
		}

		if ( ! empty( $indexs ) ) {
			foreach ($indexs AS $index) {
				if ( ! is_array($config[$index]) ) {
					$files[] = ltrim($config[$index], '/');
				} else {
					foreach ( $config[$index] AS $file) {
						$files[] = ltrim($file, '/');
					}
				}
			}
		}

		return $files;
	}


    /**
     * 加载指定配置文件的版本号
     * 
     * @param object $config  Yaf Config object
     *
     * @access public
     * @static
     *
     * @return array  文件列表数组
     */
	public static function getVersion($config) {
		$config = $config->toArray();

		if ( isset( $config['version'] ) ) {
			return $config['version'];
		}
		return FALSE;
	}

    /**
     * 把文件转换成使用min格式的文件
     * 
     * @param mixed $files Description.
     *
     * @access public
     * @static
     *
     * @return array
     */
	public static function setMinFiles($files) {
		foreach ($files AS &$file) {
			if ( strpos($file, '.min') === FALSE ) {
				$temp = explode('.', $file);
				$ext  = array_pop($temp);
				$file = implode('.', $temp) . '.min.' . $ext;
			}
		}
		return $files;
	}


	/**
     * 加载指定CSS配置文件返回需要的CSS字符串
     * 
     * @param string  $index   加载指定索引
     * @param boolean $return  默认FALSE，不打印，直接输入字符串，TRUE时返回字符串
     *
     * @access public
     * @static
     *
     * @return void|string
     */
	public static function css() {
		$config = new Yaf_Config_Ini(APP_PATH . "/config/css.ini");
        $indexs = func_get_args();

        $files  = self::files($config, $indexs);
        $version= self::getVersion($config);
        $version= ($version === FALSE) ?  '' : '?t='.$version;

		if ( empty($files) ) return FALSE;

		$html = '';
		foreach( $files AS $file ) {
			$html .= '<link rel="stylesheet" href="' . FILE_URL . $file . $version .'"/>' . PHP_EOL;
		}
		echo $html;
	}


	/**
     * 加载指定JS配置文件返回需要的JS字符串
     *
     * @access public
     * @static
     *
     * @return void|string
     */
	public static function js() {
		$config = new Yaf_Config_Ini(APP_PATH . "/config/js.ini");
		$indexs = func_get_args();

        $files  = self::files($config, $indexs);

		if ( empty($files) ) return FALSE;
		$version= self::getVersion($config);
        $version= ($version === FALSE) ?  '' : '?t='.$version;

		$html = '';
		foreach( $files AS $file ) {
			$html .= '<script type="text/javascript" src="' . FILE_URL . $file . $version .'"></script>' . PHP_EOL;
		}
		echo $html;
	}
}