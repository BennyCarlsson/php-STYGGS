<?php

require_once('chat/controller/chatController.php');
require_once('events/controller/eventsController.php');
require_once('gameMenu/controller/gameMenuController.php');
require_once('mainContent/controller/mainContentController.php');
require_once('stats/controller/statsController.php');
require_once('topMenu/controller/topMenuController.php');

class inGameController {
	private $chatController;
	private $eventsController;
	private $gameMenuController;
	private $mainContentController;
	private $statsController;
	private $topMenuController;
	
	public function __construct(){
		$this -> chatController = new chatController();
		$this -> eventsController = new eventsController();
		$this -> gameMenuController = new gameMenuController();
		$this -> mainContentController = new mainContentController();
		$this -> statsController = new statsController();
		$this -> topMenuController = new topMenuController(); 
	}
	
	
	
	public function GetHTML(){
		//$chat = $this -> chatController -> GetHTML();
		$events = $this -> eventsController -> GetHTML();
		$gameMenu = $this -> gameMenuController -> GetHTML();
		$mainContent = $this -> mainContentController -> GetHTML();
		$topMenu = $this -> topMenuController -> GetHTML();
		$stats = $this -> statsController -> GetHTML();
		
		//<link rel='stylesheet' href='css/bootstrap/css/bootstrap.css'>
		return "<!DOCTYPE html>
				<html lang='en'>
				  <head>
				    <meta charset='utf-8'>
				    <title>STYGGS BETA</title>
				    <link rel='apple-touch-icon' href='images/pistol.png' />
					<link rel='apple-touch-icon' sizes='114x114' href='images/pistol.png' />
				    <link rel='icon' type='image/png' href='images/gun.ico' />
				    <link rel='stylesheet' href='css/bootstrap/css/bootstrap.css' />
				    <link rel='stylesheet' href='css/style.css' />
				    <link rel='stylesheet' href='css/ClanMissionsMap.css' />
				    <link href='css/phone.css' rel='stylesheet' type='text/css' media='screen and (max-device-width:481px)' />
        			<link href='css/phone.css' rel='stylesheet' type='text/css' media='(max-width:480px)' />
				    <script src='inGame/javascript/jquery-2.1.0.js'></script>
				    <script src='inGame/javascript/script.js'></script>
				    <script src='inGame/javascript/countdown.js'></script>
				    <script src='inGame/javascript/clanMissions.js'></script>
				  </head>
				  <body>
				    $topMenu
				    $events
				    $stats
				    $gameMenu			    
				    $mainContent
				    <footer>
				    <div id='footer'><p>Created By Benny Carlsson And Erik Vasquez</p></div>
					</footer>			    
				  </body>
				</html>";
	}
}