<?php

require_once 'db/db.php';

Class StatsDB{
	private $con;
	private $db;
	
	public function getMoneyOnId($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getMoneyOnId('$id')");
		$obj = $result->fetch_object();
		$connection -> close();
		return $obj->Money;
	}
	
	public function getLvlOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getLvlOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Level;
	}
	
	public function getXpOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getXpOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Experience;
	}
	
	public function getFollowersOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getFollowersOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Followers;
	}
	public function getUsernameOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getUsernameOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Username;
	}
	public function getDailyMissionsCompletedOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getDailyMissions('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->DailyMissionsCompleted ;
	}
	public function getClanOnId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanNameOnUserId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		if(!isset($obj->Name)){
			return"No Clan";	
		}
		return $obj->Name ;
	}
}








