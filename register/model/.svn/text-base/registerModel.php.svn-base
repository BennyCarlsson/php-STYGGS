<?php

class registerModel {
	
	private $registerDAL;
	public $errorMessageArray = array();
	const minNameLeng = 6;
	const minPassLeng = 8;
	
	public function __construct($registerDAL){
		$this -> registerDAL = $registerDAL;
	}
	
	public function ValidateInput($email, $username, $password){
		$validUsername = $this -> ValidateUsername($username);
		$validLength = $this -> ValidateLength($username, $password);
		$validEmail = $this -> ValidateEmail($email);
		$userCredsFree = $this -> UserCredsFree($email, $username);
		
		if($validUsername &&  $validLength && $validEmail && $userCredsFree){
		//if($validUsername &&  $validLength && $validEmail){
			return true;
		} else {
			return false;
		}
	}
	
	private function ValidateUsername($username){
		if (preg_match('/^[<a-zA-Z0-9]*$/', $username)) {
			return true;
		} else {
			$this -> AddErrorMessage("The username supplied contains illegal characters. Letters and numbers only.");
			return false;
		}
	}
	
	private function ValidateEmail($email){
		if (preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)) {
			return true; 
		} else {
			$this -> AddErrorMessage("The email adress supplied contains illegal characters.");
			return false;
		}
	}
	
	private function ValidateLength($username, $password) {
		if (strlen($username) >= self::minNameLeng && strlen($password) >= self::minPassLeng) {
			return true;
		} else {
			if (strlen($username) < self::minNameLeng) {
				$this -> AddErrorMessage("Username is too short, needs to be atleast " . self::minNameLeng . " characters.");
			}
			if (strlen($password) < self::minPassLeng) {
				$this -> AddErrorMessage("Password is too short, needs to be atleast " . self::minPassLeng . " characters.");
			}
			return false;
		}
	}
	
	//Returns false if a username or email is occupied
	private function UserCredsFree($email, $username){
		$usernameOccupied = $this -> registerDAL -> CheckIfUsernameExists($username);
		$emailOccupied = $this -> registerDAL -> CheckIfEmailIsUsed($email);
		if($usernameOccupied == false && $emailOccupied == false){							
			return true;
		} else {
			if($usernameOccupied){
				$this -> AddErrorMessage("The username supplied is already in use.");	
			}
			if($emailOccupied){
				$this -> AddErrorMessage("The email adress supplied is already in use.");	
			}
			return false;
		}				
	}
	
	private function AddErrorMessage($errorMessage){
		$this -> errorMessageArray[] = $errorMessage;
	}
}