<?php

//require_once('clanObjective.php');
require_once('clanMissionsDAL.php');
require_once('sessionHandler.php');
require_once('inGame/stats/model/eriksStatsUpdate.php');
require_once('inGame/stats/model/statsDB.php');

class clanMissionsController {
	
	private $clanMissionsDAL;
	private $sessionHandler;
	private $updatePlayerStats;
	private $getPlayerStats;
	
	const upgradeCost = 100;
	
	private $userId;
	
	public function __construct(){
		$this -> clanMissionsDAL = new clanMissionsDAL();
		$this -> sessionHandler = new logInSessionHandler();
		$this -> updatePlayerStats = new EriksStatsUpdate();
		$this -> getPlayerStats = new statsDB();
		$this -> userId = $this -> sessionHandler -> getUserId();
		$this -> CheckObjectivesAction();
	}
	
	private function CheckObjectivesAction(){
		$userId = $this -> userId;
		$userClanId = $this -> clanMissionsDAL -> getClanIdOnUserId($userId);
		if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST'){
			if(isset($_POST['didOffensive'])){
				if($_POST['didOffensive'] != "" && $_POST['attackUnits'] > 0){
					$attackingUnits = $this -> CheckFollowers($_POST['attackUnits']);
					$this -> clanMissionsDAL -> addAttackers($userClanId, $_POST['objectiveId'], $attackingUnits, $userId);
				}
			} elseif(isset($_POST['didDefence'])){
				if($_POST['didDefence'] != ""  && $_POST['defenceUnits'] > 0){
					$defendingUnits = $this -> CheckFollowers($_POST['defenceUnits']);
					$this -> clanMissionsDAL -> addDefenders($userClanId, $_POST['objectiveId'], $defendingUnits, $userId);
				}
			} elseif(isset($_POST['didUpgrade'])){
				//Check for below zero input				
				if($_POST['didUpgrade'] != "" && $_POST['upgradeMulti'] > 0){
					$upgradeMultiplier = $this -> CheckCash($_POST['upgradeMulti']);
					$this -> clanMissionsDAL -> upgradeIncome($_POST['objectiveId'], $upgradeMultiplier);
				}	
			}
		}
	}
	
	public function GetHTML(){
		$clanMissionsArray = $this -> GetObjectives();
		$html = "<p>Take over objectives together with your Clan!</p>";
		$html .="<p> Objectives gives Experience and Cash per hour. Respect and Upgrading objecives gives more Experience and Cash per hour</p>";
		$html .= "<div id='clanMissionsMap'><img src='images/Chicago_Downtown_Aerial_View.jpg'>";
		
		$nextResetDate = $this -> GetResetDate();
		$html .= "<div id='nextResetDate'>$nextResetDate</div>";
		
		foreach($this -> GetButtons($clanMissionsArray) as $button){
			$html .= $button;
		}
		foreach($this -> GetForms($clanMissionsArray) as $objectiveDiv){
			$html .= $objectiveDiv;
		}
		$html .= "</div>";
		$html .= '
				<p>Battles is fought every third day!</p> 
				<div id="countdownDiv">
				<h4>Next Outcome: 
				<span id="countdown"></span>
				</h4>
				</div>	
				';
		$html .= $this->getActionResults();
		return $html;
	}
	
	//Give the buttons IDs that correspond to a form
	public function GetButtons($clanMissionsArray){
		$buttonArray = array();
		foreach($clanMissionsArray as $clanObjective){
			$buttonHTML = "<button class='clanMissionButton' id='b$clanObjective->objectiveId' style='top:" . $clanObjective->posY . "%;left:" . $clanObjective->posX . "%;'></button>";
			array_push($buttonArray, $buttonHTML);
		}
		return $buttonArray;
	}

	//Returns all the forms (should get hidden until corresponding button is pressed)
	public function GetForms($clanMissionsArray){
		$userId = $this -> userId;
		$userClanName = $this -> clanMissionsDAL -> getClanNameOnId($userId);
		$userClanId = $this -> clanMissionsDAL -> getClanIdOnUserId($userId);
		$clanMissionsArray = $this -> clanMissionsDAL -> getClanObjectives();
		$objectiveActionsArray = $this -> clanMissionsDAL -> getObjectiveActions();
		$clanObjectivesHTML = array();
		foreach($clanMissionsArray as $clanObjective){
			$clanObjectiveHTML = "
			<div class='clanMissionDiv' id='d$clanObjective->objectiveId' >";			
			//Info 
			$clanObjectiveHTML .="
			<div class='objectiveInfoDiv'>
			<a class='clanMissionClose' id='c$clanObjective->objectiveId'>Close</a>
			Current Owner: $clanObjective->ownerName
    		<br>Name: $clanObjective->objectiveName
    		<br>Base XP income: $clanObjective->baseXpIncome
    		<br>Base Cash income: $clanObjective->baseCashIncome
    		<br>Income upgrade coefficient: $clanObjective->incomeUpgrade%";
			
			//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
			//Fetches number of attackers from the same clan and displays conquest form
			//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
			if($userClanName != $clanObjective -> ownerName){
				$units = 0;
				foreach($objectiveActionsArray as $action){
					if($clanObjective -> objectiveId == $action -> ClanObjectiveId && $userClanId == $action -> ClanId){
						$units += $action -> AttackingUnits;	
					}
				}
				$clanObjectiveHTML.= "<br>Attacking followers from your clan: $units </div>";
				
				$clanObjectiveHTML .="
				<form method='POST'>
	    		<input type='hidden' name='didOffensive' value='didOffensive'> 
	    		<input type='hidden' name='objectiveId' value='$clanObjective->objectiveId '>    
	    		<input type='number' name='attackUnits' placeholder='Input number of followers to commit'>
	    		<input type='submit' value='Commit units to offensive'>
				</form>";	
			}
			
			//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
			//Fetches number of defenders from own clan and displays defender form
			//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
			if($userClanName == $clanObjective -> ownerName){
				$units = 0;
				foreach($objectiveActionsArray as $action){
					if($clanObjective -> objectiveId == $action -> ClanObjectiveId && $userClanId == $action -> ClanId){
						$units += $action -> DefendingUnits;
					}
				}
				$clanObjectiveHTML.= "<br>Defending units from your clan: $units </div>";
				
				$clanObjectiveHTML .="
				<form method='POST'>
	    		<input type='hidden' name='didDefence' value='didDefence'>
	    		<input type='hidden' name='objectiveId' value='$clanObjective->objectiveId '>    
	    		<input type='number' name='defenceUnits' placeholder='Input number of followers to commit'>
	    		<input type='submit' value='Commit units to defence'>
				</form>
				<form method='POST'>
	    		<input type='hidden' name='didUpgrade' value='didUpgrade'>   
	    		<input type='hidden' name='objectiveId' value='$clanObjective->objectiveId '> 
	    		<input type='number' name='upgradeMulti' placeholder='Input upgrade multiplier'>
	    		<input type='submit' value='Upgrade Objective!'>
				</form>
				";
			}			
			$clanObjectiveHTML .= "</div>";
			array_push($clanObjectivesHTML, $clanObjectiveHTML);
		}
		return $clanObjectivesHTML;
	}
	
	//Returns a list with all objectives in the database
	public function GetObjectives(){
		return $this -> clanMissionsDAL -> getClanObjectives();
	}
	
	private function ConvertAndValidateNumber($string){
		if(is_numeric($string)){
			return intval($string);
		} else {
			return "Not string";
		}
	}
	
	//if possible, removes requested amount of followers and calls function to update. Returns boolean depending on result
	private function CheckFollowers($requestedAmount){
		$availableFollowers = $this -> getPlayerStats -> getFollowersOnId($this -> userId);
		if($availableFollowers >= $requestedAmount){
			$acceptedAmount = $requestedAmount;
			$this -> UpdateFollowers($availableFollowers - $acceptedAmount);
			return $acceptedAmount;
		} else {
			return $acceptedAmount;
		}
		
	}
	//If possible, removes correct amount of cash and returns upgrademultiplier. If the player has insufficient cash 0 is returned and no cash is removed.
	private function CheckCash($requestedMultiplier){
		$availableCash = $this -> getPlayerStats -> getMoneyOnId($this -> userId);
		if(($requestedMultiplier * self::upgradeCost) < $availableCash){
			$this -> UpdateCash($availableCash - ($requestedMultiplier * self::upgradeCost));
			return $requestedMultiplier;
		} else {
			return 0;
		}
	}
	//Updates to new amount of followers
	private function UpdateFollowers($newFollowerAmount){
		$this -> updatePlayerStats -> updateFollowers($this -> userId, $newFollowerAmount);
	}
	private function UpdateCash($newCash){
		$this -> updatePlayerStats -> updateMoney($this -> userId, $newCash);
	}
	private function getActionResults(){
		$html = "<h3>Action Result!</h3>";
		$html .= $this->clanMissionsDAL->getActionResults();
		return $html;
	}
	
	public function GetResetDate(){
		$jsonurl = "dateJSON/date.json";
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json);
		
		$nextReset = $json_output -> {'NextReset'};
		
		return $nextReset;
	}
}





