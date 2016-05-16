<?php

require_once 'shopDB.php';

Class ShopModel{
	private $shopDB;
	
	public function __construct(){
	$this->shopDB = new ShopDB();
	}
	public function checkAmountOfFollowers($userId, $amount){
		
		return FALSE;
	}
	public function buyFollowers($userId, $amount){
			//checks amount of followers
		if($this->shopDB->checkAmountOfFollowers($userId, $amount)){
			return TRUE;
		}	 
	}
	
	public function checkInput($input){
		if($input == "" || $input = null || !is_numeric($input) || $input < 0){
			return FALSE;
		}
		return TRUE;
	}
}
