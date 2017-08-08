<?php /* Smarty version 3.1.27, created on 2016-11-25 17:53:01
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/news/details.html" */ ?>
<?php
/*%%SmartyHeaderCode:1733075642583809fd954608_89375442%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e25627474dcbecd464c0f7978693f0a937c65086' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/news/details.html',
      1 => 1473234233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1733075642583809fd954608_89375442',
  'variables' => 
  array (
    'data' => 0,
    'signPackage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583809fda0c308_00924536',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583809fda0c308_00924536')) {
function content_583809fda0c308_00924536 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1733075642583809fd954608_89375442';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>公告详情</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>

<body>

<div class="news-nav">
    <a href="/"><i class="icon iconfont">&#xe617;</i><p>返回首页</p></a>
</div>

<div class="news-show">
    <div class="show-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['n_title'];?>
</div>
    <div class="show-content">
        <?php echo $_smarty_tpl->tpl_vars['data']->value['n_content'];?>

    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var appId      = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['appId'];?>
';var timestamp = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['timestamp'];?>
';
    var nonceStr   = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['nonceStr'];?>
';var signature = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['signature'];?>
';
    var nid        = '<?php echo $_smarty_tpl->tpl_vars['data']->value['n_id'];?>
';
    var title      = "<?php echo $_smarty_tpl->tpl_vars['data']->value['n_title'];?>
";
    var main_title = '【上善网络】' + title;
    var link       = "<?php echo @constant('APP_DOMAIN');?>
";
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    wx.config({
        appId: appId,
        timestamp:timestamp,
        nonceStr: nonceStr,
        signature: signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ'
        ]
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/news/details/id/" + nid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['n_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });

        wx.onMenuShareAppMessage({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/news/details/id/" + nid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['n_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });

        wx.onMenuShareQQ({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/news/details/id/" + nid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['n_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });
    });

    //分享回调数据
    function getShareBack(){
        //分享完成 回调数据
    }
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>