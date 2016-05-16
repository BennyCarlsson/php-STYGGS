<?php
require_once 'db/db.php';
Class ScoreboardDB{
	
	public function getLevelList(){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getLevelList()");
		$connection->close();
		return $result;
	}
	public function getCashList(){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getCashList()");
		$connection->close();
		return $result;
	}
	public function getFollowersList(){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getFollowersList()");
		$connection->close();
		return $result;
	}
	public function getRespectList(){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getRespectList()");
		$connection->close();
		return $result;
	}
}
