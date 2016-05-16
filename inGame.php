<?php

require_once 'sessionHandler.php';
require_once('inGame/inGameController.php');
$sessionHandler = new logInSessionHandler();
$inGameController = new inGameController();

if($sessionHandler->checkSession()){
	//$sessionHandler->setUserSession();
	echo $inGameController -> GetHTML();
}else{
	header("Location: logIn.php");
}
