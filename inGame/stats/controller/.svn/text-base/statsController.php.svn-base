<?php

require_once 'inGame/stats/view/statsView.php';
require_once 'inGame/stats/view/statsSessions.php';
require_once 'inGame/stats/model/statsDB.php';
require_once 'sessionHandler.php';

class statsController{
	private $statsView;
	private $statsDB;
	private $sessionHandler;
	
	public function __construct(){
		$this->statsView = new StatsView();
		$this->statsSessions = new StatsSessions();
		$this->statsDB = new StatsDB();
		$this->sessionHandler = new logInSessionHandler();
	}
	
	public function GetHTML(){
		$id = $this->statsSessions->getUserId();
		$username = $this->statsDB->getUsernameOnId($id);
		$money = $this->statsDB->getMoneyOnId($id);
		$lvl = $this->statsDB->getLvlOnId($id);
		$xp = $this->statsDB->getXpOnId($id);
		$followers = $this->statsDB->getFollowersOnId($id);
		$dailyMissionsRemaining = $this->statsDB->getDailyMissionsCompletedOnId($id);
		$clanName = $this->statsDB->getClanOnId($id);
		$this->statsSessions -> createStatsSessions($money, $lvl, $xp, $followers, $dailyMissionsRemaining,$clanName);		
		$statsHtml = $this->statsView->getStatsHtml($username, $money, $lvl, $xp, $this -> getXpLimit($lvl), $followers,$dailyMissionsRemaining,$clanName);
		return $statsHtml;
	}
	
	private function getXpLimit($lvl){
		return round(100 * pow(1.15, $lvl), 0, PHP_ROUND_HALF_UP);
	}
}