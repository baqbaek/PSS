<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

//pobranie parametrów
$kwota = isset($_POST['kwota']) ? $_POST['kwota'] : '';
$lata = isset($_POST['lata']) ? $_POST['lata'] : '';
$oprocentowanie = isset($_POST['oprocentowanie']) ? $_POST['oprocentowanie'] : '';

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
// sprawdzenie, czy parametry zostały przekazane
if (!isset($kwota) || !isset($lata) || !isset($oprocentowanie)) {
    //sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ($kwota == "") {
    $messages[] = 'Nie podano kwoty';
}
if ($lata == "") {
    $messages[] = 'Nie podano lat';
}
if ($oprocentowanie == "") {
    $messages[] = 'Nie podano oprocentowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty($messages)) {

    // sprawdzenie, czy $kwota i $lata są liczbami całkowitymi
    if (!is_numeric($kwota)) {
        $messages[] = 'Kwota nie jest liczbą całkowitą';
    }
    if (!is_numeric($lata)) {
        $messages[] = 'Lata nie są liczbą całkowitą';
    }
    if (!is_numeric($oprocentowanie)) {
        $messages[] = 'Oprocentowanie nie jest liczbą całkowitą';
    }
}

// 3. wykonaj zadanie jeśli wszystko w porządku
if (empty($messages)) { // gdy brak błędów

    //konwersja parametrów na int
    $kwota = intval($kwota);
    $lata = intval($lata);
    $oprocentowanie = intval($oprocentowanie);

    //wykonanie operacji
    $result = ($kwota + $kwota * $oprocentowanie / 100) / ($lata * 12);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Zadanie 3');
$smarty->assign('page_description','Szablonowanie Smarty- Bartosz Kubiczek');
$smarty->assign('page_header','Szablony Smarty');

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('messages',$messages);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.tpl');