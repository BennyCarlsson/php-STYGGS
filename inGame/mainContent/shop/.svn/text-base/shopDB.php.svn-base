<?php

require_once 'db/db.php';

Class ShopDB{
	const price = 10;
	
	public function __constuct(){
		
	}
	
	public function buyFollowers($id, $amount){
		$followers = $this->getUsersfollowers($id);
		$newFollowers = $followers + $amount;
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL updateFollowers('$id','$newFollowers')");
		$connection->close();
	}
	private function takeMoney($id, $cost, $cash){
		$newCash = $cash - $cost;
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL updateMoney('$id','$newCash')");
		$connection->close();
	}
	public function checkAmountOfFollowers($userId, $amount){
		$cash = $this->getUserCash($userId);
		$cost = $amount * self::price;
		if($cash >= $cost){
			$this->takeMoney($userId, $cost, $cash);
			$this->buyFollowers($userId, $amount);	
			return TRUE;
		}
		return FALSE;
	}
	
	//checks so you have enough cash not followers ^^
	private function getUserCash($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getMoneyOnId('$id')");
		$connection->close();
		$obj = $result->fetch_object();
		return $obj->Money;
		
	}
	
	private function getUsersfollowers($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getFollowersOnId('$id')");
		$connection->close();
		$obj = $result->fetch_object();
		return $obj->Followers;
		
	}
}
