<?php

require_once('mission.php');
require_once('inGame/stats/view/statsSessions.php');
require_once('inGame/stats/model/eriksStatsUpdate.php');

class missionsController {
	
	const dailyMissionsCap = 10;	
	private $missionsRemaining;
	
	private $statsSession;
	private $statsUpdate;
	
	private $missionsList = array();
	private $missionFormsHTML;
	
	private $highRiskOutcome = "";
	
	public function __construct(){
		$this -> statsSession = new statsSessions();
		$this -> statsUpdate = new eriksStatsUpdate();
		$this -> GetAllMissions();
		
		$this -> missionsRemaining = $this -> statsUpdate -> getDailyMissions($this -> statsSession -> getUserId());
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(isset($_POST['didMission'])){
				unset($_POST['didMission']);
				if($this -> validateMissionClearance($_POST['missionName'])){
					if(isset($_POST['highRisk'])){
						$this -> doMission($this -> getAttemptedMission($_POST['missionName']), true);
					} else {
						$this -> doMission($this -> getAttemptedMission($_POST['missionName']), false);	
					}					
				} else {
					
				}
				//$this -> doMission($this -> validateMissionClearance($_POST['missionName']));				
			}
		}
	}

	private function GetAllMissions(){
		$jsonurl = "missionJSON/missions.json";
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json);
		
		//This is the raw array
		$rawMissionsList = $json_output -> {'missionList'};
		
		foreach($rawMissionsList as $rawMission){
			$mission = new mission($rawMission -> {'missionTitle'}, $rawMission -> {'missionDescription'}, $rawMission -> {'levelReq'}, $rawMission -> {'missionReward'});
			array_push($this -> missionsList, $mission);			
		}
	}
	
	private function doMission($mission, $highRisk){
		$rewards = $mission -> rewards;
		
		if($highRisk){
			$outcome = rand(1, 10);
			if($outcome > 5){
				$rewards[0] *= 2;
				$rewards[1] *= 2;
				$rewards[2] *= 2;
				$this -> highRiskOutcome = "Success";
			} elseif($outcome <= 5){				
				$rewards[0] = 0;
				$rewards[1] = 0;
				$rewards[2] = 0;
				$this -> highRiskOutcome = "Failure!";
			}
		}
				
		$id = $this -> statsSession -> getUserId();
		$followers = $this -> statsSession -> getFollowers() + $rewards[0];
		$cash = $this -> statsSession -> getMoney() + $rewards[1];
		$currentXp = $this -> statsSession -> getXp();
		
		//TODO Check remaining daily missions first
		$xp = $this -> checkLvlUp($id, $this -> statsSession -> getLevel(), $currentXp, $rewards[2]);
		
		$this -> statsUpdate -> updateFollowers($id, $followers);
		$this -> statsUpdate -> updateMoney($id, $cash);
		$this -> statsUpdate -> updateXp($id, $xp);
		$this -> statsUpdate -> updateMissionsRemaining($id, $this -> missionsRemaining + 1);
	}
	
	//Levels up the character if the xp is sufficient and returns the remaining xp
	private function checkLvlUp($id, $currentLvl, $currentXp, $awardedXp){
		$lvl = $currentLvl;
		$totalXp = $currentXp + $awardedXp;
		$xpLimit = $this -> getXpLimit($lvl);
		while($totalXp >= $xpLimit){
			$totalXp = $totalXp - $xpLimit;
			$lvl++;
			$xpLimit = $this -> getXpLimit($lvl);
		}
		//var_dump($xpLimit);
		$this -> statsUpdate -> updateLvl($id, $lvl);
		return $totalXp;
	}
	
	private function getXpLimit($lvl){
		return 100 * pow(1.15, $lvl);
	}
	
	//Checks lvl req and that the user has daily missions remaining
	private function validateMissionClearance($missionName){
		$attemptedMission = $this -> getAttemptedMission($missionName);
		if($this -> checkLvlReq($attemptedMission -> levelReq) && $this -> checkDailyMissionCap()){
			return true;
		}
		return false;
	}
	
	private function getAttemptedMission($missionName){
		$attemptedMission;
		foreach($this -> missionsList as $mission){
			if($mission -> title == $missionName){
				$attemptedMission = $mission;
			}
		}
		return $attemptedMission;
	}
	
	private function checkLvlReq($missionLvlReq){
		if($this -> statsSession -> getLevel() >= $missionLvlReq){
			return true;
		} else {
			return false;	
		}		
	}
	
	private function checkDailyMissionCap(){
		if($this -> missionsRemaining < self::dailyMissionsCap){
			return true;
		}
		return false;
	}
	
	public function GetHTML(){
		$allMissionsHTML = "";
		$allMissionsHTML .= "<div id='highRiskOutcome'>$this->highRiskOutcome</div>";
		if($this->checkDailyMissionCap() == FALSE){
			$allMissionsHTML .= "<h4>You have already done all your Daily Missions.</h4>
					<h5>You can do more Tomorrow</h5>
					<p>Until then you can do Clan missions and Random missions (every 10min)</p>
					";
			return $allMissionsHTML;
		}else{		
		
			foreach($this -> missionsList as $mission){
					
				$rewardsHTML = "<ul>";			
				$rewardsArray = array();
				foreach($mission -> rewards as $reward){
					array_push($rewardsArray, $reward);
				}
				$rewardsHTML .= "<li>Followers : " . $rewardsArray[0] . "</li>";
				$rewardsHTML .= "<li>Cash : " . $rewardsArray[1] . "</li>";
				$rewardsHTML .= "<li>XP : " . $rewardsArray[2] . "</li>";
				$rewardsHTML .= "</ul>";
				
				$missionHTML = "			
				<form method='post'>
				<p>Mission : $mission->title</p>
				<p>Level Requirement : $mission->levelReq</p>
				<p>Description : $mission->description</p>
				<p>Rewards : </p>	
				$rewardsHTML
				<input type='hidden' name='didMission' />
				<input type='hidden' name='missionName' value='$mission->title'/>
				<div >			
				
				<input type='checkbox' class='highRiskButton' id='highRisk$mission->title' name='highRisk' value='highRisk'>
				<label for='highRisk$mission->title'>Double or nothing (Wanna try to double your rewards?)</label>  
				</div>
				<input type='submit' id='missionButton' name='missionButton' value='Do mission!'/>
				</form>";
				
				$allMissionsHTML .= $missionHTML;
			}
		}
		
		return $allMissionsHTML;
	}
}