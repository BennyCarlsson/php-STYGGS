<?php

Class LogInViewReturner{
	
	private static $username = 'Username';
	private static $password = 'Password';
	private static $keepMeLoggedInBox = 'keepMeLoggedInBox';
	
	public function getUsername(){
		if(isset($_POST[self::$username])){	
			return $_POST[self::$username];
		}
	}
	public function getPassword(){
		if(isset($_POST[self::$password]))
		return $_POST[self::$password];
	}
	public function getKeepMeLoggedInBox(){
		if(isset($_POST[self::$keepMeLoggedInBox]))
		return TRUE;
	}
}