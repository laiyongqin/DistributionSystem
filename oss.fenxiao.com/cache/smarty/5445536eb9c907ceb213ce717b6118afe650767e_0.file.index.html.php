<?php /* Smarty version 3.1.27, created on 2016-09-07 15:46:06
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/right/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:47664782157cfc5be96f045_43701070%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5445536eb9c907ceb213ce717b6118afe650767e' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/right/index.html',
      1 => 1471846512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47664782157cfc5be96f045_43701070',
  'variables' => 
  array (
    'userOptions' => 0,
    'menuList' => 0,
    'topMenuList' => 0,
    'row' => 0,
    'key' => 0,
    'child' => 0,
    'right' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cfc5bea3e475_49244048',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cfc5bea3e475_49244048')) {
function content_57cfc5bea3e475_49244048 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '47664782157cfc5be96f045_43701070';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<link rel="stylesheet" href="/public/css/tinyselect.css" />
<style>
#right .nav-tabs { margin-bottom:0;} 
#right .tab-content { border:1px solid #ddd; border-top:none; padding:20px 20px 0;}
</style>
<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div id="right">

        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">系统菜单</a></li>
            <!--<li><a href="/admin/index/">帐号管理</a></li>-->
            <li class="active">权限管理</li>
        </ol>

        <div class="right_con">
        <div class="alert alert-success" style="margin-bottom:30px;">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                    Tip: 第一步:选择用户登录名; 第二步:勾选需授权的菜单; 第三步:分发权限
        </div>

        <form class="form-search" id="rightSearch" method="get" action="/right/index/">
                    <div class="input-append">
                        <select id="uid" name="uid" class="form-control" style="display: inline-block; width: 200px;">
                            <?php echo $_smarty_tpl->tpl_vars['userOptions']->value;?>

                        </select>
                        <button type="submit" class="btn">搜索</button>
                    </div>
                </form>

                <?php if ($_smarty_tpl->tpl_vars['menuList']->value) {?>
                    <form class="form-horizontal" id="form-save" action="/right/save/" method="post">
                        <input type="hidden" value="<?php echo $_GET['uid'];?>
" name="uid" />
                        <div id="" class="tabbable" style="margin-top:30px;">
                            <ul class="nav nav-tabs">
                                <?php
$_from = $_smarty_tpl->tpl_vars['topMenuList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['__foreach_top'] = new Smarty_Variable(array('iteration' => 0));
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$_smarty_tpl->tpl_vars['__foreach_top']->value['iteration']++;
$_smarty_tpl->tpl_vars['__foreach_top']->value['first'] = $_smarty_tpl->tpl_vars['__foreach_top']->value['iteration'] == 1;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                                <li <?php if ((isset($_smarty_tpl->tpl_vars['__foreach_top']->value['first']) ? $_smarty_tpl->tpl_vars['__foreach_top']->value['first'] : null)) {?>class="active"<?php }?>><a target="rightTop" tag="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_tag'];?>
_right" href="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_url'];?>
_right" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['row']->value['m_name'];?>
</a></li>
                                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                            </ul>
                            <div class="tab-content">
                                <?php
$_from = $_smarty_tpl->tpl_vars['topMenuList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['__foreach_top'] = new Smarty_Variable(array('iteration' => 0));
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$_smarty_tpl->tpl_vars['__foreach_top']->value['iteration']++;
$_smarty_tpl->tpl_vars['__foreach_top']->value['first'] = $_smarty_tpl->tpl_vars['__foreach_top']->value['iteration'] == 1;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                                <div class="tab-pane <?php if ((isset($_smarty_tpl->tpl_vars['__foreach_top']->value['first']) ? $_smarty_tpl->tpl_vars['__foreach_top']->value['first'] : null)) {?>active<?php }?>" id="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_tag'];?>
_right" style="padding:20px 20px;">
                                    <?php
$_from = $_smarty_tpl->tpl_vars['menuList']->value[$_smarty_tpl->tpl_vars['key']->value]['son'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['child']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->_loop = true;
$foreach_child_Sav = $_smarty_tpl->tpl_vars['child'];
?>
                                    <label class="checkbox inline"><input type="checkbox" name="right[]" <?php if (in_array($_smarty_tpl->tpl_vars['child']->value['m_id'],$_smarty_tpl->tpl_vars['right']->value)) {?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['child']->value['m_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value['m_name'];?>
</label>
                                    <?php
$_smarty_tpl->tpl_vars['child'] = $foreach_child_Sav;
}
?>
                                </div>
                                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                            </div>
                        </div>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-primary" style="margin-top: 20px;">分配权限</button>
                        </div>
                    </form>
                <?php }?>
         </form>
        </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php echo '<script'; ?>
 src="/public/js/tinyselect.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    //管理员列表
    $(function(){
        $("#uid").tinyselect();
    });

    $("#form-save").Validform({
        ajaxPost: true,
        tipSweep: true,
        tiptype:function(msg,o,cssctl){
            if(o.type == 3)
                $.dialog.tips(msg);
        },
        beforeSubmit:function(curform){
        },
        callback:function(response){
            $.dialog.tips(response.info);
            if ( response.status == 'y' ) {
                window.setTimeout(function(){
                    location.reload();
                }, 2000)
            }
        }
    });
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>