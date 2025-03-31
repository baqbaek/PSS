<?php
require_once dirname(__FILE__) . '/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze nie wysyła się niczego do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// Ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH . '/app/security/check.php';

// Pobranie parametrów
function getParams(&$kwota, &$lata, &$procent)
{
    $kwota = $_REQUEST['kwota'] ?? null;
    $lata = $_REQUEST['lata'] ?? null;
    $procent = $_REQUEST['procent'] ?? null;
}

// Walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota, &$lata, &$procent, &$messages)
{
    // Sprawdzenie, czy parametry zostały przekazane
    if (!($kwota && $lata && $procent)) {
        // Sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        // Teraz zakładamy, że nie jest to błąd. Po prostu nie wykonamy obliczeń
        return false;
    }

    // Sprawdzenie, czy potrzebne wartości zostały przekazane
    if ($kwota == "") {
        $messages[] = 'Nie podano kwoty';
    }
    if ($lata == "") {
        $messages[] = 'Nie podano lat';
    }
    if ($procent == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    // Nie ma sensu walidować dalej gdy brak parametrów
    if ($messages) {
        return false;
    }

    // Sprawdzenie, czy $kwota i $lata są liczbami całkowitymi
    if (!is_numeric($kwota)) {
        $messages[] = 'Kwota nie jest liczbą całkowitą';
    }

    if (!is_numeric($lata)) {
        $messages[] = 'Lata nie są liczbą całkowitą';
    }

    if (!is_numeric($procent)) {
        $messages[] = 'Oprocentowanie nie jest liczbą całkowitą';
    }

    return empty($messages);
}

function process(&$kwota, &$lata, &$procent, &$messages, &$result, $role)
{
    // Konwersja parametrów na int
    $kwota = intval($kwota);
    $lata = intval($lata);
    $procent = intval($procent);

    // Wykonanie operacji
    if ($role === 'admin') {
        $result = ($kwota * pow((1 + $procent / 100), $lata)) / (12 * $lata);
    } else {
        $messages[] = 'Tylko administrator może wyliczyć miesięczną ratę!';
    }
}

// Definicja zmiennych kontrolera
$kwota = $lata = $procent = $result = null;
$messages = [];

// Pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kwota, $lata, $procent);
if (validate($kwota, $lata, $procent, $messages)) {
    process($kwota, $lata, $procent, $messages, $result, $role);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages, $kwota, $lata, $procent, $result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';
