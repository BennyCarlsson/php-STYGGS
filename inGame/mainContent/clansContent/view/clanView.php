<?php

Class ClanView{
		
	private static $clanSession = "clanSession";	
		
	public function checkbutton(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(isset($_POST['joinButton'])){
				unset($_POST['joinButton']);
				return true;
			}
		}
		return false;
	}
	public function checkLeaveButton(){
		if(isset($_POST['LeaveClan'])){
			unset($_POST['LeaveClan']);
			return TRUE;	
		}		
		return FALSE;
	}
	
	public function gethtml($clanList){
		$clanListHTML = "<div id='clanList'><p>Just Clan stuff </p>";
		foreach($clanList as $clan){
			$clanForm = "
			<form method='post'>
			<p>$clan->name</p>
			<p>Number of members: $clan->numberOfMembers</p>
			<input type='hidden' name='joinClan' />
			<input type='hidden' name='clanName' value='$clan->name'/>
			<input type='submit' id='joinButton' name='joinButton' value='Join Clan!'/>
			</form>
			";
			$clanListHTML .= $clanForm;
		}
		$clanListHTML .= "</div>";
		
		return $clanListHTML;
	}
	public function getClanHTML($memberList){
		$html = "<form method='post'>
			<input type='hidden' name='LeaveClan' value='LeaveClan'/>
			<input type='submit' id='leaveButton' name='leaveButton' value='Leave Clan!' onclick='return confirm(\"Are you sure you want to leave your clan? All respect and perks will be lost!\")'/>
			</form>";
		$html .= "<div id='memberListDiv'> <h3>MemberList!</h3>";
		while($obj = $memberList->fetch_object()){
			$html .= "
					<h4>$obj->Username</h4>
					<ul class='member'>
						
						<li>
							Respect: $obj->Respect
						</li>
						<li>
							Level: $obj->Level
						</li>
						<li>
							Money: $obj->Money
						</li>
						<li>
							Followers: $obj->Followers
						</li>
					</ul>
					";
		}
		$html .="</div>";
		return $html;
	}
	
	public function getClanName(){
		if (isset($_POST['clanName'])){
			return $_POST['clanName'];
		}
	}
}




















