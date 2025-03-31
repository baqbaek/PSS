<?php

namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;
use core\Messages;

class CalcCtrl {

	private $msgs;   //wiadomości dla widoku
	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku


	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
	

	public function getParams(){
		$this->form->kwota = isset($_REQUEST ['kwota']) ? $_REQUEST ['kwota'] : null;
		$this->form->lata = isset($_REQUEST ['lata']) ? $_REQUEST ['lata'] : null;
		$this->form->oprocentowanie = isset($_REQUEST ['oprocentowanie']) ? $_REQUEST ['oprocentowanie'] : null;
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->kwota ) && isset ( $this->form->lata ) && isset ( $this->form->oprocentowanie ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false; //zakończ walidację z błędem
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->kwota == "") {
			$this->msgs->addError('Nie podano kwoty');
		}
		if ($this->form->lata == "") {
			$this->msgs->addError('Nie podano lat');
		}
		if ($this->form->oprocentowanie == "") {
			$this->msgs->addError('Nie podano oprocentowania');
		}
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! $this->msgs->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this -> form -> kwota )) {
				$this->msgs->addError('Kwota musi być liczbą całkowitą');
			}
			
			if (! is_numeric ( $this -> form -> lata )) {
				$this->msgs->addError('Lata musi być liczbą całkowitą');
			}
                        if (! is_numeric ( $this -> form -> oprocentowanie )) {
				$this->msgs->addError('Oprocentowanie musi być liczbą całkowitą');
			}
		}
		
		return ! $this->msgs->isError();
	}
	
	public function action_calcCompute(){

		$this->getParams();
		
		if ($this->validate()) {
				
			$this->form->kwota = intval($this->form->kwota);
			$this->form->lata = intval($this->form->lata);
                        $this->form->oprocentowanie = intval($this->form->oprocentowanie);
			getMessages()->addInfo('Parametry poprawne.');
			if (inRole('admin')) {
					$this-> result -> result  = ($this -> form -> kwota + ($this -> form -> lata * $this -> form -> oprocentowanie) / 100) / ($this -> form -> lata * 12);	
				} else {
					getMessages()->addError('Tylko administrator może wykonać tę operację');
				}	
			getMessages()->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}

	public function action_calcShow(){
		getMessages()->addInfo('Witaj użytkowniku');
		$this->generateView();
	}
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		global $user;
		getSmarty()->assign('user',$user);
		global $role;
		getSmarty()->assign('role',$role);
		getSmarty()->assign('page_title','Przykład 06b');
		getSmarty()->assign('page_description','6b. Routing');
		getSmarty()->assign('page_header','Kontroler główny- Bartosz Kubiczek');
					
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.tpl'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
