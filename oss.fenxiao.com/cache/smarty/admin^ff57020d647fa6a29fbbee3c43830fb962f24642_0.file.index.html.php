<?php /* Smarty version 3.1.27, created on 2016-10-24 17:18:54
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/admin/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:1666836175580dd1fe6cabb6_00880955%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff57020d647fa6a29fbbee3c43830fb962f24642' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/admin/index.html',
      1 => 1473217704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1666836175580dd1fe6cabb6_00880955',
  'variables' => 
  array (
    'name' => 0,
    'data' => 0,
    'row' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_580dd1fe7d6664_79656453',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_580dd1fe7d6664_79656453')) {
function content_580dd1fe7d6664_79656453 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1666836175580dd1fe6cabb6_00880955';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">系统管理</a></li>
            <!--<li><a href="/admin/index/">帐号管理</a></li>-->
            <li class="active">系统管理员列表</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-control" placeholder="用户名">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adminModal" href="/admin/form/">添加管理员</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <th>用户名</th>
                    <th>角色</th>
                    <th>真实姓名</th>
                    <th>联系电话</th>
                    <th>状态</th>
                    <th>添加时间</th>
                    <th>最后登录时间</th>
                    <?php if (@constant('A_ROLE') == 1) {?><td>修改密码</td><?php }?>
                    <th>操作</th>
                </tr>
                <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_username'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['a_role'] == 1) {?><span class="label label-danger"><?php if ($_smarty_tpl->tpl_vars['row']->value['a_id'] == @constant('A_ID')) {?>当前<?php }?>系统管理员</span><?php } else { ?><span class="label label-info">普通管理员</span><?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_realname'];?>
</td>
                     <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_phone'];?>
</td>
                    <td>
                        <a href="#" data-json="确认要更改状态吗？" data-href="/ajax/admin/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_status'];?>
">
                            <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                            <?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                        </a>
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_addtime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_login_time'];?>
</td>
                    <?php if (@constant('A_ROLE') == 1) {?>
                    <td>
                        <a data-toggle="modal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
formPassword/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" data-target="#formPasswordModal" title="修改密码"><i class="glyphicon glyphicon-lock"></i></a>
                    </td>
                    <?php }?>
                    <td>
                        <a class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#adminModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" title="编辑管理员"></a>&nbsp;&nbsp;
                    </td>
                </tr>
                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                <?php }?>
            </table>

            <!-- 分页 -->
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
            <nav>
                <ul class="pagination pull-right"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</ul>
            </nav>
            <?php }?>
        </div>

        <!--弹窗-->
        <form class="form-horizontal" action="/ajax/admin/save/" method="post">
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>
        </form>

        <form class="form-horizontal" method="post" action="/ajax/admin/editPassword/" >
            <div class="modal fade" id="formPasswordModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>