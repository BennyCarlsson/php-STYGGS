<?php

require_once 'logInDB.php';
require_once 'sessionHandler.php';

Class LogInModel{
	
	private static $loggedInSession = "loggedInSession";
	private $logInDB;
	
	public function __construct(){
		$this->logInDB = new LogInDB();
		$this->sessionHandler = new logInSessionHandler(); 
	}
	
	public function tryLogIn($username , $password){
		$this->setNameOrNameSession($username);
		if($this->checkUsernameAndPassword($username, $password)){
			return true;
		}
			return false;
	}
	
	private function checkUsernameAndPassword($username, $password){
		if($this->logInDB->checkUsernameAndPassword($username, $password)){
			$this->sessionHandler->createLoggedInSession();
			$this->setIdSession($username);
			return true;
		}
		else{
			return false;
		}	
	}	
	private function setNameOrNameSession($username){
		if($this->logInDB->checkMailExist($username)){
			$this->sessionHandler->setMailSession($username);
		}	
		else{
			$this->sessionHandler->setNameSession($username);
		} 
	}
	private function setIdSession($username){
		$id = $this->logInDB->getIdOnUsername($username);
		$this->sessionHandler->setIdSession($id);
	}
}

