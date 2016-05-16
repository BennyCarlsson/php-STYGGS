<?php

require_once 'scoreboardDB.php';

Class scoreboardModel{
	private $scoreboardDB;
	
	public function __construct(){
		$this->scoreboardDB = new ScoreboardDB();
	}
	
	public function getLevelList(){
		$levelList = $this->scoreboardDB->getLevelList(); 
		return $levelList;
	}
	public function getCashList(){
		$cashList = $this->scoreboardDB->getCashList(); 
		return $cashList;
	}
	public function getFollowersList(){
		$followerList = $this->scoreboardDB->getFollowersList();
		return $followerList;
	}
	public function getRespectList(){
		$respectList = $this->scoreboardDB->getRespectList();
		return $respectList;
	}
}
