<?php /* Smarty version 3.1.27, created on 2016-09-07 09:43:00
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/menu/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:65202976957cf70a43a5170_31885200%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2e1a7d66d429fbabafa2d6cd9bad34608d0ec2f' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/menu/index.html',
      1 => 1471489380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65202976957cf70a43a5170_31885200',
  'variables' => 
  array (
    'mid' => 0,
    'name' => 0,
    'topList' => 0,
    'top' => 0,
    'm_id' => 0,
    'menuList' => 0,
    'son' => 0,
    'list' => 0,
    'row' => 0,
    'parent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf70a446abd6_20008774',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf70a446abd6_20008774')) {
function content_57cf70a446abd6_20008774 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '65202976957cf70a43a5170_31885200';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">系统菜单</a></li>
            <!--<li><a href="/admin/index/">帐号管理</a></li>-->
            <li class="active">菜单管理</li>
        </ol>

        <div class="right_con">

            <!-- 搜索区域 -->
            <form class="form-inline pull-left" id="searchForm" style="margin-bottom:20px;">
                <div class="form-group">
                <input type="text" name="mid" class="form-control" placeholder="菜单ID" value="<?php echo $_smarty_tpl->tpl_vars['mid']->value;?>
">
                <input type="text" name="nameSearch" class="form-control" placeholder="菜单名称" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
                <select name="menuSearch" class="form-control" style="width:200px;">
                    <option value="">请选择菜单</option>
                    <?php
$_from = $_smarty_tpl->tpl_vars['topList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['top'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['top']->_loop = false;
$_smarty_tpl->tpl_vars['m_id'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['m_id']->value => $_smarty_tpl->tpl_vars['top']->value) {
$_smarty_tpl->tpl_vars['top']->_loop = true;
$foreach_top_Sav = $_smarty_tpl->tpl_vars['top'];
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['top']->value['m_id'];?>
">+<?php echo $_smarty_tpl->tpl_vars['top']->value['m_name'];?>
</option>
                    <?php
$_from = $_smarty_tpl->tpl_vars['menuList']->value[$_smarty_tpl->tpl_vars['m_id']->value]['son'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['son'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['son']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['son']->value) {
$_smarty_tpl->tpl_vars['son']->_loop = true;
$foreach_son_Sav = $_smarty_tpl->tpl_vars['son'];
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['son']->value['m_id'];?>
">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['son']->value['m_name'];?>
</option>
                    <?php
$_smarty_tpl->tpl_vars['son'] = $foreach_son_Sav;
}
?>
                    <?php
$_smarty_tpl->tpl_vars['top'] = $foreach_top_Sav;
}
?>
                </select>
                    </div>
                <button type="submit" class="btn btn-default pull-right">搜索</button>
            </form>

            <!--<button class="btn btn-default pull-right" data-href="/menu/refresh/" data-json="确认更新菜单缓存吗？">更新缓存</button>-->
            <button class="btn btn-default pull-right" onClick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formModal" href="/menu/form/">添加菜单</button>
            <div class="clear10"></div>

            <!-- 内容区域 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <th>菜单ID</th>
                    <th>菜单名称</th>
                    <th>菜单URL</th>
                    <th>菜单标记</th>
                    <th>排序</th>
                    <!--<th>状态</th>-->
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                <?php if ($_smarty_tpl->tpl_vars['list']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['list']->value;
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_url'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_tag'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_order'];?>
</td>
                    <!--<td><?php if ($_smarty_tpl->tpl_vars['row']->value['m_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?></td>-->
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_addtime'];?>
</td>
                    <td>
                        <a data-toggle="modal" href="/menu/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" data-target="#formModal" title="编辑"><i class="glyphicon glyphicon-edit"></i></a>
                        <a data-href="/menu/delete/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" data-json="确认要删除该菜单信息吗？" title="删除菜单"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                <?php }?>
            </table>
        </div>
        <div class="clear"></div>
        <!-- 弹窗 -->
        <form class="form-horizontal" action="/ajax/menu/save/" method="post">
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog"></div>
        </form>

    </div>
    <div class="clear"></div>
</div>
    <?php echo '<script'; ?>
>
        var menuSearch = '<?php echo $_smarty_tpl->tpl_vars['parent']->value;?>
';
        if (menuSearch) {
            $(':input[name="menuSearch"] option[value="' + menuSearch + '"]').attr('selected', true);
        }
    <?php echo '</script'; ?>
>
    <?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>