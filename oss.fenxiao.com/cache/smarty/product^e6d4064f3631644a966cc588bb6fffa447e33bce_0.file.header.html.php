<?php /* Smarty version 3.1.27, created on 2016-08-29 15:07:42
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/common/header.html" */ ?>
<?php
/*%%SmartyHeaderCode:88223921357c3df3ed25c85_07806064%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6d4064f3631644a966cc588bb6fffa447e33bce' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/common/header.html',
      1 => 1471422163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88223921357c3df3ed25c85_07806064',
  'variables' => 
  array (
    'pageTitle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c3df3ed3fd90_29990532',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c3df3ed3fd90_29990532')) {
function content_57c3df3ed3fd90_29990532 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '88223921357c3df3ed25c85_07806064';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/public/css/bootstrap-customfile.css" />
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/public/css/bootstrap-datetimepicker.css" />
    <?php echo '<script'; ?>
 src="/public/js/jquery.12.0.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/Headroom.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/Validform_v5.3.2_min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/jquery.artDialog-4.1.7.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/common.js"><?php echo '</script'; ?>
>
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="/public/js/jquery.12.0.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <?php echo '<script'; ?>
 src="/public/js/bootstrap-datetimepicker.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/js/bootstrap-datetimepicker.zh-CN.js"><?php echo '</script'; ?>
>
</head>


<body>
<div class="menu_nav">
    <a href="/"><div class="logo"></div></a>
    <div class="btn-group pull-right" id="yonghu">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            管理员：<?php echo @constant('A_REALNAME');?>
 <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="/index/password/" data-toggle="modal" data-target="#passportModal">修改密码</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/login/logout/">退出系统</a></li>
        </ul>
    </div>
</div>

<form class="form-horizontal" action="/ajax/passport/password/" method="post">
    <div class="modal fade" id="passportModal" tabindex="-1" role="dialog" aria-labelledby="passportModalLabel"></div>
</form><?php }
}
?>