<?php

 /**
  * 图像处理类
  */
class Images_Handle{

	/**
	 * 将图片按比例缩放
	 * @param $srcImage  图片原路径
	 * @param $saveImage 存储图片路径
	 * @param $w  最大宽度
	 * @param $h  最大高度
	 * @param $mode 正常情况等比例缩放要宽高中最大值，  mode=2按照宽高中最小值缩放
	 */
	function zoomAutoImages($srcImage, $saveImage, $w, $h, $mode=1){
		
		//初始化
		$image  = new Imagick();
		$image->readImage($srcImage);

		//获得原图片宽度高度
		$srcWH  = $image->getImageGeometry();
		$width  = $srcWH['width'];
		$height = $srcWH['height'];
		
		//宽高比 和 高宽比
		$whra  = number_format(($width/$height),1);
        $hwra  = number_format(($height/$width),1);

        //新图宽高
        $newwidth  = $width;
        $newheight = $height;
        if($width > $w || $height > $h){
        	if ($mode == 1) {
	        	if ($width < $height) {
	        		$newheight = $h;
	             	$newwidth  = ceil($newheight/$hwra);
	        	}else{
	        		$newwidth  = $w;
	             	$newheight = ceil($newwidth/$whra);
	        	}
	        } else {
	        	if ($width < $height) {
	        		$newwidth  = $w;
	             	$newheight = $newwidth * $hwra;
	        	}else{
	        		$newheight = $h;
	             	$newwidth  = $newheight * $whra;
	        	}
	        }
        }

        $image_format = strtolower($image->getImageFormat());
		if($image_format=='gif'){
        	/* 若是GIF动画则处理每一帧 */
			$unitl = $image->getNumberImages();           
			for ($i=0; $i<$unitl; $i++) {    
			    $image->setImageIndex($i);   
			    $image->thumbnailImage( $newwidth, $newheight , true); 
			}
			$image->writeImages($saveImage.'.gif', true);
			rename($saveImage.'.gif',$saveImage);
        }else{
        	$image->thumbnailImage( $newwidth, $newheight );
			$image->setImageFileName($saveImage);
			$image->writeImage();
        }
	}


	/**
	 * 先将图片按宽度比例缩放,之后裁剪指定大小
	 * @param $srcImage  图片原路径
	 * @param $saveImage 存储图片路径
	 * @param $w  宽度
	 * @param $h  高度
	 */
	function zoomWidthCut($srcImage,$saveImage,$w,$h){
		//初始化
		$image  = new Imagick();
		$image->readImage($srcImage);

		//获得原图片宽度高度
		$srcWH  = $image->getImageGeometry();
		$width  = $srcWH['width'];
		$height = $srcWH['height'];
		
		//宽高比 和 高宽比
		$whra  = number_format(($width/$height),1);

        //新图宽高
        $newwidth  = $width;
        $newheight = $height;

        //缩放
        if($width>$w){
        	$newwidth  = $w;
            $newheight = ceil($newwidth/$whra);
            $image->thumbnailImage( $newwidth, $newheight, true );
        }
        
		//裁剪
		$image = $image->coalesceImages();
		$canvas= new Imagick();
		foreach($image as $frame){   
			$img = new Imagick();   
			$img->readImageBlob($frame); 
			$img->cropImage($w, $h, 0, 0);   
			$canvas->addImage( $img );   
			$canvas->setImageDelay( $img->getImageDelay() );   
			$canvas->setImagePage($w, $h, 0, 0);   
		}  
		$image = $canvas; 

		$image->setImageFileName($saveImage);
		$image->writeImage();
	}
    
	/**
	 * 先将图片按高度比例缩放,之后裁剪指定大小
	 * @param $srcImage  图片原路径
	 * @param $saveImage 存储图片路径
	 * @param $w  宽度
	 * @param $h  高度
	 */
	function zoomHeightCut($srcImage,$saveImage,$w,$h){
		//初始化
		$image  = new Imagick();
		$image->readImage($srcImage);

		//获得原图片宽度高度
		$srcWH  = $image->getImageGeometry();
		$width  = $srcWH['width'];
		$height = $srcWH['height'];
		
		//宽高比 和 高宽比
		$whra  = number_format(($height/$width),1);

        //新图宽高
        $newwidth  = $width;
        $newheight = $height;

        //缩放
        if($height>$h){
        	$newheight  = $h;
            $newwidth = ceil($newheight/$whra);
            $image->thumbnailImage( $newwidth, $newheight, true );
        }
        
		//裁剪
		$image = $image->coalesceImages();
		$canvas= new Imagick();
		foreach($image as $frame){   
			$img = new Imagick();   
			$img->readImageBlob($frame); 
			$img->cropImage($w, $h, 0, 0);   
			$canvas->addImage( $img );   
			$canvas->setImageDelay( $img->getImageDelay() );   
			$canvas->setImagePage($w, $h, 0, 0);   
		}  
		$image = $canvas; 

		$image->setImageFileName($saveImage);
		$image->writeImage();
	}

