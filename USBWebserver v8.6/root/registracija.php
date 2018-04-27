<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Airsoft slovenija forum</title>
<link href="css/stil_registracija.css" rel="stylesheet" type="text/css">
<link href="css/stil_gumbi.css" rel="stylesheet" type="text/css">
<script src="skripte/gumbiNazaj.js"></script>
</head>
<h1>AIRSFOT SLOVENIJA FORUM</h1>

<button onClick="nazajNa('<?php echo "/" ?>')" class="nazajG">Nazaj</button>

<?php 
	require_once("povezavaNaBazo/ForumDB.php");
	$ime = "";
	$geslo = "";
	$geslop = "";
	$email = "";
	$ok = true;
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$ime = $_POST["ime"];
		$geslo = $_POST["geslo"];
		$geslop = $_POST["geslop"];
		$email = $_POST["mail"];
		if(trim($ime) == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Vnesti morate uporabniško ime")';
			echo '</script>';
			$ok = false;
		}else if($geslo == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Vnesti morate geslo")';
			echo '</script>';
			$ok = false;
		}else if($geslop == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Ponovno morate vnesti geslo")';
			echo '</script>';
			$ok = false;
		}else if($geslop != $geslo)
		{
			echo '<script language="javascript">';
			echo 'alert("Vnešena gesla se ne ujemata")';
			echo '</script>';
			$ok = false;
		}else if(trim($email) == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Vnesti morate E-mail")';
			echo '</script>';
			$ok = false;
		}
		$slika = basename($_FILES["fileToUpload"]["name"]);
		if(basename($_FILES["fileToUpload"]["name"]) == "")
		{
			$slika = "default.jpg";
		}
		
		$target_dir = "slike/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
			

		if($ok)
		{
			ForumDB::newUser($ime,$geslo,$email,$slika);
			if(!basename($_FILES["fileToUpload"]["name"]) == "")
			{
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
				{

				}
			}
			echo '<script language="javascript">';
			echo 'alert("Uporabnik uspešno ustvarjen")';
			echo '</script>';
		}
	
	}
?>

<form class="registracijaForm" method="post" enctype="multipart/form-data">
	Uporabniško ime: <input type="text" name="ime" value="<?php if(!$ok) echo $ime?>"><br>
	Geslo: <input type="password" name="geslo" value="<?php if(!$ok) echo $geslo?>"><br>
	Ponovi geslo: <input type="password" name="geslop" value="<?php if(!$ok) echo $geslop?>"><br>
	E-mail: <input type="email" name="mail" value="<?php if(!$ok) echo $email?>"><br>	
	Izberi profilno sliko <input type="file" name="fileToUpload" id="fileToUpload"><br>
	<input type="submit" value="Ustvari uporabnika">
</form>


<div class="footer">
	Ustvaril Blaž Ocepek bo2710@student.uni-lj.si 63140179
</div>
<body>
</body>
</html>