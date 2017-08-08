<?php /* Smarty version 3.1.27, created on 2016-08-26 16:54:26
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/ads/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:62669667457c003c20f3ed3_74667828%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d615f7b46ebd5b42ef55e73892120a2d82bffe4' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/ads/index.html',
      1 => 1471675104,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62669667457c003c20f3ed3_74667828',
  'variables' => 
  array (
    'title' => 0,
    'statusOption' => 0,
    'data' => 0,
    'row' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c003c2182375_32981707',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c003c2182375_32981707')) {
function content_57c003c2182375_32981707 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '62669667457c003c20f3ed3_74667828';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">广告管理 </a></li>
            <li class="active">广告管理列表</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left" id="searchForm">
                <div class="form-group">广告名：
                    <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="form-control" placeholder="广告名" style="width: 300px;">
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
            <a type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adsModal" href='/ads/form/'>添加广告</a>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>广告ID</td>
                    <td>广告名称</td>
                    <td>别名</td>
                    <td>图片</td>
                    <td>链接</td>
                    <td>状态</td>
                    <td>添加时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_alias'];?>
</td>
                    <td>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_picture'];?>
" style="width: 50px;height: 50px;">
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_link'];?>
</td>
                    <td>
                        <a href="javascript:void(0);" data-json="确认要更改状态吗？" data-href="/ads/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_status'];?>
">
                            <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                            <?php if ($_smarty_tpl->tpl_vars['row']->value['a_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                        </a>
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['a_addtime'];?>
</td>
                    <td>
                        <a data-toggle="modal" data-target="#adsModal" class="glyphicon glyphicon-edit" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" title="编辑"></a>&nbsp;&nbsp;
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
        <!--广告弹窗-->
        <form class="form-horizontal" action="/ajax/ads/save" method="post">
            <div class="modal fade" id="adsModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>