<?php

Class ScoreboardView{

	public function getHTML($levelList, $cashList, $followerList, $respectList){
		$levelListHTML = $this->getLevelListHTML($levelList);
		$cashListHTML = $this->getCashListHTML($cashList);
		$followerListHTML = $this->getFollowerListHTML($followerList);
		$respectListHTML = $this->getRespectListHTML($respectList);
		
		$html = "<div id='playerScoreboardDiv'><h3>Scoreboard!</h3>";
		$html .= $levelListHTML;
		$html .= $cashListHTML;
		$html .= $followerListHTML;
		$html .= $respectListHTML;
		$html .= "</div>";
		
		return $html;
	}	
	private function getLevelListHTML($levelList){
		$levelListHTML = "";
		$levelListHTML .="<ol><h4>Level</h4>";	
		while($obj = $levelList->fetch_object()){
			$levelListHTML .="<li>$obj->Username  :  $obj->Level</li>";
		}
		$levelListHTML .="</ol>";
		return $levelListHTML;
	}
	private function getCashListHTML($cashList){
		$cashListHTML = "";
		$cashListHTML .= "<ol><h4>Cash</h4>";
		while($obj = $cashList->fetch_object()){
			$cashListHTML .="<li>$obj->Username  :  $obj->Money</li>";
		}
		$cashListHTML .="</ol>";
		return $cashListHTML;
	}
	private function getFollowerListHTML($followerList){
		$followerListHTML = "";
		$followerListHTML .="<ol><h4>Followers</h4>";
		while($obj = $followerList->fetch_object()){
			$followerListHTML .= "<li>$obj->Username  :  $obj->Followers</li>";
		}
		$followerListHTML .="</ol>";
		return $followerListHTML;
	}
	private function getRespectListHTML($respectList){
		$respectListHTML = "";
		$respectListHTML .= "<ol><h4>Respect</h4>";
		while($obj = $respectList->fetch_object()){
			$respectListHTML .= "<li>$obj->Username  :  $obj->Respect</li>";
		}
		$respectListHTML .= "</ol>";
		return $respectListHTML;
	}	
}












