<?php /* Smarty version 3.1.27, created on 2016-09-29 11:29:32
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/common/footer.html" */ ?>
<?php
/*%%SmartyHeaderCode:83232807157ec8a9cb707f8_29528587%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71c51f4259a6fd2b5e17c21a24602922318e2e70' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/common/footer.html',
      1 => 1470965263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83232807157ec8a9cb707f8_29528587',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57ec8a9cb89dc1_41359876',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57ec8a9cb89dc1_41359876')) {
function content_57ec8a9cb89dc1_41359876 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '83232807157ec8a9cb707f8_29528587';
?>
<div class="bottom">Copyright © 2016-2017 福州华闽易家网络科技有限公司. All Rights Reserved</div>

<?php echo '<script'; ?>
>
    window.onload=function() {
        var Aleft=document.getElementById('left');
        var Aright=document.getElementById('right');

        Aleft.style.minHeight=window.innerHeight-130+"px";
        Aright.style.minHeight=window.innerHeight-130+"px";
        Aright.style.width=window.innerWidth-207+"px";

    };
    window.onresize=function() {
        var Aleft=document.getElementById('left');
        var Aright=document.getElementById('right');

        Aleft.style.minHeight=window.innerHeight-130+"px";
        Aright.style.minHeight=window.innerHeight-130+"px";
        Aright.style.width=window.innerWidth-207+"px";

    };
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>