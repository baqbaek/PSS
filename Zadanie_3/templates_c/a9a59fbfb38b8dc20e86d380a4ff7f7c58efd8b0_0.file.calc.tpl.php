<?php
/* Smarty version 3.1.38, created on 2024-04-07 15:18:02
  from 'C:\xampp\htdocs\projects\PSS_PHP\Zadanie_3\app\calc.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_66129d0adc1d78_97808594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9a59fbfb38b8dc20e86d380a4ff7f7c58efd8b0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\projects\\PSS_PHP\\Zadanie_3\\app\\calc.tpl',
      1 => 1712495842,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66129d0adc1d78_97808594 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_121327874666129d0adb2c53_32176237', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "../templates/main.html");
}
/* {block 'content'} */
class Block_121327874666129d0adb2c53_32176237 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_121327874666129d0adb2c53_32176237',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h3>Prosty kalkulator</h2>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/calc.php" method="post">
<label for="id_credit">Kwota kredytu: </label>
<input id="id_credit" type="number" step="any" name="kwota" min="1" required value="<?php echo '<?php ';?>
if (isset($kwota))
	print($kwota); <?php echo '?>';?>
" /><br />

<label for="id_percent">Oprocentowanie: </label>
<input id="id_percent" type="number" step="any" name="procent" min="0" required value="<?php echo '<?php ';?>
if (isset($procent))
	print($procent); <?php echo '?>';?>
" /><br />

<label for="id_years">Liczba lat kredytu: </label>
<input id="id_years" type="number" name="lata" min="1" required value="<?php echo '<?php ';?>
if (isset($lata))
	print($lata); <?php echo '?>';?>
" /><br />
<input class="pure-button pure-button-primary" type="submit" value="Oblicz miesięczną ratę" />
</form>


<div class="messages">

<?php if ((isset($_smarty_tpl->tpl_vars['messages']->value))) {?>
	<?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?> 
		<h4>Wystąpiły błędy: </h4>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((isset($_smarty_tpl->tpl_vars['infos']->value))) {?>
	<?php if (count($_smarty_tpl->tpl_vars['infos']->value) > 0) {?> 
		<h4>Informacje: </h4>
		<ol class="inf">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['infos']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>

<?php if ((isset($_smarty_tpl->tpl_vars['result']->value))) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['result']->value;?>

	</p>
<?php }?>

</div>

<?php
}
}
/* {/block 'content'} */
}
