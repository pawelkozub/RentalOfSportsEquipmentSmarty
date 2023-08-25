$(document).ready(function(){
	$('#edit_cat').hide();
	$('#edit_magazine').hide();
	$('#edit_adres').hide();
	$('#edit_account').hide();
	$('#edit_acc').hide();
	$('#end_rental_office').hide();
	$('#choice_edit_account').hide();
	$('#check_rental_office').hide();
	$( "#dddd" ).hide();
	var now = new Date();
	var date_now = now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate();
	$("#data_w").val(date_now );
	var DW,DZ = Date();

	
	
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_category",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			var tekst = "<table>";
			var tekst2 = "<option value='null'>[wybierz]</option>";
			for(i=0;i<ob.length;i++){
				tekst +="<tr><td>"+ob[i].name+"</td></tr>";
				tekst2 +="<option value='"+ob[i].ID+"'>"+ob[i].name+"</option>";
			}
			tekst += "</table>";
			$("#list_cat").append(tekst);
			$("#set_cat").append(tekst2);
		}
	});
		
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_category",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			var tekst = "<table border=1 cellspacing=0>";
			if(ob.length){
				for(i=0;i<ob.length;i++){
					tekst +="<tr class='l_r'><td class='edit_row_cat' value='"+ob[i].ID+"'><span class='cursor'><img src='ikon/E.gif' height=22/></span></td>";
					tekst +="<td>"+ob[i].name+"</td></tr>";
				}
				tekst += "</table>";
				$("#view_cat").html(tekst);
			}else{
				$("#view_cat").html("brak kategorii");
			}
			var id;
			$(".edit_row_cat").click(function(){
				id = $(this).attr('value');
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=select_edit_row_cat&ID="+$(this).attr('value'),
					success: function(msg){
						ob = eval("("+msg+")");
						$('#editt_cat').attr('value',ob[0].name);
						$( "#edit_cat" ).dialog({
							autoOpen: false,
							height: 'auto',
							title: 'Edycja Kategorii',
							width: 350,
							modal: true,
							resizable:false,
							buttons: {
								'Zmien' : Save_edit_cat,
								'Usunac' : Delete_edit_cat,
								Cancel: function() {$( this ).dialog( "close" );}
							},
							close: function() {
								$( this ).dialog( "close" );
							}
						});
						$( "#edit_cat" ).dialog( "open" );
					}
				})
			});

			function Save_edit_cat(){
				var categ = $('#editt_cat').val();
				if(categ !=''){
					$.ajax({
						type: "POST",
						url: "admin/admin.php",
						data: "function=save_edit_cat&names="+categ+"&ID="+id,
						success: function(msg){
							//alert(msg);
							if(msg == 1){
								location.reload();
							}else{
								$.Zebra_Dialog('Blad zapisana, albo istnieje nazwe', {
									'type':     'information',
									'title':    'Information'
								});
							}
						}
					})
				}else{
					alert('brakuje pola');
				}
			}

			function Delete_edit_cat(){
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=select_del_row_cat&ID="+id,
					success: function(msg){
						ob = eval("("+msg+")");
						stan = ob.check;
						empty = ob.empty_cat;
						if(stan == 1){
							if(empty == 1){
								location.reload();
							}else{
								$.Zebra_Dialog('Istnieje w Magazynie', {
									'type':     'information',
									'title':    'Information'
								});
							}
						}else{
							$.Zebra_Dialog('Blad, pon�w ponowie', {
								'type':     'information',
								'title':    'Information'
							});
						}
					}
				})
			}
		}
	});
		
	$('#save_cat').click(function(){
		name = $('#name_cat').val();
		if(name != ""){
			$.ajax({
				type: "POST",
				url: "admin/admin.php",
				data: "function=save_category&name="+name,
				success: function(msg){
					//alert(msg);
					if(msg == '1'){
						location.reload();
					}else{
						$.Zebra_Dialog('Blad zapisywanie albo istnieje nazwe', {
							'type':     'information',
							'title':    'Information'					
						});	
					}
				}
			});
		}
		
	});
	
	$("#save_mag").click(function(){
		var kat = $('#set_cat').val();
		var prod = $('#marka').val();
		var model = $('#model').val();
		var opis = $('#opis').val();
		var cena = $('#cena').val();
		if(kat != 'null' && prod!='' && model!='' && opis!='' && cena!=''){
			$.ajax({
				type: "POST",
				url: "admin/admin.php",
				data: "function=save_mag&kat="+kat+"&prod="+prod+"&model="+model+"&opis="+opis+"&cena="+cena,
				success: function(msg){
					//alert(msg);
					if(msg == '1'){
						$.Zebra_Dialog('Udano zapisane', {
							'type':     'confirmation',
							'title':    'confirmation',
							'buttons':  [
								{caption: 'OK', callback: function() { location.reload();}}
							]
						});	
					}else{
						$.Zebra_Dialog('Blad zapisane, pon�w ponowie', {
							'type':     'information',
							'title':    'Information'					
						});	
					}
				}				
			})
		}else{
			$.Zebra_Dialog('Wypelnij pole', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	});
	
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_magazine",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			var mag = ob.mag;
			var cat = ob.cat;
			//alert(cat);
			var category;
			var tekst = "<table border='1' cellpadding=1 cellspacing=0>";
			tekst += "<tr><td></td><td>ID Magazyn</td><td>Kategoria</td><td>Producent</td><td>Model</td><td>Opis</td><td>Cena</td></tr>";
			var magazine = "<option value='null'>[wybierz]</option>";
			if(mag.length){
				for(i=0;i<mag.length;i++){
					for(c=0;c<cat.length;c++){
						if(mag[i].ID_cat == cat[c].ID){
							category = cat[c].name;
						}
					}
					if(mag[i].stan == 1){
						tekst +="<tr class='l_r'><td class='edit_row_mag' value='"+mag[i].ID+"'><span class='cursor'><img src='ikon/E.gif' height=22/></span></td><td>"+mag[i].ID+"</td>";
						tekst +="<td>"+category+"</td><td>"+mag[i].prod+"</td><td>"+mag[i].model+"</td><td><span onmouseover='overlib('asdf',WIDTH,300)'>"+mag[i].opis+"</span></td><td>"+mag[i].cena+"</td>";
						magazine +="<option value='"+mag[i].ID+"'>ID: "+mag[i].ID+" "+category+" "+mag[i].prod+" "+mag[i].model+"</option>";
					}else{
						tekst +="<tr class='l_r'><td><span class='cursor'></td><td>"+mag[i].ID+"</td>";
						tekst +="<td>"+category+"</td><td>"+mag[i].prod+"</td><td>"+mag[i].model+"</td><td>"+mag[i].opis+"</td><td>"+mag[i].cena+"</td>";
						
					}	
				}
			}
			$('#list_magazine').append(magazine);
			$('#view_magazine').html(tekst);
			
			var idd = 0;
			$('.edit_row_mag').click(function(){
				var id = $(this).attr('value');
				idd = id;
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=select_edit_row_mag&ID="+id,
					success: function(msg){
						//alert(msg);
						ob = eval("("+msg+")");
						idd = ob[0].ID;
						$("#set_cat option[value='"+ob[0].ID_cat+"']").attr("selected", "selected")
						$('#marka').attr('value',ob[0].prod);
						$('#model').attr('value',ob[0].model);
						//.$('#opis').attr('value',ob[0].opis);
						document.getElementById("opis").value = ob[0].opis;
						$('#cena').attr('value',ob[0].cena);
						$( "#edit_magazine" ).dialog({
							autoOpen: false,
							height: 'auto',
							title: 'Edycja Kategorii',
							width: 350,
							modal: true,
							resizable:false,
							buttons: {
								'Akcept' : Save_edit_mag,
								'Usunac' : Delete_edit_mag,
								Cancel: function() {$( this ).dialog( "close" );}
							},
							close: function() {
								$( this ).dialog( "close" );
							}
						});
						$( "#edit_magazine" ).dialog( "open" );
					}
				})
			})	
			
			function Delete_edit_mag(){
				//alert(idd);
				$.Zebra_Dialog('Na pewno usunac?', {
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
								url: "admin/admin.php",
								data: "function=delete_edit_mag&ID="+idd,
								success: function(msg){
									//alert(msg);
									if(msg == '1'){
										$.Zebra_Dialog('Udano usunieto', {
											'type':     'confirmation',
											'title':    'confirmation',
											'buttons':  [
												{caption: 'OK', callback: function() { location.reload();}}
											]
										});	
									}else{
										$.Zebra_Dialog('Blad usuneto, pon�w ponowie', {
											'type':     'information',
											'title':    'Information'					
										});	
									}
								}
							})
						}
					}
				});
			}
			
		
			function Save_edit_mag(){
				var kat = $('#set_cat').val();
				var prod = $('#marka').val();
				var model = $('#model').val();
				var opis = $('#opis').val();
				var cena = $('#cena').val();
				if(kat != 'null' && prod!='' && model!='' && opis!='' && cena!=''){
					$.ajax({
						type: "POST",
						url: "admin/admin.php",
						data: "function=save_edit_mag&kat="+kat+"&prod="+prod+"&model="+model+"&opis="+opis+"&cena="+cena+"&id="+idd,
						success: function(msg){
							//alert(msg);
							if(msg == '1'){
								$.Zebra_Dialog('Udano zapisane', {
									'type':     'confirmation',
									'title':    'confirmation',
									 'buttons':  [
										{caption: 'OK', callback: function() { location.reload();}}
										]
								});	
							}else{
								$.Zebra_Dialog('Blad zpisane, pon�w ponowie', {
									'type':     'information',
									'title':    'Information'					
								});	
							}
						}				
					})
				}else{
					alert('brakuje pola');
				}
			}
		}				
	})
	
	function SprawdzEmail(mail){
		var wzor = /^[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*@([a-zA-Z0-9_-]+)(\.[a-zA-Z0-9_-]+)*(\.[a-zA-Z]{2,4})$/;
		var Wynik = mail.match(wzor);
		return Wynik == null? false : true;
	}

	
	$("#save_account").click(function(){
		var name1 = $('#name').val();
		var name2 = $('#name2').val();
		var street = $('#street').val();
		var city = $('#city').val();
		var nick = $('#user').val();
		var mail = $('#mail').val();
		if(name1 != '' && name2 != '' && street!='' &&  city!='' && nick!='' && SprawdzEmail(mail)){
			$.ajax({
				type: "POST",
				url: "admin/admin.php",
				data: "function=check_account&nick="+nick+"&mail="+mail,
				success: function(msg){
					//alert(msg);
					ob = eval("("+msg+")");
					var ist = ""
					ist += (ob.nick == 0 ? "istnieje nick \n":"");
					ist += (ob.mail == 0? "istnieje maila":"");
					if(ist != ""){
						$.Zebra_Dialog(ist, {
									'type':     'information',
									'title':    'Information'					
								});	
					}
					
					if(ob.mail == 1 && ob.nick == 1){
						$.ajax({
							type: "POST",
							url: "admin/admin.php",
							data: "function=save_account&name="+name1+"&name2="+name2+"&street="+street+"&city="+city+"&nick="+nick+"&mail="+mail,
							success: function(msg){
								alert(msg);
								var ob = eval("("+msg+")");
								var info = "";
								info += (ob.adres == 1? "Adres zapisano \n":"Adres b��d \n");
								info += (ob.user == 1?  "User zapisano \n" : "User b��d \n");
								info += (ob.mail == 1? "Mail wys�ano \n " : "Mail nie wys�ano \n");
								$.Zebra_Dialog(info, {
									'type':     'information',
									'title':    'Information',
									'buttons':  [
										{caption: 'OK', callback: function() {Location.reload();}}
									]
								});	
								
							}
									
						});	
					}
				}
			})
		}else{
			$.Zebra_Dialog('Blad wypelnij adresy albo nieprawdilowo maila', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	});
	
	
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_account",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			var tekst = "<table border=1 cellspacing=0><tr><td></td><td>ID</td><td>Nick</td><td>Mail</td><td>Imi�</td><td>Nazwisko</td><td>Ulic</td><td>Miasto</td></tr>";
			var l_account = "<option value='null'>[wybierz]</option>";
			if(ob.length){
				for(i=0;i<ob.length;i++){
					tekst +="<tr class='l_r'><td class='edit_row_acc' value='"+ob[i].ID+"'><span class='cursor'><img src='ikon/E.gif' height=22/></span></td>";
					tekst +="<td>"+ob[i].ID+"</td><td>"+ob[i].user+"</td><td>"+ob[i].mail+"</td><td>"+ob[i].name+"</td><td>"+ob[i].surname+"</td><td>"+ob[i].streets+"</td><td>"+ob[i].city+"</td>";
					l_account +="<option value='"+ob[i].ID+"'>"+ob[i].name+" "+ob[i].surname+"</option>";
				}
				tekst += "</table>";
				$("#view_account").html(tekst);
				$("#list_client").append(l_account);
			}else{
				$("#view_account").html("brak klient�w");
			}
			
			
			$('.edit_row_acc').click(function(){
				idd = $(this).attr('value');
				$( "#choice_edit_account" ).dialog({
					autoOpen: false,
					height: 'auto',
					title: 'Edycja Klient',
					width: 350,
					modal: true,
					resizable:false,
					buttons: {
						'Adres' : B_edit_adres,
						'Konta' : B_edit_account,
						Cancel: function() {$( this ).dialog( "close" );}
					}
				});
				$( "#choice_edit_account" ).dialog( "open" );
			})
			
			function B_edit_adres(){
				//$('#choice_edit_account').hide();
				$( "#choice_edit_account" ).dialog( "close" );
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=select_edit_row_adr&ID="+idd,
					success: function(msg){
						//alert(msg);
						var ob = eval("("+msg+")");
						$('#name').attr('value',ob[0].name);
						$('#name2').attr('value',ob[0].surname);
						$('#street').attr('value',ob[0].streets);
						$('#city').attr('value',ob[0].city);
						$( "#edit_adres" ).dialog({
							autoOpen: false,
							height: 'auto',
							title: 'Edycja Adres Klient',
							width: 350,
							modal: true,
							resizable:false,
							buttons: {
								'Zmien' : Save_e_adr,
								Cancel: function() {$( this ).dialog( "close" );}
							},
							close: function() {
								$( this ).dialog( "close" );
							}
						});
						$( "#edit_adres" ).dialog( "open" );
					}
				});		
			
			}
			var mail;
			function B_edit_account(){
				$( "#choice_edit_account" ).dialog( "close" );
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=select_edit_row_acc&ID="+idd,
					success: function(msg){
						//alert(msg);
						var ob = eval("("+msg+")");
						mail = ob;
						$('#mail').attr('value',ob);
						$( "#edit_acc" ).dialog({
							autoOpen: false,
							height: 'auto',
							title: 'Edycja Kategorii',
							width: 350,
							modal: true,
							resizable:false,
							buttons: {
								'Zmien' :Save_e_acc,
								'Usunac' : Del_e_acc,
								Cancel: function() {$( this ).dialog( "close" );}
							},
							close: function() {
								$( this ).dialog( "close" );
							}
						});
						$( "#edit_acc" ).dialog( "open" );
					}
				});		
			
			}
			
			function Del_e_acc(){
				//alert(idd);
				
				$.Zebra_Dialog('Na pewno usunac?', {
					'type':     'information',
					'title':    'Information',
					'buttons':  [
						{caption: 'TAK', callback: function(){}},
						{caption: 'NO', callback: function() { }}
						],
					  'onClose':  function(caption) {
							if(caption == "TAK"){
								$.ajax({
									type: "POST",
									url: "admin/admin.php",
									data: "function=del_acc&ID="+idd,
									success: function(msg){
										//alert(msg);
										ob = eval("("+msg+")");
										if(ob.stan == 1){
											if(ob.empty_ren == 1){
												if(ob.del == 1){
													$.Zebra_Dialog("Usuneto konta", {
														'type':     'information',
														'title':    'Information',
														'buttons':  [
															{caption: 'Ok', callback: function() {location.reload();}}
														]
													});		
												}else{
													$.Zebra_Dialog('Blad', {
														'type':     'information',
														'title':    'Information'					
													});	
												}	
											}else{
												$.Zebra_Dialog('Istnieje w wypozyczen', {
													'type':     'information',
													'title':    'Information'					
												});		
											}	
										}else{
											$.Zebra_Dialog('Blad', {
												'type':     'information',
												'title':    'Information'					
											});		
										}
									}
								})
							}
						}
				});
				
				
				
			}
			
			function Save_e_adr(){
				var name1 = $('#name').val();
				var name2 = $('#name2').val();
				var street = $('#street').val();
				var city = $('#city').val();
				if(name1!='' && name2!='' && street!='' && city!=''){
					$.ajax({
						type: "POST",
						url: "admin/admin.php",
						data: "function=save_adres&name1="+name1+"&name2="+name2+"&street="+street+"&city="+city+"&id="+idd,
						success: function(msg){
							if(msg == '1'){
								$.Zebra_Dialog('Udano zapisane', {
									'type':     'confirmation',
									'title':    'confirmation',
									'buttons':  [
										{caption: 'OK', callback: function() { location.reload();}}
									]
								});
							}else{;
								$.Zebra_Dialog('Blad', {
									'type':     'information',
									'title':    'Information'					
								});	
							}
						}
					})
				}else{
					$.Zebra_Dialog('Wypelnij brakuje pola', {
						'type':     'information',
						'title':    'Information'					
					});
				}
			}
			
			function Save_e_acc(){
				var mail = $('#mail').val();
				if(mail!=''){
					if(SprawdzEmail(mail)){
						$.ajax({
							type: "POST",
							url: "admin/admin.php",
							data: "function=save_e_acc&mail="+mail+"&id="+idd,
							success: function(msg){
								
								ob = eval("("+msg+")");
								var tekst = "";
								tekst += (ob.row == 0?"Istnieje maila \n":"");
								tekst += (ob.update == 1?"Udane zapisaono":"Nie udane zapisano");
								$.Zebra_Dialog(tekst, {
									'type':     'information',
									'title':    'Information'					
								});	
								if(ob.row == 1 && ob.update == 1){
									$.Zebra_Dialog('Udano zapisane', {
										'type':     'confirmation',
										'title':    'confirmation',
										'buttons':  [
											{caption: 'OK', callback: function() { location.reload();}}
										]
									});
								}
								
							}
						});
					}else{
						$.Zebra_Dialog('Nie prawdilowo adresy maila', {
							'type':     'information',
							'title':    'Information'					
						});	
					}
					
				}else{
					$.Zebra_Dialog('Wypelnij pola', {
						'type':     'information',
						'title':    'Information'					
					});	
				}					
			}
			
			$('#generator').click(function(){
				//alert(mail);
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=generator&mail="+mail,
					success: function(msg){
						//alert(msg);
						ob = eval("("+msg+")");
						if(ob.stan == 1){
							$.Zebra_Dialog('Udano generatora', {
								'type':     'confirmation',
								'title':    'confirmation',
								'buttons':  [
									{caption: 'OK', callback: function() { location.reload();}}
								]
							});	
						}else{
							$.Zebra_Dialog('Blad generatora', {
								'type':     'information',
								'title':    'Information'					
							});
						}
					}
				});	
			})
			
			$('#b_activation').click(function(){
				//alert(mail);
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=activation&mail="+mail,
					success: function(msg){
						//alert(msg);
						ob = eval("("+msg+")");
						if(ob.stan == 1){
							$.Zebra_Dialog('Udano aktywnacji', {
									'type':     'confirmation',
									'title':    'confirmation',
									'buttons':  [
										{caption: 'OK', callback: function() { location.reload();}}
									]
								});	
						}else{
							$.Zebra_Dialog('Blad aktywnacji', {
								'type':     'information',
								'title':    'Information'					
							});	
						}
						
					}
				});
			})
			
		}
	});
	
	
	$("#save_new_wyp").click(function(){
		var l_client = $('#list_client').val();
		var l_magazine = $('#list_magazine').val();
		var date_w = $('#data_w').val();
		var date_z = $('#data_z').val();
		if(date_w<date_z){
			if(l_client !='null' && l_magazine!='null'){
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=save_rental_office&id_c="+l_client+"&id_m="+l_magazine+"&date_w="+date_w+"&date_z="+date_z,
					success: function(msg){
						//alert(msg);
						if(msg == 1){
							$.Zebra_Dialog('Udano zapisano', {
								'type':     'confirmation',
								'title':    'confirmation',
								'buttons':  [
									{caption: 'OK', callback: function() { location.reload();}}
								]
							});	
						}else{
							$.Zebra_Dialog('Blad zapisane', {
								'type':     'information',
								'title':    'Information'					
							});	
						}
						
					}
				});
			}else{
				$.Zebra_Dialog('wybierz pole klient lub magazynu', {
					'type':     'information',
					'title':    'Information'					
				});	
			}
		}else{
			$.Zebra_Dialog('Nie prawdilowo date zwrotu', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	})
	var id_wyp;
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_rental_office&id=empty",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")");
			tekst = "<table border=1 cellpadding=2 cellspacing=0><tr><td></td><td>ID</td><td>imie</td><td>nazwisko</td><td>Kategoria</td><td>Prod</td><td>Model</td><td>Cena</td><td>Date Wypo�u</td><td>Date Zwrotu</td></tr>";
			if(ob){
				for(i=0;i<ob.length;i++){
					tekst +="<tr class='l_r'><td class='edit_row_wyp' value='"+ob[i].ID+"'><span class='cursor'><img src='ikon/E.gif' height=22/></span></td>";
					tekst +="<td>"+ob[i].ID+"</td><td>"+ob[i].name+"</td><td>"+ob[i].surname+"</td><td>"+ob[i].cat+"</td><td>"+ob[i].prod+"</td><td>"+ob[i].model+"</td><td>"+ob[i].cena+"</td><td>"+ob[i].Date_w+"</td><td>"+ob[i].Date_z+"</td>";
					tekst +="</tr>";
				}
				tekst += "</table>";
				$("#view_rental_office").html(tekst);
				
				$(".edit_row_wyp").click(function(){
					id_wyp = $(this).attr('value');
					$.ajax({
						type: "POST",
						url: "admin/admin.php",
						data: "function=set_rental_office&id="+id_wyp,
						success: function(msg){
							//alert(msg);
							ob = eval("("+msg+")");
							DW = new Date(ob[0].Date_w).getTime();
							DZ = new Date(ob[0].Date_z).getTime();
							var delta_day = (DZ-DW)/(1000*60*60*24);
							$('#view_data_w').html(ob[0].Date_w);
							$("#view_data_z").val(ob[0].Date_z);
							$( "#check_rental_office" ).dialog({
								autoOpen: false,
								height: 'auto',
								title: 'Edycja Wypozyczalnia',
								width: 350,
								modal: true,
								resizable:false,
								buttons: {
									'Zmien' : Save_edit_rental_office,
									'Zwrot' : Zwrot,
									Cancel: function() {$( this ).dialog( "close" );}
								},
								close: function() {
									$( this ).dialog( "close" );
								}
							});
							$( "#check_rental_office" ).dialog( "open" );
							//$('#check_rental_office').show();
						}
					})
					
					
				})
			}else{
				$("#view_rental_office").html("Brak wypozyczen");
			}
		}
	});
	
	function Save_edit_rental_office(){
		var DZ_val = $('#view_data_z').val()
		DZ = new Date(DZ_val).getTime();
		var DNOW = new Date().getTime();
		var delta_day = (DZ-DNOW)/(1000*60*60*24);
		var delta_day2 = (DZ-DW)/(1000*60*60*24);
		if(delta_day+1>0){
			if(delta_day2>0){
				$.ajax({
					type: "POST",
					url: "admin/admin.php",
					data: "function=save_edit_rental_office&id="+id_wyp+"&DZ="+DZ_val,
					success: function(msg){
						//alert(msg);
						if(msg == 1){
							$.Zebra_Dialog('Udano zapisano', {
								'type':     'confirmation',
								'title':    'confirmation',
								'buttons':  [
									{caption: 'OK', callback: function() { location.reload();}}
								]
							});	
						}else{
							$.Zebra_Dialog('Blad zapisana', {
								'type':     'information',
								'title':    'Information'					
							});	
						}
					}
				})
			}else{
				$.Zebra_Dialog('Blad date zwrotu', {
					'type':     'information',
					'title':    'Information'					
				});	
			}
		}else{
			$.Zebra_Dialog('Przeterminowane', {
				'type':     'information',
				'title':    'Information'					
			});	
		}
	}
	function Round(n, k){
		var factor = Math.pow(10, k);
		return Math.round(n*factor)/factor;
	}
	
	function Zwrot(){
		$( "#check_rental_office" ).dialog( "close" );
		$.ajax({
			type: "POST",
			url: "admin/admin.php",
			data: "function=view_rental_office&id="+id_wyp,
			success: function(msg){
				//alert(msg);
				ob = eval("("+msg+")");
				var date_w = new Date(ob[0].Date_w).getTime();
				var date_z = new Date(ob[0].Date_z).getTime();
				var now = new Date();
				var yyyy = now.getFullYear().toString();
				var mm = (now.getMonth()+1).toString();
				var dd = now.getDate().toString();
				var nnn = yyyy+"-"+mm+"-"+dd;
				var date_n = new Date(nnn).getTime();
				var roz = Round((date_z-date_n)/(1000*60*60*24),0);
				var cena = ob[0].cena;
				if(roz<=0){
					roz = Round((date_z-date_w)/(1000*60*60*24),0);
					cost = roz * cena;
					var nad = Round((date_n-date_z)/(1000*60*60*24),0);
					cost1 = (nad*cena)/2;
					$('#end_rental_office').html("Przez "+roz+" dni kosztowa�o "+cost+" z�otych \n Przekroczyl "+nad+" dni kosztowal kary "+cost1+" zlotych \n W sumie: "+(cost+cost1)+" zlotych");	
				}else{
					var roz = Round((date_n-date_w)/(1000*60*60*24),0);
					roz = (roz == 0? 0.5:roz);
					var cost = roz * cena;
					$('#end_rental_office').html("Przez "+roz+" dni kosztowa�o "+cost+" z�otych");	
				}
				//var cost = delta_day*ob[0].cena;
				var id_m = ob[0].ID_M;
				//$('#end_rental_office').html("Przez "+delta_day+" dni kosztowa�o "+cost+" z�otych"+Round(nad,0));
				Zwroot(id_wyp,id_m);
			}
		})
		
		function Zwroot(id_wyp, id_m){
			$( "#end_rental_office" ).dialog({
				autoOpen: false,
				height: 'auto',
				title: 'Zwrot',
				width: 350,
				modal: true,
				resizable:false,
				buttons: {
					'Zaplacono': function() {
						$.ajax({
							type: "POST",
							url: "admin/admin.php",
							data: "function=paid_rental_office&id="+id_wyp+"&id_m="+id_m,
							success: function(msg){
								//alert(msg);
								if(msg == 1){
									$.Zebra_Dialog('Udano Zaplacono', {
										'type':     'confirmation',
										'title':    'confirmation',
										'buttons':  [
											{caption: 'OK', callback: function() { location.reload();}}
										]
									});	
								}else{
									$.Zebra_Dialog('Blad sewerze', {
										'type':     'information',
										'title':    'Information'					
									});	
								}
								
							}
						});	
					},
					Cancel: function() {$( this ).dialog( "close" );}
				},
				close: function() {
					$( this ).dialog( "close" );
				}
			});
			$( "#end_rental_office" ).dialog( "open" );	
		}
		
		
	};
	//
	
	$.ajax({
		type: "POST",
		url: "admin/admin.php",
		data: "function=view_all_reserv",
		success: function(msg){
			//alert(msg);
			ob = eval("("+msg+")"); 
			var category;
			var tekst = "<table border='1' cellpadding=1 cellspacing=0>";
			tekst +="<tr><td></td><td>ID</td><td>Imi�</td><td>Nazwisko</td><td>ID Magazyn</td><td>Kategoria</td><td>Producent</td><td>Model</td><td>Cena</td><td>Data Wa�no��</td></tr>";
			var magazine = "<option value='null'>[wybierz]</option>";
			if(ob){
				for(i=0;i<ob.length;i++){
					tekst +="<tr class='l_r'><td class='edit_row_reserv_c' value='"+ob[i].ID+"'><span class='cursor'><img src='ikon/E.gif' height=22/></span></td>";
					tekst +="<td>"+ob[i].ID+"</td><td>"+ob[i].name+"</td><td>"+ob[i].surname+"</td><td>"+ob[i].ID_M+"</td><td>"+ob[i].cat+"</td><td>"+ob[i].prod+"</td><td>"+ob[i].model+"</td><td>"+ob[i].cena+"</td><td class='date_waz' value='"+ob[i].Data_accept+"'>"+ob[i].Data_accept+"</td>";
					tekst +="</tr>";
				}
			}else{
				tekst = "Brak lista rezerwacje klient�w";
			}
			$('#reserv_all_client').html(tekst);
			
			var idd
			$('.edit_row_reserv_c').click(function(){
				idd = $('.edit_row_reserv_c').attr('value');
					$( "#dddd" ).dialog({
						autoOpen: false,
						height: 'auto',
						width: 350,
						modal: true,
						resizable:false,
						buttons: {
							'Aktywnuj' : Change_res_on_ren,
							'Usunac' : Delete_res,
							Cancel: function() {$( this ).dialog( "close" );}
						},
						close: function() {
							$( this ).dialog( "close" );
						}
					});
					$( "#dddd" ).dialog( "open" );	
		
				
				
				function Change_res_on_ren(){
					var validity = new Date();
					var yyyy = validity.getFullYear().toString();
					var mm = (validity.getMonth()+1).toString();
					var dd = validity.getDate().toString();
					var dw = yyyy+"-"+mm+"-"+dd;
					var dz = $("#data_z").val();
					dww = new Date(dw);
					dzz = new Date(dz);
					if(dww<dzz){
						$.ajax({
							type: "POST",
							url: "admin/admin.php",
							data: "function=change_reserv_on_rental&ID="+idd+"&dw="+dw+"&dz="+dz,
							success: function(msg){
								//alert(msg);
								if(msg == 1){
									$.Zebra_Dialog('Udano zapisano', {
										'type':     'confirmation',
										'title':    'confirmation',
										'buttons':  [
											{caption: 'OK', callback: function() { location.reload();}}
										]
									});	
								}else{
									$.Zebra_Dialog('Blad, pon�w', {
										'type':     'information',
										'title':    'Information'					
									});	
								}
							}
						})
					}else{
						$.Zebra_Dialog('Nie prawdilowe date zwrotu', {
							'type':     'information',
							'title':    'Information'					
						});	
					}
					
				}
				
				function Delete_res(){
					$.Zebra_Dialog('Na pewno usunac?', {
						'type':     'information',
						'title':    'Information',
						'buttons':  [
							{caption: 'TAK', callback: function(){} },
							{caption: 'NO', callback: function() {}}
							],
						  'onClose':  function(caption) {
								if(caption == "TAK"){
									$.ajax({
										type: "POST",
										url: "admin/admin.php",
										data: "function=delete_res&ID="+idd,
										success: function(msg){
											//alert(msg);
											if(msg == '1'){
												$.Zebra_Dialog('Udano usunieto', {
													'type':     'confirmation',
													'title':    'confirmation',
													 'buttons':  [
														{caption: 'OK', callback: function() { location.reload();}}
														]
												});	
											}else{
												$.Zebra_Dialog('Blad usuneto, pon�w ponowie', {
													'type':     'information',
													'title':    'Information'					
												});	
											}
										}
									})
								}
							}
					})	
				}
				
			})

		}				
	})
});	