<?php /* Smarty version 3.1.27, created on 2016-09-07 11:15:26
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/category/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:81597864357cf864e8515e1_20300032%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6890f70f797bcc6d510431be4e10200379eddaa9' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/category/index.html',
      1 => 1471491790,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81597864357cf864e8515e1_20300032',
  'variables' => 
  array (
    'categoryOption' => 0,
    'name' => 0,
    'data' => 0,
    'row' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf864e8f3ff4_28241616',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf864e8f3ff4_28241616')) {
function content_57cf864e8f3ff4_28241616 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '81597864357cf864e8515e1_20300032';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">商品管理 </a></li>
            <li class="active">商品分类</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                  <div class="form-group">分类：
                    <select name="pid" id="pid" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['categoryOption']->value;?>

                    </select>
                </div>
                <div class="form-group">分类名称：
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-control" placeholder="分类名称">
                </div>

                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adminModal" href="/category/form/">添加分类</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>分类名称</td>
                    <td>别名</td>
                    <td>排序</td>
                    <td>状态</td>
                    <td>操作</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pc_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pc_alise'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pc_order'];?>
</td>
                    <td><a href="#" data-json="确认要更改状态吗？" data-href="/ajax/category/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['pc_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['pc_status'];?>
">
                        <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['pc_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['pc_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['pc_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                    </a></td>
                    <td>
                        <a  data-toggle="modal" data-target="#adminModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['pc_id'];?>
" title="编辑分类">编辑</a>&nbsp;&nbsp;
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
        <form class="form-horizontal" action="/ajax/Category/save" method="post">
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>