<?php /* Smarty version 3.1.27, created on 2016-08-20 16:20:03
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/qrcode/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:64686036457b812b3764106_79509962%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fc91e6edc32e7896a271ec16fef7beec49b9135' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/qrcode/index.html',
      1 => 1471680222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64686036457b812b3764106_79509962',
  'variables' => 
  array (
    'pageTitle' => 0,
    'file' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b812b37b96d7_96767634',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b812b37b96d7_96767634')) {
function content_57b812b37b96d7_96767634 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '64686036457b812b3764106_79509962';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div class="ewm">
    <img src="<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
">
</div>

</body>
</html>
<?php }
}
?>