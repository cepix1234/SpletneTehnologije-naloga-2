<?php

require_once "DBInit.php";

class ForumDB {
	public static function newUser($ime, $geslo, $mail, $slika)
	{
		$kodiranG = md5($geslo);
		
		$db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO `uporabniki`(`Ime`, `Geslo`, `Email`, `Slika`) VALUES (:ime,:geslo,:email,:slika)");
        $statement->bindParam(":ime", $ime);
		$statement->bindParam(":geslo", $kodiranG);
		$statement->bindParam(":email", $mail);
		$statement->bindParam(":slika", $slika);
        $statement->execute();
	}
	
	
	public static function logIn($ime, $geslo)
	{
		$kodiranG = md5($geslo);
		
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT ID_Uporabnika, Geslo FROM  `uporabniki` WHERE `Ime` LIKE  :ime");
        $statement->bindParam(":ime", $ime);
        $statement->execute();
		
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			if($kodiranG == $vrstica[0]["Geslo"])
			{
				return $vrstica[0]["ID_Uporabnika"];
			}else
			{
				return false;
			}
		}
		return false;
	}
	
	public static function returnName($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Ime FROM  `uporabniki` WHERE  `ID_Uporabnika` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["Ime"];
		}
		return "";
	}
	
	public static function returnNumberThems($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT count(`ID_Uporabnika`) as total FROM `teme` WHERE `ID_Uporabnika` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["total"];
		}
		return "";
	}
	
	public static function returnNuberCommnets($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT COUNT(  `ID_Uporabnika` ) as total FROM  `komentarji` WHERE  `ID_Uporabnika` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["total"];
		}
		return "";
	}
	
	public static function returnAllThems()
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT *  FROM `teme`");
        $statement->bindParam(":id", $id);
        $statement->execute();
		return $statement->fetchAll();
	}
	
	public static function addTheme($id,$ime)
	{		
		$db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO `teme`(`ID_Uporabnika`, `Ime_Teme`, `SteviloKomentarjev`) VALUES (:id,:ime,0)");
        $statement->bindParam(":id", $id);
		$statement->bindParam(":ime", $ime);
        $statement->execute();
	}
	
	public static function returnSlika($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT  `Slika` FROM  `uporabniki` WHERE  `ID_Uporabnika` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["Slika"];
		}
		return "";
	}
	
	public static function updateUser($id,$ime,$slika)
	{		
		$db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE `uporabniki` SET `Ime`= :ime,`Slika`= :slika where `ID_Uporabnika` = :id");
        $statement->bindParam(":id", $id);
		$statement->bindParam(":ime", $ime);
		$statement->bindParam(":slika", $slika);
        $statement->execute();
	}

	
	public static function returnImeTeme($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT `Ime_Teme` FROM `teme` WHERE `ID_Teme` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["Ime_Teme"];
		}
		return "";
	}
	
	
	public static function returnAllKoments($id)
	{
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM  `komentarji` WHERE  `ID_Teme` = :id ORDER BY Cas ASC");
        $statement->bindParam(":id", $id);
        $statement->execute();
		return $statement->fetchAll();
	}
	
	public static function addKomnet($id,$uporabnik,$cas,$txt)
	{		
		$db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO  `forum`.`komentarji` (`ID_Teme` , `ID_Uporabnika` , `cas` ,`Vsebina`) VALUES (:id,  :idup, :cas,  :txt);");
        $statement->bindParam(":id", $id);
		$statement->bindParam(":idup", $uporabnik);
		$statement->bindParam(":cas", $cas);
		$statement->bindParam(":txt", $txt);
        $statement->execute();
	}
	
  	public static function steviloKomentarjve($id,$st)
	{		
		$db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE  `teme` SET  `SteviloKomentarjev` = :st WHERE  `ID_Teme` = :id");
        $statement->bindParam(":id", $id);
		$statement->bindParam(":st", $st);
        $statement->execute();
	}
	
	public static function getNumberOfKomnetsThme($id)
	{		
		$db = DBInit::getInstance();

        $statement = $db->prepare("SELECT Count(`ID_Teme`) as vsi FROM `komentarji` WHERE `ID_Teme` = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
		$vrstica = $statement->fetchAll();
		if(count($vrstica) >0)
		{
			return $vrstica[0]["vsi"];
		}
		return "";
	}
	
}
