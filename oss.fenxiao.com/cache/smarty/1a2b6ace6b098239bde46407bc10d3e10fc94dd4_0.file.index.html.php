<?php /* Smarty version 3.1.27, created on 2016-09-07 09:55:42
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/product/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:48377376457cf739e89f5d4_39693944%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a2b6ace6b098239bde46407bc10d3e10fc94dd4' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/product/index.html',
      1 => 1473213341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48377376457cf739e89f5d4_39693944',
  'variables' => 
  array (
    'categoryOption' => 0,
    'name' => 0,
    'statusOption' => 0,
    'data' => 0,
    'row' => 0,
    'category' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf739e912b02_71850129',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf739e912b02_71850129')) {
function content_57cf739e912b02_71850129 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '48377376457cf739e89f5d4_39693944';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">商品管理 </a></li>
            <li class="active">商品管理</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">分类：
                    <select name="pid" id="pid" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['categoryOption']->value;?>

                    </select>
                </div>
                <div class="form-group">标题：
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-control" placeholder="标题">
                </div>
                <div class="form-group">状态：
                    <select name="status" id="status" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right"  onclick="location.href='/product/form/'">添加产品</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>序号</td>
                    <td>分类名称</td>
                    <td>产品名称</td>
                    <td>销量</td>
                    <td>库存</td>
                    <td>原价</td>
                    <td>活动价</td>
                    <td>排序</td>
                    <td>添加时间</td>
                    <td>更新时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['category']->value[$_smarty_tpl->tpl_vars['row']->value['pc_id']];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_sales'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_stock'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_original_price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_event_price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_sort'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_addTime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_updateTime'];?>
</td>
                    <td><a href="#" data-json="确认要更改状态吗？" data-href="/ajax/product/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['p_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['p_status'];?>
">
                        <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['p_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['p_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['p_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                    </a></td>
                    <td>
                        <a class="glyphicon glyphicon-edit" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['p_id'];?>
" title="编辑"></a>&nbsp;&nbsp;
                        <a title="预览商品" data-json="请通过企业号预览商品：<br/><?php echo $_smarty_tpl->tpl_vars['row']->value['p_title'];?>
" data-href="/product/view/?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['p_id'];?>
"><i class="glyphicon glyphicon-eye-open" ></i></a>
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
        <form class="form-horizontal" action="/ajax/product/save" method="post">
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>