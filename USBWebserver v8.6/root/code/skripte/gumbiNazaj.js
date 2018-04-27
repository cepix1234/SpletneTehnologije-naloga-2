function nazajNa(url)
{
	window.location.replace(url);
}

function DoPostOdjava(){
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "odjava";
	mapInputIme.value = true;
	
	
	
	mapForm.appendChild(mapInputIme);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
	
}

function DoPostOdjavaK(id){
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/komentarji.php";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "odjava";
	mapInputIme.value = true;
	
	var mapInputTema = document.createElement("input");
	mapInputTema.type = "text";
	mapInputTema.name = "id";
	mapInputTema.value = id;
	
	mapForm.appendChild(mapInputIme);
	mapForm.appendChild(mapInputTema);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
	
}

function DoPostUredi(id,nazaj){
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/urediProfil.php";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "id";
	mapInputIme.value = id;
	
	var mapInputNazaj = document.createElement("input");
	mapInputNazaj.type = "text";
	mapInputNazaj.name = "nazaj";
	mapInputNazaj.value = nazaj;
	
	mapForm.appendChild(mapInputIme);
	mapForm.appendChild(mapInputNazaj);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
	
}

function DoPostUrediK(id,nazaj,idTeme){
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/urediProfil.php";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "id";
	mapInputIme.value = id;
	
	var mapInputNazaj = document.createElement("input");
	mapInputNazaj.type = "text";
	mapInputNazaj.name = "nazaj";
	mapInputNazaj.value = nazaj;
	
	var mapInputTema = document.createElement("input");
	mapInputTema.type = "text";
	mapInputTema.name = "idTeme";
	mapInputTema.value = idTeme;
	
	
	mapForm.appendChild(mapInputIme);
	mapForm.appendChild(mapInputNazaj);
	mapForm.appendChild(mapInputTema);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
	
}


function DoPostKomnetar(id)
{
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/komentarji.php";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "id";
	mapInputIme.value = id;
	
	
	mapForm.appendChild(mapInputIme);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
}

function DoPostPrijaviSe(id)
{
	var mapForm = document.createElement("form");
	mapForm.target = "_self";
	mapForm.method = "POST";
	mapForm.action = "/prijava.php";
	
	var mapInputIme = document.createElement("input");
	mapInputIme.type = "text";
	mapInputIme.name = "id";
	mapInputIme.value = id;
	
	
	mapForm.appendChild(mapInputIme);
	
	document.body.appendChild(mapForm);
	
	mapForm.submit();
}