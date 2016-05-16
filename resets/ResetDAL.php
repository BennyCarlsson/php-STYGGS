<?php

require_once('db/db.php');
require_once('inGame/mainContent/clanMissions/clanMissionsDAL.php');

Class ResetDAL {

	private $clanMissionsDAL;

	public function __construct(){
		$this -> clanMissionsDAL = new clanMissionsDAL();
	}
	
	public function ResetDailyMissions(){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL resetDailyMissions()");
		$connection -> close();
	}
	
	//Returns an array with all objective actions
	public function GetAllObjectiveActions(){
		return $this -> clanMissionsDAL -> getObjectiveActions();
	}
	
	//Returns an array with all clan objectives
	public function GetAllClanObjectives(){
		return $this -> clanMissionsDAL -> getClanObjectives();
	}
	
	public function ClearObjectiveActions(){
		$this -> clanMissionsDAL -> ClearObjectiveActions();
	}
	
	public function SetNewObjectiveOwner($objectiveId, $clanId){
		$this -> clanMissionsDAL -> ChangeObjectiveOwner($objectiveId, $clanId);
	}
	
	public function GetPlayersOnClanId($clanId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getUserOnClanId('$clanId')");
		$connection ->close();	
		//var_dump($obj);	
		$users = array();
		while($obj = $result->fetch_object()){
			array_push($users, $obj);
		}
		return $users;
	}
	
	public function GiveRewardsOnId($playerId, $xpReward, $cashReward){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL updateXpAndCash('$playerId', '$xpReward', '$cashReward')");
		$connection ->close();	
	}
	
	public function setActionResult($objectiveName, $winningClanId, $defendingClanId, $defendingUnits, $greatestAttackerId, $greatestAttackerUnits){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL insertActionResult('$objectiveName', '$winningClanId', '$defendingClanId', '$defendingUnits', '$greatestAttackerId', '$greatestAttackerUnits')");
		$connection ->close();	
	}	
	
	public function deleteOldActionResults(){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL deleteActionResultsData()");
		$connection ->close();
	}
	
	public function ResetEventMissionCompletion(){		
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL resetEventCompletion()");
		$connection ->close();
	}
	
	public function PickNewEvent($newId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL clearActiveEvent()");
		$connection ->close();
			
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL setActiveEvent('$newId')");
		$connection ->close();
	}
	
	public function GetAllEventIds(){
		$idArray = array();
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getAllEventIDs()");
		while($row = $result->fetch_object()){			
			array_push($idArray, $row -> EventsMissionsId);
		}
		$connection->close();
		return $idArray;
	}
}







