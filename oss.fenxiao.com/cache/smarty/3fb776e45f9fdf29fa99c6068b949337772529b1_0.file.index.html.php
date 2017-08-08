<?php /* Smarty version 3.1.27, created on 2016-09-07 15:52:32
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/help/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:38865878657cfc740a8e938_16780882%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fb776e45f9fdf29fa99c6068b949337772529b1' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/help/index.html',
      1 => 1469589746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38865878657cfc740a8e938_16780882',
  'variables' => 
  array (
    'breadTitle' => 0,
    'data' => 0,
    'vo' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cfc740af9a21_53875515',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cfc740af9a21_53875515')) {
function content_57cfc740af9a21_53875515 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '38865878657cfc740a8e938_16780882';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">帮助文档 </a></li>
            <li class="active"><?php echo $_smarty_tpl->tpl_vars['breadTitle']->value;?>
</li>
        </ol>

        <div class="right_con">
            <div class="new_list">
                <ul>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                    <li>
                        <a href="/help/detail?id=<?php echo $_smarty_tpl->tpl_vars['vo']->value['n_id'];?>
">
                            <div class="title"><?php echo $_smarty_tpl->tpl_vars['vo']->value['n_title'];?>
</div>
                            <div class="time"><?php echo $_smarty_tpl->tpl_vars['vo']->value['n_addtime'];?>
</div>
                        </a>
                    </li>
                    <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                    <?php }?>

                </ul>
                <div class="clear"></div>
            </div>

        </div>
        <!-- 分页 -->
        <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
        <nav>
            <ul class="pagination pull-right"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</ul>
        </nav>
        <?php }?>
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