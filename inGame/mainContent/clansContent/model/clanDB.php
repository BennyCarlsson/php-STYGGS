<?php

require_once 'db/db.php';
require_once 'inGame/mainContent/clansContent/model/clanObject.php';

Class ClanDB{
	
	public function getClanList(){
		$clanArray = array();
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClans()");
		while($row = $result->fetch_object()){
			$numberOfMembers = $this->getnumberOfMembers($row->ClanId);
			array_push($clanArray, new clanObject($row->Name, $numberOfMembers, 2));
		}
		$connection->close();
		return $clanArray;
	}
	
	private function getnumberOfMembers($clanId){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getCountMembers($clanId)");
		$connection->close();
		$obj = $result->fetch_object();
		return $obj->memberNumber;
	}
	
	public function addClanToMember($clanName, $id){
		$clanId = $this->getClanIdOnName($clanName);
		if($this->checkIfExists($id)){
			//already in a clan 
			$db = new DB();
			$connection = $db -> getCon();
			$connection->query("CALL alterUserClanStats('$clanId', '$id')");
			$connection->close();
		}else{
			$db = new DB();
			$connection = $db -> getCon();
			$connection->query("CALL insertUserClanStats('$id', '$clanId')");
			$connection->close();
		}
		
		
	}
	
	private function checkIfExists($id){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL checkIdExistsUserIdStats('$id')");
		$obj = $result->fetch_object();
		$connection->close();
		if($obj == "" || $obj == NULL){
			return false;
		}
		return true;
	}
	
	private function getClanIdOnName($clanName){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClanIdOnName('$clanName')");
		$obj = $result->fetch_object();
		$connection->close();
		return $obj->ClanId;
	}
	public function leaveClan($id){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL leaveClanOnId('$id')");
		$connection->close();
	}
	public function checkClan($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanNameOnUserId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		if($obj == null || $obj == ""){
			return TRUE;	
		}
		return FALSE;
	}
	public function getMemberList($id){
		$clanId = $this->getClanId($id);
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getMemberList($clanId)");
		$connection->close();
		return $result;
	}
	
	private function getClanId($id){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanIdOnUserId('$id')");
		$obj = $result->fetch_object();
		$connection ->close();
		return$obj->ClanId;
	}
}















	