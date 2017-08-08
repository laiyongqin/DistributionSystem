<?php

/**
 * 临时素材
 * (对于临时素材，每个素材（media_id）会在开发者上传或粉丝发送到微信服务器3天后自动删除)
 *
 * @author: moxiaobai
 * @since : 2016/8/25 14:10
 */

class MediaModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_weixin_media', 'wm_id');
    }

    /**
     * 获取临时素材媒体ID
     *
     * @param $openId
     * @param $type
     * @return mixed
     */
    public function getMedia($openId,$type) {
        $currentTime = date('Y-m-d H:i:s', strtotime("-3 days"));

        return $this->_db->select('wm_media_id')->from('t_weixin_media')->where('open_id',$openId)->where('wm_type',$type)->where("wm_addtime > '{$currentTime}'")->fetchValue();
    }

    /**
     * 更新媒体ID
     * @param $openId
     * @param $type
     * @param $media
     * @return mixed
     */
    public function updateMedia($openId,$type,$media) {
        $ret = $this->_db->select('wm_id')->from('t_weixin_media')->where('open_id',$openId)->where('wm_type',$type)->fetchValue();
        if($ret) {
            $rows = array(
                'wm_media_id' => $media,
                'wm_addtime'  => date('Y-m-d H:i:s')
            );

            return $this->_db->update('t_weixin_media')->where('wm_id',$ret)->rows($rows)->execute();
        } else {
            $rows = array(
                'open_id'     => $openId,
                'wm_type'     => $type,
                'wm_media_id' => $media,
                'wm_addtime'  => date('Y-m-d H:i:s')
            );
            return $this->_db->insert('t_weixin_media')->rows($rows)->execute();
        }
    }
}