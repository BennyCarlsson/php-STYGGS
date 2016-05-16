$(document).ready(function(){
	
	// set the date we're counting down to
	//var target_date = new Date("jun 03, 2014").getTime();
	
	var target_date = new Date($("#nextResetDate").text()).getTime();		
	var nextReset = $("#nextResetDate").html();
	// variables for time units
	var days, hours, minutes, seconds;
	  
	setIntervalz();
	// update the tag with id "countdown" every 1 second
	// setInterval(function () {
// 	 
	    // // find the amount of "seconds" between now and target
	    // var current_date = new Date().getTime();
	    // var seconds_left = (target_date - current_date) / 1000;
// 	 
	    // // do some time calculations
	    // days = parseInt(seconds_left / 86400);
	    // seconds_left = seconds_left % 86400;
// 	     
	    // hours = parseInt(seconds_left / 3600);
	    // seconds_left = seconds_left % 3600;
// 	     
	    // minutes = parseInt(seconds_left / 60);
	    // seconds = parseInt(seconds_left % 60);
// 	     
	     // // get tag element
		// var countdown = document.getElementById("countdown");
	    // // format countdown string + set tag value
	    // countdown.innerHTML = days + "d, " + hours + "h, "
	    // + minutes + "m, " + seconds + "s";  
// 	 
	// }, 1000);
});

function setIntervalz(){
	 	var target_date = new Date($("#nextResetDate").text()).getTime();	
	 	
	 	var days, hours, minutes, seconds;
	 
	   setInterval(function () {
	 
	    // find the amount of "seconds" between now and target
	    var current_date = new Date().getTime();
	    var seconds_left = (target_date - current_date) / 1000;
	 
	    // do some time calculations
	    days = parseInt(seconds_left / 86400);
	    seconds_left = seconds_left % 86400;
	     
	    hours = parseInt(seconds_left / 3600);
	    seconds_left = seconds_left % 3600;
	     
	    minutes = parseInt(seconds_left / 60);
	    seconds = parseInt(seconds_left % 60);
	     
	     // get tag element
		var countdown = document.getElementById("countdown");
	    // format countdown string + set tag value
	    countdown.innerHTML = days + "d, " + hours + "h, "
	    + minutes + "m, " + seconds + "s";  
	 
	}, 1000);
	 
	};