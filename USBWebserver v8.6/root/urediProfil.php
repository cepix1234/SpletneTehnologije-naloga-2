<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Airsoft slovenija forum</title>
<link href="css/stil_registracija.css" rel="stylesheet" type="text/css">
<link href="css/stil_gumbi.css" rel="stylesheet" type="text/css">
<script src="skripte/gumbiNazaj.js"></script>
<script>
function nazajNaKomentar(id)
	{
		DoPostKomnetar(id);
	}
function komntir(id)
	{
		DoPostKomnetar(id);
	}
</script>
</head>
<h1>AIRSFOT SLOVENIJA FORUM</h1>

<?php 
	if(isset($_POST["idTeme"]))
	{
		?>
		<button onClick="javascript:komntir(<?php echo $_POST["idTeme"]?>)" class="nazajG">Nazaj</button>
	<?php
	}else{
	?>
		<button onClick="nazajNa('<?php echo $_POST["nazaj"] ?>')" class="nazajG">Nazaj</button>
	<?php
	}
?>


<?php
	require_once("povezavaNaBazo/ForumDB.php");
	$ok = true;
	if(isset($_POST["uredi"]))
	{
		$ime = $_POST["ime"];
		if($ime == "")
		{
			echo '<script language="javascript">';
			echo 'alert("Vnesti morate Uporabniško ime")';
			echo '</script>';
			$ok = false;
		}
		
		$slika = basename($_FILES["fileToUpload"]["name"]);
		if(basename($_FILES["fileToUpload"]["name"]) == "")
		{
			$slika = ForumDB::returnSlika($_POST["id"]);
		}
		
		$target_dir = "slike/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		if($ok)
		{
			ForumDB::updateUser($_POST["id"],$ime,$slika);
			if(!basename($_FILES["fileToUpload"]["name"]) == "")
			{
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
				{

				}
			}
			echo '<script language="javascript">';
			echo 'alert("Uporabnik uspešno posodobljen")';
			echo '</script>';
		}
	}
?>

<form class="registracijaForm" method="post" enctype="multipart/form-data">
	Spremeni ime: <input type="text" name="ime" value="<?php echo ForumDB::returnName($_POST["id"])?>"><br>
	Izberi novo sliko <input type="file" name="fileToUpload" id="fileToUpload"><br>
	<input type="hidden" name="id" value="<?php echo $_POST["id"]?>">
	<input type="hidden" name="nazaj" value="<?php echo $_POST["nazaj"] ?>">
	<input type="submit" name="uredi" value="Shrani profil">
</form>

<div class="footer">
	Ustvaril Blaž Ocepek bo2710@student.uni-lj.si 63140179
</div>
<body>
</body>
</html>