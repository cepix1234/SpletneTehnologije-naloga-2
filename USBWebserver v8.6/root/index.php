<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Airsoft slovenija forum</title>
<link href="css/stil_Index.css" rel="stylesheet" type="text/css">
<link href="css/stil_gumbi.css" rel="stylesheet" type="text/css">
<script src="skripte/gumbiNazaj.js"></script>
<script src="skripte/jquery-3.2.1.min.js"></script>
<script>
function odjava()
	{
		DoPostOdjava();
	}
function uredi(id,nazaj)
	{
		DoPostUredi(id,nazaj);
	}
function komntir(id)
	{
		DoPostKomnetar(id);
	}

</script>


</head>
<h1>AIRSFOT SLOVENIJA FORUM</h1>

<?php
	session_start();
	require_once("povezavaNaBazo/ForumDB.php");
	if(!isset($_SESSION["prijavljen"]))
	{
		$_SESSION["prijavljen"] = false;
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if($_SESSION["prijavljen"])
		{
			if($_POST["odjava"])
				$_SESSION["prijavljen"] = false;
		}else if (isset($_POST["prijava"]))
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
	
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if(isset($_GET["novaTema"]))
		{
			if($_SESSION["prijavljen"])
			{
				ForumDB::addTheme($_SESSION["idPrijavljen"],$_GET["novaTema"]);
				echo "<script>window.location = '/'</script>";
			}else 
			{
				ForumDB::addTheme(1,$_GET["novaTema"]);
				echo "<script>window.location = '/'</script>";
			}
		}
	}
?>


<div class="col-1">
<?php  
if(!$_SESSION["prijavljen"])
{
?>
	<form class="loginForm" method="post">
		Uporabniško ime: <input type="text" name="ime" ><br>
		Geslo: <input type="password" name="geslo"><br>
		<div style="text-align: center">
			<input class="loginSubmit" name="prijava" type="submit" value="Prijava">
		</div>
	</form>
	<div class="novRacun">
		Nov Uporabnik <a href="registracija.php">ustvari račun</a>
	</div>
<?php
	
}else{
	
?>
	
<div class="prijavljen">
	Prijavljeni ste kot : <?php echo ForumDB::returnName($_SESSION["idPrijavljen"]);?><br>
	Ustvarjenih tem : <?php echo ForumDB::returnNumberThems($_SESSION["idPrijavljen"]);?><br>
	Komentajev : <?php echo ForumDB::returnNuberCommnets($_SESSION["idPrijavljen"]);?><br>
	<button onClick="javascript:uredi(<?php echo $_SESSION["idPrijavljen"]?>,'/')" class="prijavaG">Uredi Profil</button>
	<button onClick="javascript:odjava()" class="prijavaG">Odjavi se</button>
</div>	

	
<?php	
}
?>
</div>

<div class="col-2">
	<div class="temeDiv">
	<?php 
		$teme  = ForumDB::returnAllThems();
		foreach ($teme as $tema)
		{
			?>
				<button onClick="javascript:komntir(<?php echo $tema["ID_Teme"]?>)" class="tema"><?php echo $tema["Ime_Teme"]."(".$tema["SteviloKomentarjev"].")" ?></button>
			<?php
		}
	?>
	</div>
	<div >
		<form class="novaTemaForm" method="get">
			Nova tema:
			<input class="novaTema" type="text" name="novaTema">
			<input class="novaTemaSubmit" type="submit" value="Ustvari novo temo">
		</form>
	</div>
</div>
<div class="col-4 footer">
	Ustvaril Blaž Ocepek bo2710@student.uni-lj.si 63140179
</div>
<body>
</body>
</html>