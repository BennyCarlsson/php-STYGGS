<?php

require_once 'logInViewReturner.php';
require_once 'sessionHandler.php';

Class LogInView{
	private $logInFormDiv;
	private $errorMessage;
	private $LogInViewReturner;
	private $sessionHandler;
	private static $logInButton = "logInButton";
	private $topMenuController;
	
	public function __construct(){
		$this->logInFormDiv = "logInFormDiv";
		$this->LogInViewReturner = new LogInViewReturner(); 
		$this->sessionHandler = new logInSessionHandler();
	}
	
	//log in form html
	public function logInFormHtml($logInErrorNr){
		$logInError = $this->getLogInError($logInErrorNr);
		$usernameValue = $this->sessionHandler->getNameSession();
		if($usernameValue == ""){
			$usernameValue = $this->sessionHandler->getMailSession();
		}
		$this->sessionHandler->destroyNameSession();
		$this->sessionHandler->destroyMailSession();
		$logInForm = 
		"<!DOCTYPE html>
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
				
				<body>
				
				<div class='' id='topMenuDiv'>
				 <a href='/projekt/info/about.html' target='_blank'>About</a>  |
				 <a href='/projekt/info/about.html#contact' target='_blank'>Contact</a>
				</div>
				
				<div id='frontDiv'>  
				<h2>Login</h2>
    			<div id='logInFormDiv'>
				<div id='logInError'>
						<p>$logInError</p>
					</div>
					<form id='logInForm' method='post' role='form'>
						<label for='usernameLogIn'>Username Or Email</label>
						<br>
						<input type='text' name='Username' id='usernameInput' placeholder='Username' value='$usernameValue'>
						<br>
						<label for='passwordLogIn'>Password</label>
						<br>
						<input type='password' name='Password' id='passwordInput' placeholder='Password'>
						<br>
						<input type='submit' value='Log In' class='btn btn-default' id='logInButton' name='".self::$logInButton."'/>
						<a href='register.php'>Register</a>
					</form>
				</div>
				</div>
				<footer>
			    <div id='footer'><p>Created By Benny Carlsson And Erik Vasquez</p></div>
				</footer>
				</body>
		";
		echo $logInForm;		
	}
	public function logInButtonCheck(){
		if(isset($_POST[self::$logInButton])){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	//make checks at the view
	public function viewCheck(){
		$username = $this->LogInViewReturner->getUsername();
		$password = $this->LogInViewReturner->getPassword();
		if(empty($username)){
			return FALSE;
		}else if(empty($password)){
			return FALSE;
		}
		return TRUE;

			
	}
	
	private function getLogInError($logInErrorNr){
		
		switch($logInErrorNr){
			case 1:
				$logInError = "Type in Mail and Password!";
				break;
			case 2:
				$logInError = "Wrong Mail or Password";
				break;
			default:
				$logInError = "";
				break;
		}
		return $logInError;	
	}
		
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	