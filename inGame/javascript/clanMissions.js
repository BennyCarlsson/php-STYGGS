$(document).ready(function(){
	$(".clanMissionDiv").hide();
  	$(".clanMissionButton").click(function(e){ 
  		$(".clanMissionDiv").hide();
	  	var uObj = new utility();
	  	//var setName = e.target.id;
	  	//var prepSetName;
	  	
	  	//alert(prepSetName);  	
	  	
	  	//alert(utilityObj.stripName(e.target.id));  
	  	var divToShow = uObj.addToNameD(uObj.stripNameB(e.target.id));
	  	$("#" + divToShow).show();
		$("#" + divToShow).offset({left:e.pageX,top:e.pageY});
	});
	
	$(".clanMissionClose").click(function(){
		$(".clanMissionDiv").hide();
	});
});

function utility() {
	//Removes the b from button id
	this.stripNameB = function(string){
		while(string.charAt('b') === 'b')
    	return string.substr(1);
	};
	//Removes the c from close link id
	this.stripNameC = function(string){
		while(string.charAt('b') === 'b')
    	return string.substr(1);
	};
	//Adds d to find correct div
	this.addToNameD = function(string){
		return "d" + string;
	};
}
