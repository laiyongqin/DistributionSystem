<?php

/**
 * 图片水印类
 * @author lindexin
 * @since  2016年4月6日
 */
class Images_Water{
    private $image;
    private $file_image;
    private $img_info;
    private $img_width;
    private $img_height;
    private $img_im;
    private $img_text;
    private $img_ttf='';
    private $img_new;
    private $img_text_size;
    private $img_jd;
    private $img_location_x;
    private $img_location_y;
    private $date_location_x;
    private $date_location_y;
    private $date;

    function __construct(){

    }

    function img($img='',$filename='',$txt='',$ttf='',$size=12,$jiaodu=0,$site_x='',$site_y='',$date_x='',$date_y='',$date_time=""){
        if(isset($img)&&fopen($img,'r')){//检测图片是否存在
            $this->image =$img;
            $this->img_text=$txt;
            $this->img_text_size=$size;
            $this->img_jd=$jiaodu;
            $this->file_image=$filename;
            $this->img_location_x=$site_x;
            $this->img_location_y=$site_y;
            $this->date_location_x=$date_x;
            $this->date_location_y=$date_y;
            $this->date=$date_time;
            if(fopen($ttf,'r')){
                $this->img_ttf=$ttf;
            }else{
                exit('字体文件：'.$ttf.'不存在！');
            }
            $this->imgyesno();
        }else{
            exit('图片文件:'.$img.'不存在');
        }
    }
    private function imgyesno(){
        copy($this->image,$this->file_image);
        $this->img_info =getimagesize($this->file_image);
        $this->img_width =$this->img_info[0];//图片宽
        $this->img_height=$this->img_info[1];//图片高

        //检测图片类型
        switch($this->img_info[2]){
            case 1:$this->img_im = imagecreatefromgif($this->file_image);break;
            case 2:$this->img_im = imagecreatefromjpeg($this->file_image);break;
            case 3:$this->img_im = imagecreatefrompng($this->file_image);break;
            default:exit('图片格式不支持水印');
        }
        $this->img_text();
    }

    private function img_text(){
        imagealphablending($this->img_im,true);
        //设定颜色
        $color=imagecolorallocate($this->img_im,27,27,27);
        $txt_height=$this->img_text_size;
        $txt_jiaodu=$this->img_jd;

        $txt_x =$this->img_location_x;
        $txt_y =$this->img_location_y;
        $time_x =$this->date_location_x;
        $time_y =$this->date_location_y;
        @imagettftext($this->img_im,$txt_height,$txt_jiaodu,$txt_x,$txt_y,$color,$this->img_ttf,$this->img_text);
        @imagettftext($this->img_im,$txt_height,$txt_jiaodu,$time_x,$time_y,$color,$this->img_ttf,$this->date);
        @unlink($this->file_image);//删除图片

        //生成图片渲染到页面
        switch($this->img_info[2]) {
            case 1:
                header('Content-type: image/gif');
                imagegif($this->img_im);break;
            case 2:
                header('Content-Type: image/jpeg');
                imagejpeg($this->img_im);
                break;
            case 3:
                header('Content-type: image/png');
                imagepng($this->img_im);
                break;
            default: exit('水印图片失败');
        }

        unset($this->img_info);
        imagedestroy($this->img_im);
    }
}