// JavaScript Document
var now = new Date();
var yyyy = now.getFullYear().toString();
var mm = (now.getMonth()+1).toString();
var dd = now.getDate().toString();
var nows = yyyy+"-"+mm+"-"+dd;

				
$.ajax({
	type: "POST",
	url: "login/login.php",
	data: "function=reserv&date="+nows,
	success: function(msg){
		//alert(msg);
		
	}
	});