<?php

require_once('inGame/events/view/eventsView.php');
require_once('inGame/events/model/eventMission.php');
require_once('inGame/events/model/eventsDAL.php');
require_once('inGame/stats/model/eriksStatsUpdate.php');
require_once('inGame/stats/view/statsSessions.php');
require_once('inGame/stats/model/statsDB.php');

class eventsController{
	
	private $eventsView;
	private $currentMission;	
	private $eventsDAL;
	private $statsUpdate;
	private $statsSession;
	
	public function __construct(){
		$this -> eventsView = new eventsView();
		$this -> eventsDAL = new eventsDAL();
		$this -> statsSession = new statsSessions();
		$this -> statsUpdate = new eriksStatsUpdate();
		$this -> currentMission = $this -> GetCurrentMission();
		$this -> CheckPermission();
		$this -> CheckForCompletion();		
	}
	
	//Check if the user tried to do a random mission
	private function CheckForCompletion(){
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			
			if($this->checkIfEventIsDone()){
				if(isset($_POST['didRandomMission'])){
					unset($_POST['didRandomMission']);
					if($_POST['followerMultiplier'] > 0){
							if($this -> HasEnoughFollowers($_POST['followerMultiplier'])){
							$this -> GiveRewards($_POST['followerMultiplier']);
							$this -> MarkDone();
							$this -> currentMission = NULL;
						}
					}
				}
			}
		}
	}
	
	public function GetHTML(){
		return $this -> eventsView -> GetHTML($this -> currentMission);
	}
	
	//Returns current objective
	private function GetCurrentMission (){
		$obj = $this -> eventsDAL -> GetCurrentMission();
		return new eventMission($obj -> EventsMissionsId, $obj -> Name, $obj -> XpReward, $obj -> CashReward);
	}
	
	//Checks if the user is free to complete the mission, e.g he has not done it already
	//Sets mission to null if not
	private function CheckPermission(){
		//TODO Implement proper check
		$userId = $this -> statsSession -> getUserId();
		if(!is_null($this -> eventsDAL -> CheckComplete($userId))){
			$this -> currentMission = NULL;
		}
	}
	
	private function HasEnoughFollowers($amountRequested){
		$userId = $this -> statsSession -> getUserId();
		$DAL = new statsDB();
		$amountAvailable = $DAL -> getFollowersOnId($userId);
		if($amountRequested < $amountAvailable){
			return true;
		}
		return false;
	}
	
	private function GiveRewards($followers){
		$userId = $this -> statsSession -> getUserId();
		$this -> statsUpdate -> AddXp($userId, ($followers * $this -> currentMission -> baseXpReward));
		$this -> statsUpdate -> AddMoney($userId, ($followers * $this -> currentMission -> baseCashReward));
		$this -> statsUpdate -> RemoveFollowers($userId, $followers);
	}
	
	private function MarkDone(){
		$userId = $this -> statsSession -> getUserId();
		$this -> eventsDAL -> markComplete($userId);
	}
	
	//extra check by benny since there where a bug
	private function checkIfEventIsDone(){
		
		$userId = $this -> statsSession -> getUserId();
		if($this -> eventsDAL -> checkIfEventIsDone($userId)){
			return TRUE;
		}
		return FALSE;
	}
}




