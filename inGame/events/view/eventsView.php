<?php

Class eventsView {
	
	public function GetHTML($mission){
		$htmlContent = "";
		$htmlContent .= "<div id='eventsDiv'>
		<h5>Current random mission: </h5>";

		if(!is_null($mission)){
			$htmlContent .= 
			"<form method='post'>
			<b>$mission->name</b>
			<div>Base xp reward: $mission->baseXpReward</div>
			<div>Base cash reward: $mission->baseCashReward</div>
			<div>The reward is multiplied by how many followers you sacrifice</div>
			
			<input type='hidden' name='didRandomMission' />
			<input type='hidden' name='missionName' value='$mission->id'/>
			<input type='number' name='followerMultiplier' placeholder='Followers to commit'>
			<input type='submit' id='missionButton' name='missionButton' value='Do mission!'/>
			</form>";
		} else {
			$htmlContent .= "<p>You already completed the current random mission, but don't fear, there's a new one every 10 min!</p>";
		}
		
		$htmlContent .= "</div>";
		return $htmlContent;
	}
}
