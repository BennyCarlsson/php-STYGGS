<?php

require_once('db/db.php');
require_once('clanObjective.php');
require_once('objectiveAction.php');

class clanMissionsDAL {
	
	public function addClanObjectiveAction($clanId, $clanObjectiveId, $defendingUnits, $attackingUnits){
		$db = new DB();
		$connection = $db -> getCon();
		if($this -> objectiveActionExists($clanObjectiveId, $clanId) == FALSE){
			$connection->query("CALL insertClanActions('$clanId', '$defendingUnits', '$attackingUnits', '$clanObjectiveId')");	
		} else {
			$connection->query("CALL updateClanAction('$clanObjectiveId', '$clanId', '$defendingUnits', '$attackingUnits')");
		}
		
		$connection->close();
	}
	
	public function addAttackers($clanId, $clanObjectiveId, $attackingUnits, $userId){
		$this -> addClanObjectiveAction($clanId, $clanObjectiveId, 0, $attackingUnits);
		$this -> addRespect($attackingUnits,$userId);
	}
	
	public function addDefenders($clanId, $clanObjectiveId, $defendingUnits, $userId){
		$this -> addClanObjectiveAction($clanId, $clanObjectiveId, $defendingUnits, 0);
		$this -> addRespect($defendingUnits,$userId);
	}
	
	//add clanRespect after adding defendig/attacking units
	private function addRespect($units,$userId){
		//1unit = 1respect
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL updateClanRespect('$userId', '$units')");
		$connection->close();
	}
	
	public function upgradeIncome($clanObjectiveId, $upgradeMultiplier){
		$db = new DB();
		$connection = $db -> getCon();			
		$connection->query("CALL updateIncomeUpgrade('$clanObjectiveId', $upgradeMultiplier)");		
		$connection->close();
	}
	
	public function getClanObjectives(){
		$objectiveArray = array();
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClanObjectives()");
		while($row = $result->fetch_object()){
			$owner = $this->getOwnerName($row->Owner);
			array_push($objectiveArray, new clanObjective($row->objectiveId, $row->Owner, $owner, $row->Name, $row->PosX, $row->PosY, $row->xpIncom, $row->chashIncome, $row->incomeUpgrade));
		}
		$connection->close();
		return $objectiveArray;
	}
	
	public function getObjectiveActions(){		
		$actionArray = array();
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getAllObjectiveActions()");
		while($row = $result->fetch_object()){
			array_push($actionArray, new objectiveAction($row->ActionId, $row->ClanId, $row->DefendingUnits, $row->AttackingUnits, $row->ClanObjectiveId));
		}
		$connection->close();
		return $actionArray;
	}
	
	public function objectiveActionExists($objectiveId, $clanId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getObjectiveOnIds('$clanId', '$objectiveId')");
		$obj = $result->fetch_object();
		$connection ->close();		
		if(is_null($obj)){
			return false;
		}
		return true;
	}
	
	public function getOwnerName($ownerId){
		$ownerName = 0;
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClanNameOnClanID('$ownerId')");
		$row = $result->fetch_object();
		if(is_null($row)){
			$ownerName = "No current owner";
		} else {
			$ownerName = $row -> Name;
		}
		$connection->close();
		return $ownerName;
	}
	
	public function getClanNameOnId($id){
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
	
	public function getClanIdOnUserId($userId){
		$db = new DB();
		$connection = $db->getCon();
		$result = $connection->query("CALL getClanIdOnUserId('$userId')");
		$obj = $result->fetch_object();
		$connection ->close();
		if(!isset($obj->ClanId)){
			return"No clan id could be returned";	
		}
		return $obj->ClanId ;
	}
	
	public function ClearObjectiveActions(){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL resetAllObjectiveAction()");
		$connection->close();
	}
	
	public function ChangeObjectiveOwner($objectiveId, $clanId){
		$db = new DB();
		$connection = $db -> getCon();
		$connection->query("CALL updateObjectiveOwner('$objectiveId','$clanId')");
		$connection->close();
	}
	public function getActionResults(){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getActionResults()");
		$connection->close();
		$html = "<div class='resultDiv'>";
		while($obj = $result->fetch_object()){
			$winningClan = $this->getClanName($obj->WinningClan);
			$defendingClan = $this->getClanName($obj->DefendingClan);
			$attackingClan = $this->getClanName($obj->AttackingClan);
			$html .= "
					<div class='resultBoxDiv'>
					<h4>$obj->ObjectiveName</h4>
					<p><b>Defender:</b> $defendingClan: <b>Followers:</b> $obj->DefendingUnits</p>
					<p><b>Attacker:</b> $attackingClan <b>Followers:</b> $obj->AttackingUnits</p>
					<p><b>Winner:</b> $winningClan</p>
					</div>
					";
			
		}
		$html .= "</div>";
		return $html;
	}
	private function getClanName($clanId){
		$db = new DB();
		$connection = $db -> getCon();
		$result = $connection->query("CALL getClanNameOnClanID('$clanId')");
		$connection->close();
		$obj = $result->fetch_object();
		return $obj->Name;
	}
	
}













