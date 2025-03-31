<?php
require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';
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
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this-> form -> kwota = intval($this -> form -> kwota);
			$this-> form -> lata = intval($this -> form -> lata);
            $this-> form -> oprocentowanie = intval($this -> form -> oprocentowanie);
			$this-> msgs -> addInfo('Parametry prawidłowe.');
			$this-> result -> result  = ($this -> form -> kwota + ($this -> form -> lata * $this -> form -> oprocentowanie) / 100) / ($this -> form -> lata * 12);	
			$this-> msgs -> addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','Zadnie 4 -obiektowość');
		$smarty->assign('page_description','test');
		$smarty->assign('page_header','Obiektowość w PHP + Smarty');
				
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/CalcView.html');
	}
}
