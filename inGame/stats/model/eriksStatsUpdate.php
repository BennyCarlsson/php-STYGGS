<?php

Class EriksStatsUpdate {
	
	public function updateMoney($id, $money){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL updateMoney('$id','$money')");
		$connection -> close();
	}
	public function updateXp($id, $xp){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL updateXp('$id','$xp')");
		$connection -> close();
	}
	public function updateLvl($id, $lvl){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL updateLvl('$id','$lvl')");
		$connection -> close();
	}
	public function updateFollowers($id, $followers){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL updateFollowers('$id','$followers')");
		$connection -> close();
	}
	public function getDailyMissions($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getDailyMissions('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return $obj->DailyMissionsCompleted;
	}
	
	public function updateMissionsRemaining($id, $missionsRemaining){		
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL updateDailyMissions('$id','$missionsRemaining')");
		$connection -> close();
	}
	
	public function AddXp($userId, $amount){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL addXp('$userId','$amount')");
		$connection -> close();
	}
	
	public function AddMoney($userId, $amount){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL addMoney('$userId','$amount')");
		$connection -> close();
	}
	
	public function RemoveFollowers($userId, $amount){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL removeFollowers('$userId','$amount')");
		$connection -> close();
	}
}
	