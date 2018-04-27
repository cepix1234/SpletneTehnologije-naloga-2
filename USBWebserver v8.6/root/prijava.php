<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Airsoft slovenija forum</title>
<link href="css/stil_registracija.css" rel="stylesheet" type="text/css">
<link href="css/stil_gumbi.css" rel="stylesheet" type="text/css">
<script src="skripte/gumbiNazaj.js"></script>
<script>
function nazajNa(id)
	{
		DoPostKomnetar(id);
	}
</script>

</head>
<h1>AIRSFOT SLOVENIJA FORUM</h1>

<button onClick="nazajNa('<?php echo $_POST["id"] ?>')" class="nazajG">Nazaj</button>

<?php
	session_start();
	require_once("povezavaNaBazo/ForumDB.php");
	if(!isset($_SESSION["prijavljen"]))
	{
		$_SESSION["prijavljen"] = false;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST["prijava"]))
		{
			$ime = $_POST["ime"];
			$geslo = $_POST["geslo"];
			$ok = true;
			if($ime == "")
			{
				echo '<script language="javascript">';
				echo 'alert("Vnesti morate uporabniško ime")';
				echo '</script>';
				$ok = false;
			}
			if($geslo == "")
			{
				echo '<script language="javascript">';
				echo 'alert("Vnesti morate geslo")';
				echo '</script>';
				$ok = false;
			}
			if($ok)
			{
				$id = ForumDB::logIn($ime,$geslo);
				if($id!=false)
				{
					$_SESSION["prijavljen"] = true;
					$_SESSION["idPrijavljen"] = $id;
				}else
				{
					echo '<script language="javascript">';
					echo 'alert("Napačno Uporabniško ime ali geslo")';
					echo '</script>';
				}

			}
		}
	}
?>


<?php  
if(!$_SESSION["prijavljen"])
{
?>
	<form class="registracijaForm" method="post">
		Uporabniško ime: <input type="text" name="ime" ><br>
		Geslo: <input type="password" name="geslo"><br>
		<input type="hidden" name="id" value="<?php echo $_POST["id"]?>">
		<div style="text-align: center">
			<input  name="prijava" type="submit" value="Prijava">
		</div>
	</form>
<?php
	
}else{
	
?>
	
<div class="PriavaPrijavljen">
	Prijavljeni ste kot : <?php echo ForumDB::returnName($_SESSION["idPrijavljen"]);?><br>
	Ustvarjenih tem : <?php echo ForumDB::returnNumberThems($_SESSION["idPrijavljen"]);?><br>
	Komentajev : <?php echo ForumDB::returnNuberCommnets($_SESSION["idPrijavljen"]);?>
</div>	

	
<?php	
}
?>


<div class="footer">
	Ustvaril Blaž Ocepek bo2710@student.uni-lj.si 63140179
</div>
<body>
</body>
</html>