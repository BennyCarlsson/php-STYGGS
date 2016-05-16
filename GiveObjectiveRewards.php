<?php

require_once('resets/Reset.php');

$reset = new Reset();

if($_GET['username'] == 'admin' && $_GET['password'] == 'bennynoob'){
	$reset -> GiveObjectiveRewards();
}