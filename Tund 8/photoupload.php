 <?php

   require("../../../config.php");
   require("session_start.php");
   //$database = "if20_liisa_mi_1";
   
   $inputerror = null;
   $filetype = null;
   $filesizelimit = 2097152; // 1MB - 21048576
   $photouploaddir_orig = "../photoupload_orig/";
   $photouploaddir_normal = "../photoupload_normal/";
   $filenameprefix = "vp_";
   $filename = null;
   $photomaxwidth = 600;
   $photomaxheight = 400;
   $notice = null;
   
   //kui klikiti submit, siis ...
   if(isset($_POST["photosubmit"])){
	//var_dump($_POST);
	//var_dump($_FILES);
	//kas on pilt ja mis tüüpi
	$check = getimagesize($_FILES["photoinput"]["tmp_name"]);
	if($check !== false){
		//var_dump($check);
		if($check["mime"] == "image/jpeg"){ //== võrdub, = võrdne
			$filetype = "jpg";
		}
		if($check["mime"] == "image/png"){
			$filetype = "png";
		}
		if($check["mime"] == "image/gif"){
			$filetype = "gif";
		}
		
	} else {
		$inputerror = "Valitud fail ei ole pilt!";
	}
	//kas on sobiva failisuurusega
	if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesizelimit){
		$inputerror = "Liiga suur fail!";
	}
	
	//loome uue failinime
	$timestamp = microtime(1) * 10000;
	$filename = $filenameprefix .$timestamp ."." .$filetype;
	
	//ega fail äkki olemas pole
	if(file_exists($photouploaddir_orig .$filename)){
		$inputerror = "Selle nimega fail on juba olemas!";
	}
	
	//kui vigu pole...
	if(empty($inputerror)){	
		//muudame suurust
		//loome pikslikogumi, pildi objekti
		if($filetype == "jpg"){
			$mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["tmp_name"]);
		}
		if($filetype == "png"){
			$mytempimage = imagecreatefrompng($_FILES["photoinput"]["tmp_name"]);
		}
		if($filetype == "gif"){
			$mytempimage = imagecreatefromgif($_FILES["photoinput"]["tmp_name"]);
		}
		//teeme kindlaks originaalsuuruse
		$imagew = imagesx($mytempimage); //image size horizontal(x)
		$imageh = imagesy($mytempimage); //image size vertical(y)
		
		if($imagew > $photomaxwidth or imageh > $photomaxheight){
			if($imagew / $photomaxwidth > $imageh / $photomaxheight){
				$photosizeratio = $imagew / $photomaxwidth;
			} else {
				$photosizeratio = $imageh / $photomaxheight;
			}
			//arvutame uued mõõdud
			$neww = round($imagew / $photosizeratio);
			$newh = round($imageh / $photosizeratio);
			//teeme uue pikslikogumi 
			$mynewtempimage = imagecreatetruecolor($neww, $newh);
			//kirjutame järelejäävad pikslid uuele pildile
			imagecopyresampled($mynewtempimage, $mytempimage, 0, 0, 0, 0, $neww, $newh, $imagew, $imageh);
			imagedestroy($mynewtempimage);
			//salvestame faili
		} else {
			//kui pole suurust vaja muuta
			$notice = saveimage($mytempimage, $filetype);
			
		}
		
		move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename); //mida võtad, kuhu läheb
	}
   }
	 
	function saveimage($mynewtempimage, $filetype){
		$notice = null;
		if($filetype == "jpg"){
				if(imagejpeg($mynewtempimage, $photouploaddir_normal .$filename, 90)){
					$notice = "Vähendatud pildi salvestamine õnnestus!";
				} else {
					$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
				}
			}
			if($filetype == "png"){
				if(imagepng($mynewtempimage, $photouploaddir_normal .$filename, 6)){ //kvaliteedinäit on 1-7
					$notice = "Vähendatud pildi salvestamine õnnestus!";
				} else {
					$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
				}
			}
			if($filetype == "gif"){
				if(imagegif($mynewtempimage, $photouploaddir_normal .$filename)){ //kvaliteedinäitu ei ole
					$notice = "Vähendatud pildi salvestamine õnnestus!";
				} else {
					$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
				}
			}
		imagedestroy($mynewtempimage);
		return $notice;
	}
	
	require("header.php");
?>
<!DOCTYPE html>
<html>
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <h1>Lisa pilt:</h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<input id="photoinput" name="photoinput" type="file" required>
	<br>
	<label for="altinput">Lisa pildi lühikirjeldus(alternatiivtekst)</label>
	<input id="altinput" name="altinput" type="text">
	<br>
	<label>Privaatsustase</label>
	<br>
	<input id="privinput1" name="privinput" type="radio" value="1">
	<label for="privinput1">Privaatne(ainult ise näen)</label>
	<input id="privinput2" name="privinput" type="radio" value="2">
	<label for="privinput2">Klubi liikmetele(sisseloginud kasutajad näevad)</label>
	<input id="privinput3" name="privinput" type="radio" value="3">
	<label for="privinput3">Avalik(kõik näevad)</label>
	
	
	<br>
	<input type="submit" name="photosubmit" value="Lae foto üles">
  </form>
  <p>
  <?php 
	echo $inputerror; 
	echo $notice; 
  ?>
  </p>
  <hr>
  <button><a href="home.php">Tagasi avalehele</button>
  <hr>
  <button><a href="?logout=1">Logi välja</a>!</button>
  <hr>
 </body>
</html>