<?php

class StatsView{
	
	public function getStatsHtml($username, $money, $lvl, $xp, $xpReq, $followers, $dailyMissionsRemaining, $clanName){
		return "<div id='statsDiv'>
		$clanName | $username <br>
		Level: $lvl |
		Experience: $xp / $xpReq <br>
		Cash: $money |				
		Followers: $followers <br>
		Daily Missions Done: $dailyMissionsRemaining/10
		</div>";
	}
}
