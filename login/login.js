$(document).ready(function(){
	$('#link_logout').hide();
	$('#panel_login').hide();
	$('#panel_rejestr').hide();
	
	$.ajax({
			type: "POST",
			url: "login/login.php",
			data: "function=session",
			success: function(msg){
				//alert(msg);
				ob = eval("("+msg+")");
				var stan_session = ob.ok;
				if(stan_session == 1){
					$('#link_logout').show();
					$('#link_login').hide();
				}else{
					$('#link_logout').hide();
					$('#link_login').show();
				}
			}
		});
	
	
	$("#link_logout").click(function(){
		$.Zebra_Dialog('Na pewno wylogowac', {
			'type':     'information',
			'title':    'Information',
			'buttons':  [
				{caption: 'TAK', callback: function(){}},
				{caption: 'NO', callback: function() {}}
				],
			  'onClose':  function(caption) {
					if(caption == "TAK"){
						$.ajax({
							type: "POST",
							url: "login/login.php",
							data: "function=logout",
							success: function(msg){
								//alert(msg);	
								location.replace("index.php");
							}
						});
					}
				}
		})
		
	});
	

  $("#link_login").click(function(){
	$('#nick').val('');
	$('#pass').val('');
	$( "#panel_login" ).dialog({
		autoOpen: false,
		height: 'auto',
		title: 'Logowanie',
		width: 350,
		modal: true,
		resizable:false,
		buttons: {
			'Zaloguj' : Zaloguj,
			Cancel: function() {$( this ).dialog( "close" );}
		},
		close: function() {
			$( this ).dialog( "close" );
		}
	});
	$( "#panel_login" ).dialog( "open" );
	$('#panel_rejestr').hide();
  });
  
  $("#new_login").click(function(){
	$( "#panel_rejestr" ).dialog({
		autoOpen: false,
		height: 'auto',
		title: 'Logowanie',
		width: 350,
		modal: true,
		resizable:false,
		buttons: {
			"OK": function() {$( this ).dialog( "close" );}
		},
		close: function() {
			$( this ).dialog( "close" );
		}
	});
	$( "#panel_rejestr" ).dialog( "open" );
  });
  
  $("#close_rej").click(function(){
	$('#link_login').click();
  });
  
 function Zaloguj(){
	  var n = $('#nick').val();
	  var p = $('#pass').val();
	  if(n != '' && p!= ''){
		$.ajax({
			type: "POST",
			url: "login/login.php",
			data: "function=account&nick="+n+"&pass="+p,
			success: function(msg){
				//alert(msg);
				ob = eval("("+msg+")");
				var stan = ob.stan;
				if(stan == '1'){
					location.reload();
				}else{
					$('#nick').val('');
					$('#pass').val('');
					$.Zebra_Dialog('Blad logowanie', {
						'type':     'information',
						'title':    'Information'					
					});	
				}
				
			}
		});
	}else{
		$.Zebra_Dialog('Brakuje pola', {
			'type':     'information',
			'title':    'Information'					
		});	
	}
	};	
	
	$('#save_new_pass').click(function(){
		
	})
    
  
});