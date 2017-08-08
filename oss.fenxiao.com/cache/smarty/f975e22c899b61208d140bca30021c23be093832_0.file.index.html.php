<?php /* Smarty version 3.1.27, created on 2016-08-26 10:00:20
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/index/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:120228846057bfa2b47ad8e4_44393259%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f975e22c899b61208d140bca30021c23be093832' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/index/index.html',
      1 => 1472091246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120228846057bfa2b47ad8e4_44393259',
  'variables' => 
  array (
    'orderNumber' => 0,
    'salesMoney' => 0,
    'loginLogList' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa2b48543f4_01654823',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa2b48543f4_01654823')) {
function content_57bfa2b48543f4_01654823 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '120228846057bfa2b47ad8e4_44393259';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<style>
    .right_con { text-align:center; margin: 0 auto !important;}
    .right_con .row  {  margin:0; }
    .right_con .box  { position:relative; background:#333; color:#fff; height:100px; border:5px solid #FFF;line-height:100px; font-size:16px; cursor:pointer;}
    .right_con .box a { display:block; color:#FFF;}
    .right_con .box span { position:absolute; top:0px; left:0px; font-size:90px; transform:rotate(20deg); transition:.3s transform;}
    .right_con .box:hover span         { opacity:.8; transform:scale(1.2, 1.2); transition:.4s transform; transform:rotate(20deg);}
    .tab            { margin:0 auto; width:97%;}
    .table       { margin:0 auto; width:96%;}
</style>

<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/">管理首页 </a></li>
            <li class="active">管理首页</li>
        </ol>

        <div class="right_con row">
            <div class="box col-md-3" style="background:#6f5499;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>今日下单数：<?php echo $_smarty_tpl->tpl_vars['orderNumber']->value;?>
</div>
            <div class="box col-md-3" style="background:#0769ad;"><span class="glyphicon glyphicon-yen" aria-hidden="true"></span>今日销售额：￥<?php echo $_smarty_tpl->tpl_vars['salesMoney']->value;?>
</div>
            <div class="box col-md-3" style="background:#4caf50;"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><a href="/order/index/">订单管理</a></div>
            <div class="box col-md-3" style="background:#cf4646;"><span class="glyphicon-filter glyphicon glyphicon-briefcase" aria-hidden="true"></span><a href="/product/index">商品管理</a></div>
        </div>

        <table class="table">
            <caption>最新登录日志</caption>
            <thead>
            <tr>
                <!--<th>#</th>-->
                <th>用户名</th>
                <th>姓名</th>
                <th>登录IP</th>
                <th>登录时间</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($_smarty_tpl->tpl_vars['loginLogList']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['loginLogList']->value;
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
                <!--<th scope="row">1</th>-->
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ll_username'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ll_realname'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ll_login_ip'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ll_login_time'];?>
</td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
            <?php }?>
            </tbody>
        </table>

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