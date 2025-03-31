<?php
/* Smarty version 3.1.30, created on 2024-04-27 18:07:16
  from "C:\xampp\htdocs\projects\PSS_PHP\Zadanie_6a\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_662d22b43a5594_09402589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02ac89d3430fc8fe9fd0ee7cd3d4d0fc5bd329ff' => 
    array (
      0 => 'C:\\xampp\\htdocs\\projects\\PSS_PHP\\Zadanie_6a\\app\\views\\CalcView.tpl',
      1 => 1714234027,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_662d22b43a5594_09402589 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_187551974662d22b43a50b9_70033166', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_187551974662d22b43a50b9_70033166 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
    użytkownik: <?php echo $_smarty_tpl->tpl_vars['user']->value->login;?>
, rola: <?php echo $_smarty_tpl->tpl_vars['user']->value->role;?>

<?php } else { ?>
    użytkownik nieznany
<?php }?></span>
</div>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="kwota">kwota: </label>
			<input id="kwota" min="0" type="number" placeholder="wartość kwota" name="kwota" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->kwota;?>
">
		</div>
        <div class="pure-control-group">
			<label for="lata">lata: </label>
			<input id="lata" min="0"  type="number" placeholder="wartość lata" name="lata" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->lata;?>
">
		</div>
                  <div class="pure-control-group">
			<label for="oprocentowanie">oprocentowanie: </label>
			<input id="oprocentowanie" min="0"  type="number" placeholder="wartość oprocentowanie" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->oprocentowanie;?>
">
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	


<?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
<div class="messages inf">
	Wynik: <?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

</div>
<?php }?>



<?php
}
}
/* {/block 'content'} */
}
