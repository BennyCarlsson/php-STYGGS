<?php

require_once 'scoreboardView.php';
require_once 'scoreboardModel.php';

Class ScoreboardController{
	private $scoreboardModel;
	private $scoreboardView;
	
	public function __construct(){
		$this->scoreboardModel = new ScoreboardModel();
		$this->scoreboardView = new scoreboardView();
	}
	
	public function getHTML(){
		$levelList = $this->scoreboardModel->getLevelList();
		$cashList = $this->scoreboardModel->getCashList();
		$followerList = $this->scoreboardModel->getFollowersList();
		$respectList = $this->scoreboardModel->getRespectList();
		$html = $this->scoreboardView->getHTML($levelList, $cashList, $followerList, $respectList);
		return $html;
	}
}
