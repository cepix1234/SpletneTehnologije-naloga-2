<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Airsoft slovenija forum</title>
<link href="css/stil_Index.css" rel="stylesheet" type="text/css">
<link href="css/stil_Komentar.css" rel="stylesheet" type="text/css">
<link href="css/stil_gumbi.css" rel="stylesheet" type="text/css">
<script src="skripte/gumbiNazaj.js"></script>
<script>
function odjava()
	{
		DoPostOdjavaK(<?php echo $_POST["id"]?>);
	}
function uredi(id,nazaj,idTeme)
	{
		DoPostUrediK(id,nazaj,idTeme);
	}

function prijaviSe(id)
	{
		DoPostPrijaviSe(id);
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
	if(isset($_POST["komentiraj"]))
	{
		if(trim($_POST["komentar"]) != "")
		{
			if($_SESSION["prijavljen"])
			{
				date_default_timezone_set("Europe/Ljubljana");
				ForumDB::addKomnet($_POST["id"],$_SESSION["idPrijavljen"],date("Y-m-d h:i:s"),$_POST["komentar"]);
			}else
			{
				date_default_timezone_set("Europe/Ljubljana");
				ForumDB::addKomnet($_POST["id"],1,date("Y-m-d h:i:s"),$_POST["komentar"]);
			}
			$st =  (int)ForumDB::getNumberOfKomnetsThme($_POST["id"]);
			ForumDB::steviloKomentarjve($_POST["id"],$st);
		}
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if($_SESSION["prijavljen"])
		{
			if(isset($_POST["odjava"]))
				$_SESSION["prijavljen"] = false;
		}else if(isset($_POST["prijava"]))
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


<div class="col-1">
<?php  
if(!$_SESSION["prijavljen"])
{
?>
	<form class="loginForm" method="post">
		Uporabniško ime: <input type="text" name="ime" ><br>
		Geslo: <input type="password" name="geslo"><br>
		<input type="hidden" name="id" value="<?php echo $_POST["id"]?>">
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
	<button onClick="nazajNa('/')" class="nazajGK">Nazaj</button>

	<div class="naslovTeme">
			<?php echo ForumDB::returnImeTeme($_POST["id"])?>
	</div>
	
	<div class="temeDiv">
		
		<?php
			$komentarji = ForumDB::returnAllKoments($_POST["id"]);
			foreach($komentarji as $komentar)
			{?>
			<div class="komentar">
				<table border="0" class="tabelaKomentarja">
					<tr>
						<td>
							<img src="slike/<?php echo ForumDB::returnSlika($komentar["ID_Uporabnika"]) ?>" class="slikaKomentar">
						</td>
						<td>
							<a class="imeKomentar"><?php echo ForumDB::returnName($komentar["ID_Uporabnika"])?></a>
							<div class ="vsebinaKomentar"><?php echo $komentar["Vsebina"] ?></div>
						</td>
					</tr>
				</table>
			</div>

			<?php
			}
		?>
		
	</div>
	<div >
		<form class="noviKomentarForm" method="post">
			<?php 
				if(!$_SESSION["prijavljen"]){
			?>
			Komentiraj aninimno ali pa se prijavi <button onClick="javascript:prijaviSe(<?php echo $_POST["id"]?>)"  type="button"  class="prijavaKomentar">Prijava</button>
			<?php 
				}
			?>
			<textarea class="txtAKomentar" name="komentar" cols="40" rows="5"></textarea><br>
			<input type="hidden" name="id" value="<?php echo $_POST["id"]?>">
			<input class="novaTemaSubmit" name="komentiraj" type="submit" value="Komentiraj">
		</form>
	</div>
</div>
<div class="col-4 footer">
	Ustvaril Blaž Ocepek bo2710@student.uni-lj.si 63140179
</div>
<body>
</body>
</html>