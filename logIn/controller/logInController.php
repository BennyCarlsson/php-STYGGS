<?php

require_once 'logIn/view/logInView.php';
require_once 'logIn/view/logInViewReturner.php';
require_once 'logIn/model/logInModel.php';

Class LogInController{
	private $logInView;
	private $logInViewReturner;
	private $logInModel;
	
	public function __construct(){
		$this->logInView = new LogInView();
		$this->logInViewReturner = new LogInViewReturner();
		$this->logInModel = new LogInModel();
		
	}
	function controller(){
		//if login is sucessfull go to ingame.php
		if($this->logInView->logInButtonCheck()){
			//check so username and password is NOT empty
			if($this->logInView->viewCheck()){
				$username = $this->logInViewReturner->getUsername();
				$password = $this->logInViewReturner->getPassword();
				//makes model login check
				if($this->logInModel->tryLogIn($username, $password)){
					header("Location: inGame.php");	
				}else{
					$this->logInView->logInFormHtml(2);
				}
			}
			else{
				$this->logInView->logInFormHtml(1);
			}
			
		}
		else{
			$this->logInView->logInFormHtml(0);	
		}
	}
	
}