<?php
session_start();
require_once 'sessionHandler.php';
$checkSession = new logInSessionHandler();
if($checkSession->checkSession()){
	header("Location: inGame.php");	
}else{
	header("Location: logIn.php");
}
	