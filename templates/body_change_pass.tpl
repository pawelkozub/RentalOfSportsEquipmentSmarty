<script>
$(document).ready(function(){
	$('#change_passed').hide();
	$( "#change_passed" ).dialog({
		autoOpen: false,
		height: 'auto',
		title: 'Nowy Hasla',
		width: 350,
		modal: true,
		resizable:false,
		buttons: {
			'Zmiana' : New_pass,
		}
	});
	$( "#change_passed" ).dialog( "open" );
	
	function New_pass(){
		var pass1 = $('#new_pass_1').val();
		var pass2 = $('#new_pass_2').val();
		if(pass1 !='' && pass2 !=''){
			if(pass1 == pass2){
				$.ajax({
					type: "POST",
					url: "login/login.php",
					data: "function=save_pass&pass="+pass1,
					success: function(msg){
						//alert(msg);
						if(msg == 1){
							$.Zebra_Dialog('Udano zapisano', {
								'type':     'confirmation',
								'title':    'confirmation',	
							});	
							location.reload()
						}else{
							$.Zebra_Dialog('Blad, ponowie', {
								'type':     'information',
								'title':    'Information'					
							});	
						}
					}
				})
			}else{
				$.Zebra_Dialog('Nie prawdilowe Hasla', {
					'type':     'information',
					'title':    'Information'					
				});	
				$('#new_pass_1').val('');
				$('#new_pass_2').val('');
			}
		}else{
			$.Zebra_Dialog('Wypelnij pole', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	}


})
</script>
<div id='change_passed'>
<center>
<table border=0>
<tr><td>Nowy Has³a:</td><td><input type='password' id='new_pass_1' /></td><tr>
<tr><td>Ponowie Has³a:</td><td><input type='password' id='new_pass_2' /></td><tr>

</table>
<center>
</div>