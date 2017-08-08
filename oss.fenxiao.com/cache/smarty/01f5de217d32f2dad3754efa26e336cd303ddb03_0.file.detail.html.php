<?php /* Smarty version 3.1.27, created on 2016-09-07 15:54:09
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/help/detail.html" */ ?>
<?php
/*%%SmartyHeaderCode:101427504257cfc7a1d457c7_45281323%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01f5de217d32f2dad3754efa26e336cd303ddb03' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/help/detail.html',
      1 => 1469589746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101427504257cfc7a1d457c7_45281323',
  'variables' => 
  array (
    'breadTitle' => 0,
    'detail' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cfc7a1da2cc5_03907986',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cfc7a1da2cc5_03907986')) {
function content_57cfc7a1da2cc5_03907986 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '101427504257cfc7a1d457c7_45281323';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/">管理首页 </a></li>
            <li class="active"><?php echo $_smarty_tpl->tpl_vars['breadTitle']->value;?>
</li>
        </ol>

        <div class="right_con">
            <div class="list_show">
                <div class="title">
                    <h4><?php echo $_smarty_tpl->tpl_vars['detail']->value['n_title'];?>
</h4>
                    <div class="time"><?php echo $_smarty_tpl->tpl_vars['detail']->value['n_addtime'];?>
 <a href="/help/index">返回列表</a></div>
                </div>
                <div class="con">
                    <?php echo $_smarty_tpl->tpl_vars['detail']->value['n_content'];?>

                </div>
            </div>
        </div>

        <!--弹窗区域-->
        <?php echo $_smarty_tpl->getSubTemplate ("index/modal.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    </div>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>