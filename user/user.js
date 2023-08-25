$(document).ready(function(){
	var ID_C=0;
	$('#accept_reserv').hide();
	$.ajax({
		type: "POST",
		url: "user/user.php",
		data: "function=my_account",
		success: function(msg){
			//alert(msg);
			var ob = eval("("+msg+")");
			ID_C = ob[0].ID;
			$('#imie').html(ob[0].name);
			$('#nazwisko').html(ob[0].surname);
			$('#ulica').html(ob[0].streets);
			$('#miasto').html(ob[0].city);
			$('#mail').html(ob[0].mail);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "user/user.php",
		data: "function=my_rangle",
		success: function(msg){
			//alert(msg);
			var tekst = "<table border='1' cellpadding=1 cellspacing=0><tr><td>ID</td><td>Kategoria</td><td>Producent</td><td>Model</td><td>Cena</td><td>Date wypozu</td><td>Date zwrotu</td></tr>";
			obs = eval("("+msg+")");
			var ob = obs.list;
			var len = obs.row
			if(len>0){
				for(i=0;i<len;i++){
					 tekst +="<tr><td>"+ob[i].ID+"</td><td>"+ob[i].cat+"</td><td>"+ob[i].prod+"</td><td>"+ob[i].model+"</td><td>"+ob[i].cena+"</td><td>"+ob[i].Date_w+"</td><td>"+ob[i].Date_z+"</td></tr>";
				}
				$('#view_rangle').html(tekst);
			}else{
				$('#view_rangle').html('brak wypo¿yczeñ');
			}
			}
	});
	
	$.ajax({
		type: "POST",
		url: "user/user.php",
		data: "function=my_reserv",
		success: function(msg){
			//alert(msg);
			var tekst = "<table border='1' cellpadding=1 cellspacing=0><tr><td>ID</td><td>Kategoria</td><td>Producent</td><td>Model</td><td>Opis</td><td>Cena</td><td>Wa¿noœæ</td><td></td></tr>";
			ob = eval("("+msg+")");
			var mag = ob.mag;
			var cat = ob.cat
			var reserv = ob.reserv;
			if(reserv){
				for(i=0;i<reserv.length;i++){
					for(n=0;n<mag.length;n++){
						if(reserv[i].ID_M == mag[n].ID){
							prod = mag[n].prod;
							model = mag[n].model
							cena = mag[n].cena;
							opis = mag[n].opis;
							cats = mag[n].ID_cat;
						}
					}
					for(n=0;n<cat.length;n++){
						if(cats == cat[n].ID){ 
							var category = cat[n].name;
						}
					}
					
					 tekst +="<tr><td>"+reserv[i].ID+"</td><td>"+category+"</td><td>"+prod+"</td><td>"+model+"</td><td>"+opis+"</td><td>"+cena+"</td><td>"+reserv[i].Data_accept+"</td>";
					 tekst +="<td class='del_my_reserv' value='"+reserv[i].ID+"'><span class='cursor'><img src='ikon/D.gif' width='20' /></span></tr>";
				}
				$('#list_my_reserv').html(tekst);
			}else{
				$('#list_my_reserv').html('brak twoje rezerwacje');
			}
		
		$('.del_my_reserv').click(function(){
			id = $(this).attr('value');
			$.Zebra_Dialog('Na pewno usunac rezerwacje pod nr: '+id, {
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
									url: "user/user.php",
									data: "function=del_my_reserv&id="+id,
									success: function(msg){	
										//alert(msg);
										if(msg == 1 ){
											location.reload();
										}else{
											alert("B³ad systemie, ponów");
										}
									}
								})
							}
						}
				})
			})
		}
	});
	
	
	var ID = 0;
	var dw = 0;
	$.ajax({
		type: "POST",
		url: "user/user.php",
		data: "function=view_magazine",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			var mag = ob.mag;
			var cat = ob.cat;
			var row_reserv = ob.row_reserv;
			//alert(cat);
			var category;
			var tekst = "<table border='1' cellpadding=1 cellspacing=0>";
			if(mag){
				for(i=0;i<mag.length;i++){
					for(c=0;c<cat.length;c++){
						if(mag[i].ID_cat == cat[c].ID) category = cat[c].name;
					}
					if(row_reserv>2){
						tekst +="<tr class='l_r'><td>&nbsp;</td><td>"+mag[i].ID+"</td>";
						tekst +="<td>"+category+"</td><td>"+mag[i].prod+"</td><td>"+mag[i].model+"</td><td><span onmouseover='overlib('asdf',WIDTH,300)'>"+mag[i].opis+"</span></td><td>"+mag[i].cena+"</td>";
					}else{
						tekst +="<tr class='l_r'><td class='rez_row_mag' value='"+mag[i].ID+"'><span class='cursor'><img src='ikon/O.gif' height=22/></span></td><td>"+mag[i].ID+"</td>";
						tekst +="<td>"+category+"</td><td>"+mag[i].prod+"</td><td>"+mag[i].model+"</td><td><span onmouseover='overlib('asdf',WIDTH,300)'>"+mag[i].opis+"</span></td><td>"+mag[i].cena+"</td>";
					}
				}
			}else{
				tekst = "Pusty Magazynie";
			}
			$('#list_mag').html(tekst);
			
			$('.rez_row_mag').click(function(){
				ID = $(this).attr('value');
				var DNOW = new Date().getTime();
				var delta_day = (DNOW)/(1000*60*60*24);
				delta_day+=7;
				var date_w = delta_day *(1000*60*60*24);
				var validity = new Date(date_w);
				var yyyy = validity.getFullYear().toString();
				var mm = (validity.getMonth()+1).toString();
				var dd = validity.getDate().toString();
				var full_date_w = yyyy+"-"+mm+"-"+dd
				dw = full_date_w;
				$('#validity_reserv').html("Jeœli akceptujesz to bêdziesz wa¿noœæ do dnia: "+full_date_w);
				$( "#validity_reserv" ).dialog({
					autoOpen: false,
					height: 'auto',
					title: 'Zapis rezerwacje',
					width: 350,
					modal: true,
					resizable:false,
					buttons: {
						'OK' : Acep_res,
						Cancel: function() {$( this ).dialog( "close" );}
					},
					close: function() {
						$( this ).dialog( "close" );
					}
				});
				$( "#validity_reserv" ).dialog( "open" );
			
			})
		}
	})
	
	function Acep_res(){
		$.ajax({
			type: "POST",
			url: "user/user.php",
			data: "function=save_reserve&id_m="+ID+"&id_c="+ID_C+"&dw="+dw,
			success: function(msg){
				//alert(msg);
				if(msg == '1'){
					$.Zebra_Dialog('Dziekuje za rezerwacje, serdecznie zapraszamy', {
						'type':     'confirmation',
						'title':    'confirmation',
						 'buttons':  [
							{caption: 'OK', callback: function() { location.reload();}}
							]
					});	
				}else{
					$.Zebra_Dialog('Blad zapisane, ponów ponowie', {
						'type':     'information',
						'title':    'Information'					
					});	
				}
			}
		})
	};
})