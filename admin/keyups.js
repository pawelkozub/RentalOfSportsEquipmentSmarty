function klawisz(e){
	if(window.event) // IE
	{
		keynum = e.keyCode
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which
	}
	
	//alert(keynum);
	//var key =String.fromCharCode(keynum)
	switch(keynum){
		case 49: //1
			location.replace('index.php?action=new_mag');
		break;
		
		case 50: //2
			location.replace('index.php?action=new_wyp');
		break;

		case 51: //3
			location.replace('index.php?action=stan_mag');
		break;
		
		case 52: //4
			location.replace('index.php?action=stan_wyp');
		break;
		
		case 53: //5
			location.replace('index.php?action=new_acc');
		break;
		
		case 54: //6
			location.replace('index.php?action=stan_acc');
		break;
		
		case 55: //7
			location.replace('index.php?action=new_kat');
		break;
		
		case 56: //8
			location.replace('index.php?action=stan_kat');
		break;
		
	}
		
}
