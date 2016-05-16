<?php

require_once 'inGame/mainContent/clansContent/model/clanDB.php';
require_once 'inGame/mainContent/clansContent/model/clanModel.php';
require_once 'inGame/mainContent/clansContent/view/clanView.php';
require_once 'sessionHandler.php';

class clansController{
	private $clanDB;
	private $clanModel;
	private $clanView;
	private $sessionHandler;
	
	public function __construct(){
		$this->clanDB = new ClanDB();
		$this->clanView = new ClanView();		
		$this->sessionHandler = new logInSessionHandler();
	}
	
	public function GetHTML(){
		$id = $this->sessionHandler->getUserId();
		
			//clan join button
		if($this->clanView->checkbutton()){
			$clanName = $this->clanView->getClanName();
			$this->clanDB->addClanToMember($clanName, $id);
		}else if($this->clanView->checkLeaveButton()){
			 //leave button
			$this->clanDB->leaveClan($id);
		}
		
		//check if in a clan or not
		if($this->clanDB->checkClan($id)){
			//NOT IN CLAN
			$clanList = $this->clanDB->getClanList();
			$html = $this->clanView->getHTML($clanList);
		}else{
			//IN CLAN
			$memberList = $this->clanDB->getMemberList($id);
			$html = $this->clanView->getClanHTML($memberList);
		}
		
		return $html;
	}
	
}


















