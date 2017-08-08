<?php /* Smarty version 3.1.27, created on 2016-09-27 10:49:54
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/common/footer.html" */ ?>
<?php
/*%%SmartyHeaderCode:28198426557e9de52c74559_12112741%%*/
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
  'nocache_hash' => '28198426557e9de52c74559_12112741',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57e9de52c7a734_47052805',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57e9de52c7a734_47052805')) {
function content_57e9de52c7a734_47052805 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '28198426557e9de52c74559_12112741';
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