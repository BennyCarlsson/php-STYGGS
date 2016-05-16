$(document).ready(function(){
	hideAll();
	ShowMissionOutcome();
	//Game Menu------------------
  	$("#missionsLink").click(function(){    
    	$( "#missionsDiv" ).show();
    	$( "#clansDiv" ).hide();
    	$( "#clanMissionsDiv" ).hide();
    	$( "#clanForumDiv" ).hide();
    	$( "#shopDiv" ).hide();
		$( "#scoreboardDiv" ).hide();
    	localStorage.setItem('menuChoice','missions');
	});
	$("#clanLink").click(function(){	
		$( "#clansDiv" ).show();
		$( "#missionsDiv" ).hide();
		$( "#clanMissionsDiv" ).hide();
		$( "#clanForumDiv" ).hide();
		$( "#shopDiv" ).hide();
		$( "#scoreboardDiv" ).hide();
		localStorage.setItem('menuChoice','clan');
	});
	$("#clanMissionsLink").click(function(){	
		$( "#clanMissionsDiv" ).show();
		$( "#missionsDiv" ).hide();
		$( "#clansDiv" ).hide();
		$( "#clanForumDiv" ).hide();
		$( "#shopDiv" ).hide();
		$( "#scoreboardDiv" ).hide();
		localStorage.setItem('menuChoice','clanMissions');
	});
	$("#clanForumLink").click(function(){
		$( "#clanForumDiv" ).show();
		$( "#clanMissionsDiv" ).hide();
		$( "#missionsDiv" ).hide();
		$( "#clansDiv" ).hide();
		$( "#shopDiv" ).hide();
		$( "#scoreboardDiv" ).hide();
		localStorage.setItem('menuChoice','clanForum');
	});
	$("#shopLink").click(function(){
		$( "#shopDiv" ).show();
		$( "#clanForumDiv" ).hide();
		$( "#clanMissionsDiv" ).hide();
		$( "#missionsDiv" ).hide();
		$( "#clansDiv" ).hide();
		$( "#scoreboardDiv" ).hide();
		localStorage.setItem('menuChoice','shop');
	});
	$("#scoreboardLink").click(function(){
		$( "#scoreboardDiv" ).show();
		$( "#shopDiv" ).hide();
		$( "#clanForumDiv" ).hide();
		$( "#clanMissionsDiv" ).hide();
		$( "#missionsDiv" ).hide();
		$( "#clansDiv" ).hide();
		localStorage.setItem('menuChoice','scoreboard');
	});
	//Game menu stop-------------
	
	//clanForum-------------
	$("#newPostLink").click(function(){
		$( "#newPostDiv" ).show();
		$( "#newPostLink" ).hide();
		$( "#newPostLink2" ).show();
	});
	$("#newPostLink2").click(function(){
		$( "#newPostDiv" ).hide();
		$( "#newPostLink" ).show();
		$( "#newPostLink2" ).hide();
	});
	$( "#newPostDiv" ).hide();
	$( "#newPostLink2" ).hide();
	$("#hideNewPostLink").click(function(){
	$( "#newPostDiv" ).hide();
	});
	//clanForum staph--------
		
});


function hideAll(){	
	//alert($("#nextResetDate").html());
	$("#nextResetDate").hide();
	$( "#clansDiv" ).hide();
	$( "#clanMissionsDiv" ).hide();
	$( "#missionsDiv" ).hide();
	$( "#clanForumDiv" ).hide();
	$( "#shopDiv" ).hide();
	$( "#scoreboardDiv" ).hide();
	if(localStorage.getItem('menuChoice') == "clanMissions"){
		$( "#clanMissionsDiv" ).show();
	}else if(localStorage.getItem('menuChoice') == "clanForum"){
		$( "#clanForumDiv" ).show();
	}else if(localStorage.getItem('menuChoice') == "clan"){
		$( "#clansDiv" ).show();
	}else if(localStorage.getItem('menuChoice') == "missions"){
		$( "#missionsDiv" ).show();
	}else if(localStorage.getItem('menuChoice') == "shop"){
		$( "#shopDiv" ).show();
	}else if(localStorage.getItem('menuChoice') == "scoreboard"){
		$( "#scoreboardDiv" ).show();
	};
};

function ShowMissionOutcome(){
	$("#highRiskOutcome").hide();
	if($("#highRiskOutcome").html().length > 0){
		alert($("#highRiskOutcome").text());	
	}	
};
//Ladda in JSON filer och generera html utav dom














