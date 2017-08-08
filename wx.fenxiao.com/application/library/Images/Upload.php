<?php

 /**
  * 文件上传类
  * @author xiaocai
  * @since  2013年3月8日
  */
class Images_Upload{
	private $Files;
	private $Files_type;
	private $Check_Size;
	private $Check_type;
	private $width;
	private $height;
	private $getAllSuffix;

	private $is_check_type = TRUE;

	function __construct($Files=false){
		if($Files){
			$this->setFiles($Files);
		}
	}

	/**
	 * 设置Files对象
	 * @param $Files $_Files
	 */
	function setFiles($Files){
		$this->Files = $Files;
		return $this;
	}

	/**
	 * 设置最大大小
	 * @param $size 大小(kb)
	 */
	function setMaxSize($size){
		$this->Check_Size = $size*1024;
		return $this;
	}

	/**
	 * 设置最小图片宽高
	 * @param $width
	 * @param $height
	 */
	function setImageMinAttr($width, $height){
		$this->width = $width;
		$this->height= $height;
	}

	/**
	 * 文件类型
	 * @param $typeCode 指定允许上传的文件编码
	 */
	function setTypeCode($typeCode){
		if ( ! is_array($typeCode) ) {
			$typeCode = array( $typeCode );
		}
		$this->Check_type = array();
		foreach ($typeCode AS $type) {
			switch ($type) {
				case 'IMG':
					$this->Check_type[] = '255216,7173,13780,6677';
					//jpg,gif,png,bmp
					break;
				case 'OFFICE':
					$this->Check_type[] = '208207,4946,3453,8075';
					//(doc|xls|ppt),txt   8075可能是docx pptx xlsx  也可能是zip
					break;
				case 'CSV':
					$this->Check_type[] = '3453,4944,8383,4949,8383,5049,4951,3453';
					//(doc|xls|ppt),txt
					break;
				case 'FLASH':
					$this->Check_type[] = '6787';
					//(swf:6787)
					break;
				case 'ZIP':
				case 'RAR':
					$this->Check_type[] = '8297,8075';
					//(rar:8297, zip:8075)
				default:
					$this->Check_type[] = $type;
					break;
			}
		}
		$this->Check_type = implode(',', $this->Check_type);
		return $this;
	}


	function setNoTypeCode() {
		$this->is_check_type = FALSE;
	}

	/**
	 * 获得文件类型编码
	 *   (通过判断文件头部的前两个字节就能判断出文件的真实类型)
	 * @return String
	 */
	function getTypeCode(){
		if(empty($this->Files['tmp_name'])){
	  		return false;
		}
	    $file     = fopen($this->Files['tmp_name'], "rb");    
	    $strInfo  = @unpack("C2chars", fread($file, 2) );
	    $typeCode = intval($strInfo['chars1'].$strInfo['chars2']); 
	    fclose($file);
	    return $typeCode;
	}

	/**
	 * 返回图片属性
	 */	
	function getImageAttr() {
		return getimagesize($this->Files['tmp_name']);
	}

	/**
	 * 返回原始文件名称
	 */
	function getFileName(){
		return $this->Files['name'];
	}

	/**
	 * 返回文件后缀
	 */
	function getFileExt(){
		$suffix = explode('.', $this->Files['name']);
		$suffix = strtolower( array_pop( $suffix ) );
		return $suffix;
	}

	/**
	 *获取文件的扩展名
	 */
	function getAllFileExt($suffix){
		$this->getAllSuffix = explode(',', $suffix);
		return $this;
	}

	/**
	 * 判断是否有获取到文件扩展名
	 */
	function setNoFileExt() {
		if (isset($this->getAllSuffix) && $this->getAllSuffix !=null) {
			return FALSE;
		}else{
			return TRUE;
		} 
	}

	/**
	 * 上传文件
	 * @param $dir  文件夹
	 * @param $file 文件名
	 * @return true|false
	 */
	function upload($dir,$file){
		//验证
		$Check = $this->Check();
		if( $Check['status'] <= 0){
			return $Check;
		}

		//创建目录
		$newfilepath = APP_UPLOAD_DIR.$dir;
		if (!file_exists($newfilepath)){
		    $this->mk_dir( $newfilepath, 0755 );
		}

		//上传文件
		$newfilepath .= $file;
		if(copy($this->Files['tmp_name'],$newfilepath)){
		   return array(
			   	'status' => 1,
			   	'msg'    => 'SUCCESS',
			   	'file'   =>	$file,
			   	'path'   => $newfilepath,
			   	'dir'	 => $dir,
			   	'http'	 => APP_UPLOAD_URL.$dir.$file
		   	);
		}else{
		   return array('status'=>0,'msg'=>'ERROE_UPLOAD_FAILURE');
		}
	}

	/**
	 * 循环创建目录
	 */
	public function mk_dir($dir, $mode = 0755){
		if (is_dir($dir) || @mkdir($dir,$mode)){
			return true;
		}
		if (!$this->mk_dir(dirname($dir),$mode)){
			return false;
		}
		return mkdir($dir,$mode);
	}

	/**
	 * 检查上传文件合法性
	 * @param $fileSize 文件大小(默认5M)
	 */
	private function check(){
		if( empty($this->Files['size']) || 
			empty($this->Files['tmp_name']) || 
			!empty($this->Files['error'])) {
      		return array('status'=>-1,'msg'=>'ERROR_EMPTY');
    	}

    	if ( $this->is_check_type === TRUE ){
	    	if(!in_array($this->getTypeCode(), explode(',', $this->Check_type))){
	    		return array('status'=>-2,'msg'=>'错误的文件类型');
	    	}
	    }

    	if( $this->Files['size'] >= $this->Check_Size ){
    		return array('status'=>-3,'msg'=>'文件大小超过限制范围');
    	}

    	if ( $this->width AND $this->height ) {
    		$img = getimagesize($this->Files['tmp_name']);
    		if ( $img[0] < $this->width OR $img[1] < $this->height) {
    			return array('status'=>-4,'msg'=>'ERROR_IMAGEATTR');
    		}
    	}

    	if ( $this->setNoFileExt() === FALSE ){
    		if(!in_array($this->getFileExt(), $this->getAllSuffix )){
	    		return array('status'=>-5,'msg'=>'ERROR_FILEEXT');
	    	}
    	}
    	
    	

    	return array('status'=>1,'msg'=>'SUCCESS');
	}


}
