<?php /* Smarty version 3.1.27, created on 2016-08-26 10:00:42
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/adsgroup/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:50905597657bfa2caed9219_74629767%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '646b44a434dc70538cab4687cf97f453fb4b37e8' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/adsgroup/index.html',
      1 => 1471491215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50905597657bfa2caed9219_74629767',
  'variables' => 
  array (
    'title' => 0,
    'data' => 0,
    'row' => 0,
    'ad' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa2cb03d4a0_29217557',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa2cb03d4a0_29217557')) {
function content_57bfa2cb03d4a0_29217557 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '50905597657bfa2caed9219_74629767';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">广告管理 </a></li>
            <li class="active">广告组管理列表</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left" id="searchForm">
                <div class="form-group">广告组名：
                    <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="form-control" placeholder="广告组名" style="width: 300px;">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <a type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adsgroupModal" href='/adsgroup/form/'>添加广告组</a>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>广告组名</td>
                    <td>广告组别名</td>
                    <td>关联广告</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ag_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ag_cname'];?>
</td>
                    <td rel="eye">
                        <div class="ad-list ad-hide">
                            <div class="pull-left">
                                <p>共有<?php echo $_smarty_tpl->tpl_vars['row']->value['a_counts'];?>
个广告</p>
                                <?php
$_from = $_smarty_tpl->tpl_vars['row']->value['a_ids'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['ad'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['ad']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['ad']->value) {
$_smarty_tpl->tpl_vars['ad']->_loop = true;
$foreach_ad_Sav = $_smarty_tpl->tpl_vars['ad'];
?>
                                <p><a href="<?php echo $_smarty_tpl->tpl_vars['ad']->value['a_link'];?>
" target="_blank"><i class="icon-picture"></i> <?php echo $_smarty_tpl->tpl_vars['ad']->value['a_title'];?>
</a>&nbsp;状态： <?php if ($_smarty_tpl->tpl_vars['ad']->value['a_status'] == 1) {?>[开启]<?php } else { ?>[关闭]<?php }?></p>
                                <?php
$_smarty_tpl->tpl_vars['ad'] = $foreach_ad_Sav;
}
?>
                            </div>

                            <div class="clear"></div>
                        </div></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ag_addtime'];?>
</td>
                    <td>
                        <a data-toggle="modal" data-target="#adsgroupModal" class="glyphicon glyphicon-edit" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['ag_id'];?>
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
        <!--广告组弹窗-->
        <form class="form-horizontal" action="/ajax/adsgroup/save" method="post">
            <div class="modal fade" id="adsgroupModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>