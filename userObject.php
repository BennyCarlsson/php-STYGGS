<?php
require_once 'db/db.php';
Class UserObject{
	private $con;
	private $db;
	public $username;
	public $level;
	public $xp;
	public $cash;
	public $followers;
	public $dailyMissionsCompleted;
	public $clan;
	
	public function __construct($id){
		$this->username = $this->setUsername($id);
		$this->level = $this->setLevel($id);
		$this->xp = $this->setXp($id);
		$this->cash = $this->setCash($id);
		$this->followers = $this->setFollowers($id);
		$this->dailyMissionsCompleted = $this->setDailyMissionsCompleted($id);; 
		$this->clan = $this->setclan($id);
	}
	private function setUsername($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getUsernameOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Username;
	}
	private function setLevel($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getLvlOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Level;
	}
	private function setXp($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getXpOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Experience;
	}
	private function setCash($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getMoneyOnId('$id')");
		$obj = $result->fetch_object();
		$connection -> close();
		return $obj->Money;
	}
	private function setFollowers($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getFollowersOnId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->Followers;
	}
	private function setDailyMissionsCompleted($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getDailyMissions('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->DailyMissionsCompleted ;
	}
	private function setClan($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanNameOnUserId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		if($obj->Name == null || $obj->Name == ""){
			return"No Clan";	
		}
		return $obj->Name ;
	}
}
