	/**
	 * 智能裁剪(自动缩放到合适的尺寸在裁剪图片)
	 * @param $srcImage  图片原路径
	 * @param $saveImage 存储图片路径
	 * @param $w  宽度
	 * @param $h  高度
	 */
	function autoZommCut($srcImage,$saveImage,$w,$h){
	
		//初始化
		$image  = new Imagick();
		$image->readImage($srcImage);

		//获得原图片宽度高度
		$srcWH  = $image->getImageGeometry();
		$width  = $srcWH['width'];
		$height = $srcWH['height'];
		
		//宽高比 和 高宽比
		$whra  = number_format(($width/$height),1);
        $hwra  = number_format(($height/$width),1);

        //新图宽高
        $newwidth  = $width;
        $newheight = $height;

        //缩放
        if ($width < $height) {
    		$newheight = $h;
         	$newwidth  = ceil($newheight/$hwra);
    	}else{
    		$newwidth  = $w;
         	$newheight = ceil($newwidth/$whra);
    	}
    	//补齐
        if($newwidth<=$w){
        	$newwidth   = $w;
        	$newheight  = $newwidth*$hwra;
        }
        if($newheight<=$h){
        	$newheight  = $h;
        	$newwidth   = $newheight*$whra;
        }

        //计算裁剪中间位置
        $x = ($newwidth  - $w)/2;
        $y = ($newheight - $h)/2;

        //缩放
        $image->thumbnailImage( $newwidth, $newheight, true );

        //裁剪
		$image = $image->coalesceImages();
		$canvas= new Imagick();
		foreach($image as $frame){   
			$img = new Imagick();   
			$img->readImageBlob($frame); 
			$img->cropImage($w, $h, $x, $y);   
			$canvas->addImage( $img );   
			$canvas->setImageDelay( $img->getImageDelay() );   
			$canvas->setImagePage($w, $h, 0, 0);   
		}  
		$image = $canvas;

        $image->setImageFileName($saveImage);
		$image->writeImage();
	}

   /**
	* 缩放图像
	* @param $srcImage  原图
	* @param $desImage  目标图地址
	* @param $objWidth  宽度
	* @param $objHeight 高度
	*/
	function zoom($srcImage,$desImage,$objWidth, $objHeight){
	   $image = new Imagick ( $srcImage );
	   $image = $image->coalesceImages ();
	   foreach($image as $frame){   
	               $frame->thumbnailImage ( $objWidth, $objHeight , true);
	        }  
	   return $image->writeImages ( $desImage , true );
	}

	/**
	 * 剪切图片
	 * @param $srcImage  原图
	 * @param $saveImage 新图地址
	 * @param $w  宽度
	 * @param $h  高度
	 * @param $x  上边距
	 * @param $y  下边距
	 */
	function Cut($srcImage,$saveImage,$w,$h,$x,$y){
		$canvas= new Imagick();
		$image = new Imagick ( $srcImage );
		$image = $image->coalesceImages ();
		foreach($image as $frame){   
			$img = new Imagick();   
			$img->readImageBlob($frame); 
			$img->cropImage($w, $h, $x, $y);   
			$canvas->addImage( $img );   
			$canvas->setImageDelay( $img->getImageDelay() );   
			$canvas->setImagePage($w, $h, 0, 0);   
		}  
		$image = $canvas;
		return $image->writeImages($saveImage , true);
	}


	/**
	 * 给图片加上水印
	 * 
	 * @param $srcImage 地址(不能用网络地址)
	 * @param offset    
	 * 			tb  => 水印的上下间距,
	 *			rl  => 水印的左右间距,
	 * 			set => 水印位置(可选:GRAVITY_NORTHWEST,GRAVITY_NORTH,GRAVITY_EASNORTHT,
	 *								 GRAVITY_WEST,GRAVITY_CENTER,GRAVITY_EAST,GRAVITY_SOUTHWEST,
	 *								 GRAVITY_SOUTH,:GRAVITY_SOUTHEAST)
	 *			waterImg => 水印图片地址(不传则用默认水印)
	 * @example
	 *	$images = new Images_Handle();
     *  $offset = array('tb'=>10,'rl'=>10,'set'=>Imagick::GRAVITY_SOUTHEAST);
     *  $images->DrawImg($path1,$offset);
	 */
	function DrawImg($srcImage,$offset=array('tb'=>3,'rl'=>10,'set'=>Imagick::GRAVITY_SOUTHEAST)){

		if(!isset($offset['waterImg'])){
			$offset['waterImg'] = ini_get('yaf.library').'/Images/waterImg.png';
		}

		$image  = new Imagick($srcImage);
		$water  = new Imagick($offset['waterImg']);

		/* 水印设置 */
		$water->setImageFormat("png");
		$water->thumbnailImage( 150, null );
		//$shadow = $water->clone();
        $shadow = clone $water;
		//$shadow->setImageBackgroundColor( new ImagickPixel( 'black' ) );
  		$shadow->shadowImage( 100, 3, 5, 5 );
  		$shadow->compositeImage( $water, Imagick::COMPOSITE_OVER, 0, 0 );
 
  		$water = $shadow;
  		//$water->setImageOpacity(0.9);

		/* 合并 */
		$canvas = new ImagickDraw();  
		//$canvas->color(0,0,imagick::PAINT_FLOODFILL);   
		$canvas->setGravity($offset['set']);//设置位置
		$canvas->composite($water->getImageCompose(),$offset['rl'],$offset['tb'],0,0,$water);
		
		$image->drawImage($canvas);

		$image->writeImage($srcImage);
		//header( "Content-Type: image/{$image->getImageFormat()}" );   
		//echo $image;
	}

}