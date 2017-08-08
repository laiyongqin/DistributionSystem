<?php /* Smarty version 3.1.27, created on 2016-09-07 10:40:37
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/news/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:200772927457cf7e259ee6f6_88103044%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b665f46def9b9fefa3488f03fba60baf553f1bd7' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/news/index.html',
      1 => 1473216036,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200772927457cf7e259ee6f6_88103044',
  'variables' => 
  array (
    'categoryOption' => 0,
    'title' => 0,
    'statusOption' => 0,
    'data' => 0,
    'row' => 0,
    'cateList' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf7e25a66f70_04789530',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf7e25a66f70_04789530')) {
function content_57cf7e25a66f70_04789530 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '200772927457cf7e259ee6f6_88103044';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">文章管理 </a></li>
            <li class="active">文章列表</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left" id="searchForm">
                <div class="form-group">分类：
                    <select name="pid" id="pid" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['categoryOption']->value;?>

                    </select>
                </div>
                <div class="form-group">标题：
                    <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="form-control" placeholder="标题" style="width: 300px;">
                </div>
                <div class="form-group">
                    状态：
                    <select name="status" id="status" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right"  onclick="location.href='/news/form/'">添加新闻</button>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>序号</td>
                    <td>所在分类</td>
                    <td>标题</td>
                    <td>排序</td>
                    <td>状态</td>
                    <td>添加时间</td>
                    <!--<td>是否推荐</td>-->
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['cateList']->value[$_smarty_tpl->tpl_vars['row']->value['nc_id']];?>
</td>
                    <td>
						<?php if ($_smarty_tpl->tpl_vars['cateList']->value[$_smarty_tpl->tpl_vars['row']->value['nc_id']] == '头条') {?>
						<?php echo $_smarty_tpl->tpl_vars['row']->value['n_title'];?>
---<?php if ($_smarty_tpl->tpl_vars['row']->value['n_type'] == 2) {?><span class="label label-success">国内新闻</span><?php } else { ?><span class="label label-danger">国际新闻</span><?php }?>
						<?php } else { ?>
						<?php if ($_smarty_tpl->tpl_vars['row']->value['nc_id'] != 11) {?>
						<?php echo $_smarty_tpl->tpl_vars['row']->value['n_title'];?>

						<?php }?>
						<?php }?></td>

                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['n_sort'];?>
</td>
                    <td>
                        <a href="javascript:void(0);" data-json="确认要更改状态吗？" data-href="/news/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_status'];?>
">
                            <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['n_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['n_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                            <?php if ($_smarty_tpl->tpl_vars['row']->value['n_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                        </a>
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['n_addtime'];?>
</td>
                    <!--<td>-->
                        <!--<a href="javascript:void(0);" data-json="确认要更改状态吗？" data-href="/news/recommend/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_status'];?>
">-->
                            <!--<i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['n_recommend'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['n_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>-->
                            <!--<?php if ($_smarty_tpl->tpl_vars['row']->value['n_recommend'] == 1) {?><span class="label label-success">推荐</span><?php } else { ?><span class="label label-warning">未推荐</span><?php }?>-->
                        <!--</a>-->
                    <!--</td>-->
                    <td>
                        <a class="glyphicon glyphicon-edit" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
" title="编辑"></a>&nbsp;&nbsp;
                        <a class="glyphicon glyphicon-remove" data-json="确认要删除吗？" href="javascript:void(0);" title="删除" data-href="/news/delete/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
/"></a>&nbsp;&nbsp;
                        <a title="预览文章" data-json="请通过企业号预览文章：<br/><?php echo $_smarty_tpl->tpl_vars['row']->value['n_title'];?>
" data-href="/news/view/?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['n_id'];?>
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
    </div>
    <div class="clear"></div>
</div>
<?php echo '<script'; ?>
>

<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>