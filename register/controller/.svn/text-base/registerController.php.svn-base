<?php

require_once('register/model/registerModel.php');
require_once('register/model/registerDAL.php');
require_once('register/view/registerView.php');
require_once('Hashing/HashAndSalt.php');
require_once('sessionHandler.php');

class registerController {
	private $model;
	private $view;
	private $registerDAL;
	private $HashAndSalt;
	private $sessionHandler;
	
	public function __construct(){
		$this -> registerDAL = new registerDAL();
		$this -> model = new registerModel($this -> registerDAL);
		$this -> view = new registerView();
		$this -> HashAndSalt = new HashAndSalt();
		$this->sessionHandler = new logInSessionHandler();
	}
	
	function DoRegister(){		
		if($this -> view -> IsPostback()){
			$this->createNameSessions();
			if($this -> view -> ValidateAllFields()){
				$email = $this -> view -> email;
				$username = $this -> view -> username;
				$password = $this -> view -> password;
				if($this -> model -> ValidateInput($email, $username, $password)){
					//Lägg in redirect om man loggats in
					$salt = $this -> HashAndSalt -> GetSalt();
					$hashedPw = $this -> HashAndSalt -> HashPassword($password, $salt);
					$this -> registerDAL -> AddNewUser($email, $username, $hashedPw, $salt);
					header('Location: ./SuccessfulReg.html');
					die();
				} else {
					foreach($this -> model -> errorMessageArray as $errorMessage){
						$this -> view -> AddErrorMessage($errorMessage);
					}
				}
			}
		}
		$nameValue = $this->getNameSession();
		$mailValue = $this->getMailSession();
		return $this -> view -> renderHTML($nameValue, $mailValue);
	}
	
	//sets username and mail session
	private function createNameSessions(){
		$username = $this -> view -> GetEnteredUsername();
		$this->sessionHandler->setNameSession($username);
		
		$email = $this -> view -> GetEnteredEmail();
		$this->sessionHandler->setMailSession($email);
	}
	//gets name and mail session
	private function getNameSession(){
		return $usernameValue = $this->sessionHandler->getNameSession(); 
	}
	private function getMailSession(){
		return $MailValue = $this->sessionHandler->getMailSession();
	}
}



