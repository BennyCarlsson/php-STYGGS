<?php

require_once 'register/controller/registerController.php';
//if (defined('ROOT_PATH')) { echo 'Defined';} else { echo 'Not defined'; }
$registerController = new registerController();
echo $registerController -> DoRegister();

//destroy loginsession