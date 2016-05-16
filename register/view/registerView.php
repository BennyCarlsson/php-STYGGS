<?php

class registerView {
		
	private $registerDivClass = "testClass";
	private $registerErrorDiv = "placeholder";
	private $registerPageTitle = "Register";
	private $ErrorList = "";
	
	public $email;
	public $username;
	public $password;
	public $repeatedPassword;
			
	function renderHTML($usernameValue, $mailValue){
		return $this -> RegisterFormHTML($usernameValue, $mailValue);
	}
	
	public function IsPostback(){
		if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
			return true;
		} else {
			return false;
		}
	}
	
	private function RegisterFormHTML($usernameValue, $mailValue){
		return "
			<!DOCTYPE html>
				<html lang='en'>
				  <head>
				    <meta charset='utf-8' name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
				    <title>STYGGS BETA</title>
				    <link rel='apple-touch-icon' href='images/pistol.png' />
					<link rel='apple-touch-icon' sizes='114x114' href='images/pistol.png' />
					<link rel='icon' type='image/png' href='images/gun.ico' />
				    <link rel='stylesheet' href='css/bootstrap/css/bootstrap.css'/>
				    <link rel='stylesheet' href='css/frontStyle.css'/>
				    <link href='css/phone.css' rel='stylesheet' type='text/css' media='screen and (max-device-width:481px)' />
        			<link href='css/phone.css' rel='stylesheet' type='text/css' media='(max-width:480px)' />
				    <script src='inGame/javascript/jquery-2.1.0.js'></script>
				    </head>
				
				
				<div class='' id='topMenuDiv'>
				 <a href='/projekt/info/about.html' target='_blank'>About</a> | 
				 <a href='/projekt/info/about.html#contact' target='_blank'>Contact</a>
				</div>
				
				<div id='frontDiv'> 
					<div class='" . $this->registerDivClass . "'>
						<h2>" . $this -> registerPageTitle . "</h2>
						<div id='" . $this -> registerErrorDiv . "'>
							<ul>" . $this -> ErrorList . "</ul>
						</div>
						<form id='logInForm' method='post' role='form'>
							<label for='emailInput'>Email</label>
							<br>
							<input type='text' name='emailInput' id='emailInput' placeholder='E-mail' value='$mailValue'>
							<br>
							<label for='usernameInput'>Username</label>
							<br>
							<input type='text' name='usernameInput' id='usernameInput' placeholder='Username' value='$usernameValue'>
							<br>
							<label for='passwordInput'>Password</label>
							<br>
							<input type='password' name='passwordInput' id='passwordInput' placeholder='Password'>
							<br>	
							<label for='repeatPasswordInput'>Repeat password</label>
							<br>
							<input type='password' name='repeatPasswordInput' id='repeatPasswordInput' placeholder='Repeat Password'>
							<br>										
							<input type='submit' class='btn btn-default' id='registerButton' name='registerButton' value='Register'/>
							<a href='logIn.php'>Log In</a>
						</form>
					</div>
				</div>
				<footer>
		    <div id='footer'><p>Created By Benny Carlsson And Erik Vasquez</p></div>
			</footer>
				";			
	}

	public function ValidateAllFields(){
		$this -> email = $this -> GetEnteredEmail();
		$this -> username = $this -> GetEnteredUsername();
		$this -> password  = $this -> GetEnteredPassword();
		$this -> repeatedPassword = $this -> GetEnteredRepeatedPassword();
		//Checks for input in all fields first
		if($this -> email != NULL && $this -> username != NULL && $this -> password != NULL && $this -> repeatedPassword != NULL){
			//Proceedes to validate all input
			if($this -> ComparePasswords($this -> password, $this -> repeatedPassword)){
				return true;
			} else {
				return false;
			}
		} else {
			//Add error message stating that all fields need to be entered	
			return false;		
		}
	}
	public function GetEnteredEmail(){
		if(isset($_POST['emailInput'])){
			if($_POST['emailInput'] != ""){
				return $_POST['emailInput'];		
			} else {
				$this -> AddErrorMessage("Please enter an email");	
			}		
		} else {
			$this -> AddErrorMessage("Please enter an email");
		}
	}
	public function GetEnteredUsername(){
		if(isset($_POST['usernameInput'])){
			if($_POST['usernameInput'] != ""){
				return $_POST['usernameInput'];		
			} else {
				$this -> AddErrorMessage("Please enter a username");	
			}		
		} else {
			$this -> AddErrorMessage("Please enter a username");
		}
	}
	public function GetEnteredPassword(){
		if(isset($_POST['passwordInput'])){
			if($_POST['passwordInput'] != ""){
				return $_POST['passwordInput'];		
			} else {
				$this -> AddErrorMessage("Please enter a password");	
			}		
		} else {
			$this -> AddErrorMessage("Please enter a password");
		}
	}
	public function GetEnteredRepeatedPassword(){
		if(isset($_POST['repeatPasswordInput'])){
			if($_POST['repeatPasswordInput'] != ""){
				return $_POST['repeatPasswordInput'];		
			} else {
				$this -> AddErrorMessage("Please repeat the password");	
			}		
		} else {
			$this -> AddErrorMessage("Please repeat the password");
		}
	}
	public function ComparePasswords($password, $repeatedPassword){
		if($password === $repeatedPassword){
			return true;
		}
		$this -> AddErrorMessage("The supplied passwords didn't match.");	
		return false;
	}
	public function AddErrorMessage($error){
		$this -> ErrorList = $this ->  ErrorList . "<li>" . $error .  "</li>";		
	}
}