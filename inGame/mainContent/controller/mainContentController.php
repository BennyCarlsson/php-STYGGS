<?php

require_once('inGame/mainContent/missionsContent/missionsController.php');
require_once('inGame/mainContent/clansContent/clansController.php');
require_once('inGame/mainContent/clanMissions/clanMissionsController.php');
require_once ('inGame/mainContent/clanForum/controller/clanForumController.php');
require_once ('inGame/mainContent/shop/shopController.php');
require_once ('inGame/mainContent/scoreboard/scoreboardController.php');

class mainContentController{
	
	private $missionsController;	
	private $clansController;
	private $clanMissionsController;
	private $clanForumController;
	private $shopController;
	private $scoreboardController;
	
	public function __construct(){
		$this -> missionsController = new missionsController();
		$this -> clansController = new clansController();
		$this -> clanMissionsController = new clanMissionsController();
		$this-> clanForumController = new ClanForumController();
		$this-> shopController = new ShopController();
		$this-> scoreboardController = new ScoreboardController();
	}
	
	public function GetHTML(){
		$missionsHTML = $this -> missionsController -> GetHTML();
		$clansHTML = $this -> clansController -> GetHTML();
		$clanMissionsHTML = $this -> clanMissionsController -> GetHTML();
		$clanForum = $this->clanForumController -> GetHTML();
		$shopHTML = $this->shopController->GetHTML(); 
		$scoreboard = $this->scoreboardController->GetHTML();
		
		return "<div id='mainContentDiv'>			
			<div id='missionsDiv' class='.col-md-offset-4 .col-md-8'>
			$missionsHTML
			</div>
			<div id='clansDiv'>
			$clansHTML
			</div>
			<div id='clanMissionsDiv'>
			$clanMissionsHTML
			</div>
			<div id='clanForumDiv'>
			$clanForum
			</div>
			<div id='shopDiv'>
			$shopHTML
			</div>
			<div id='scoreboardDiv'>
			$scoreboard
			</div>
		</div>";
	}	
}