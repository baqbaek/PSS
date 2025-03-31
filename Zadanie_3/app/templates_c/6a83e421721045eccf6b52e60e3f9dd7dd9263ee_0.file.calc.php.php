<?php
/* Smarty version 3.1.38, created on 2024-04-07 15:09:29
  from 'C:\xampp\htdocs\projects\PSS_PHP\Zadanie_3\app\calc.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.38',
  'unifunc' => 'content_66129b0933efb1_79831548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a83e421721045eccf6b52e60e3f9dd7dd9263ee' => 
    array (
      0 => 'C:\\xampp\\htdocs\\projects\\PSS_PHP\\Zadanie_3\\app\\calc.php',
      1 => 1712495343,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66129b0933efb1_79831548 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

//pobranie parametrów
function getParams(&$credit,&$percent,&$years){
	$credit = isset($_REQUEST['credit']) ? $_REQUEST['credit'] : null;
	$percent = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;
	$years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;	
}

function validate(&$credit,&$percent,&$years,&$messages){
	if ( ! (isset($credit) && isset($percent) && isset($years))) {
		return false;
	}
	if ( $credit == "") {
		$messages [] = 'Add credit value';
	}
	if ( $percent == "") {
		$messages [] = 'Add the interest rate';
	}
	if ( $years == "") {
		$messages [] = 'Add the number of years';
	}
	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$credit,&$percent,&$years,&$messages,&$result){
	global $role;
	
	$credit = (float) $credit;
    $percent = (float) $percent;
    $years = (int) $years;
	
	$monthly = ($credit + ($percent * $credit / 100)) / ($years * 12);
    $result = number_format($monthly, 2, '.', '');
}

$credit = null;
$percent = null;
$years = null;
$result = null;
$messages = array();

getParams($credit,$percent,$years);
if ( validate($credit,$percent,$years,$messages) ) { 
	process($credit,$percent,$years,$messages,$result);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.php');<?php }
}
