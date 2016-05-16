<?php

require_once('ResetDAL.php');
require_once('inGame/mainContent/clanMissions/clanObjective.php');
require_once 'actionResults.php';

Class Reset {
	
	const upgradeDivider = 100;
	const respectDivider = 1000;
	
	private $ResetDAL;
	private $actionResult;
	
	public function __construct(){
		$this -> ResetDAL = new ResetDAL();
		$this->actionResult = new ActionResults();
	}
	
	public function ResetDailyMissions(){
		$this -> ResetDAL -> ResetDailyMissions();
	}
	
	public function ResolveClanObjectives(){
		$objectiveArray = $this -> ResetDAL -> GetAllClanObjectives();
		$actionsArray = $this -> ResetDAL -> GetAllObjectiveActions();
		$this->ResetDAL->deleteOldActionResults();
		foreach($objectiveArray as $objective){
			
			$defendingClanId = 0;
			$defendingUnits = 0;
			
			$greatestAttackerId = 0;
			$greatestAttackerUnits = 0;
			
			$winningClanId = 0;
			
			foreach($actionsArray as $action){
				if($objective -> objectiveId == $action -> ClanObjectiveId){
					if($action -> AttackingUnits > $greatestAttackerUnits){
						$greatestAttackerUnits = $action -> AttackingUnits;
						$greatestAttackerId = $action -> ClanId;
					} else if($action -> DefendingUnits > $defendingUnits){
						$defendingUnits = $action -> DefendingUnits;
						$defendingClanId = $action -> ClanId;
					}
				}
				if($defendingUnits >= $greatestAttackerUnits){
					$winningClanId = $defendingClanId;
				} elseif($greatestAttackerUnits > $defendingUnits){
					$winningClanId = $greatestAttackerId;
				}
			}
			//Skicka battle results
			$this->actionResult->actionResultsFunction($objective->objectiveName, $winningClanId, $defendingClanId, $defendingUnits, $greatestAttackerId, $greatestAttackerUnits);

			//Set new owner
			$this -> ResetDAL -> SetNewObjectiveOwner($objective -> objectiveId, $winningClanId);
		}		
		//Clear all objective actions
		$this -> ResetDAL -> ClearObjectiveActions();
		$this -> SetJsonDate();
	}

	public function GiveObjectiveRewards(){
		$objectiveArray = $this -> ResetDAL -> GetAllClanObjectives();
		
		foreach($objectiveArray as $objective){
			$usersInClan = $this -> ResetDAL -> GetPlayersOnClanId($objective -> ownerId);
			if(!is_null($usersInClan)){
				foreach($usersInClan as $user){
					$upgradeCoefficient = 1 + ($objective -> incomeUpgrade / self::upgradeDivider);
					$respectCoefficient = 1 + ($user -> Respect / self::respectDivider);
					$xpReward = $objective -> baseXpIncome * ($upgradeCoefficient * $respectCoefficient);
					$cashReward = $objective -> baseCashIncome  * ($upgradeCoefficient * $respectCoefficient);
					$this -> ResetDAL -> GiveRewardsOnId($user -> Id, $xpReward, $cashReward);
				}
			}
		}
	}
	
	public function ResetEventMission(){
		$eventIds = array();
		$eventIds = $this -> ResetDAL -> GetAllEventIds();
		$randId = array_rand($eventIds);
		//echo $eventIds[$randId];
		$this -> ResetDAL -> PickNewEvent($eventIds[$randId]);
		$this -> ResetDAL -> ResetEventMissionCompletion();
	}
	
	public function SetJsonDate(){
		$jsonurl = "dateJSON/date.json";
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json);
		
		$dateOffset = strtotime("+3 day");
		$json_output -> {'NextReset'} = date('F d, Y', $dateOffset);
		
		$newDate = json_encode($json_output);
		file_put_contents($jsonurl, $newDate);
	}
}
