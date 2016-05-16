<?php
require_once 'logIn/controller/logInController.php';
require_once 'sessionHandler.php';
$sessionHandler = new logInSessionHandler();
$logInController = new LogInController();
$sessionHandler->unsetLoggedInSession();
$logInController->controller();