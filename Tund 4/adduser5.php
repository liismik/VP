<?php

   $username = "Liisa Mikola";
   require("../../../config.php");
   require("../../../fnc_common.php");
   require("../../../fnc_user.php");
   
  //require("fnc_user.php");
  //kui klikiti nuppu, siis kontrollime ja salvestame
  
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $firstname= "";
  $lastname = "";
  $gender = "";
  $birthday = null;
  $birthmonth = null;
  $birthyear = null;
  $birthdate = null;
  $email = "";
    
  $firstnameerror = "";
  $lastnameerror = "";
  $gendererror = "";
  $birthdayerror = null;
  $birthmontherror = null;
  $birthyearerror = null;
  $birthdateerror = null;
  $emailerror = "";
  $passworderror = "";
  $confirmpassworderror = "";
    
  $notice = "";
  
  if(isset($_POST["submituserdata"])){
	  
	  if (!empty($_POST["firstnameinput"])){
		$firstname = test_input($_POST["firstnameinput"]);
	  } else {
		  $firstnameerror = "Palun sisesta eesnimi!";
	  }
	  
	  if (!empty($_POST["lastnameinput"])){
		$lastname = test_input($_POST["lastnameinput"]);
	  } else {
		  $lastnameerror = "Palun sisesta perekonnanimi!";
	  }
	  
	  if(isset($_POST["genderinput"])){
		//$gender = intval($_POST["genderinput"]);
		$gender = intval ($_POST["genderinput"]);
	  } else {
		  $gendererror = "Palun märgi sugu!";
	  }
	  
	  if(!empty($_POST["birthdayinput"])){ //kui ei ole tuhi, siis
		  $birthday = intval ($_POST["birthdayinput"]); //maarab, et on kindlasti taisarv 
	  } else {
			 $birthdayerror = "Palun vali sünnipäev!";
	  }
	  
	  if(!empty($_POST["birthmonthinput"])){
		  $birthmonth = intval ($_POST["birthmonthinput"]);
	  } else {
			 $birthmontherror = "Palun vali sünnikuu!";
	  }
	  
	  if(!empty($_POST["birthyearinput"])){
		  $birthyear = intval ($_POST["birthyearinput"]);
	  } else {
			 $birthyearerror = "Palun vali sünniaasta!";
	  }
	  
	  //kontrollime kuupäeva valiidsust
	  if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
		if(checkdate($birthmonth, $birthday, $birthyear)){ //ameerika kuupaevade jarjestus
			$tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday); //seesmiselt on kuupaevad alati ameerikaparaselt
			$birthdate = $tempdate -> format("Y-m-d");
		} else {
			$birthdateerror = "Kuupäev ei ole reaalne!";
		}
	  }
	  
	  if(!empty($_POST["birthmonthinput"])){
		  $birthday = intval ($_POST["birthdayinput"]);
	  } else {
			 $birthdayerror = "Palun vali sünnikuupäev!";
	  }
	  
	  if (!empty($_POST["emailinput"])){
		$email = $_POST["emailinput"];
	  } else {
		  $emailerror = "Palun sisesta e-postiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  
	  if (empty($_POST["confirmpasswordinput"])){
		$confirmpassworderror = "Palun sisestage salasõna kaks korda!";  
	  } else {
		  if($_POST["confirmpasswordinput"] != $_POST["passwordinput"]){
			  $confirmpassworderror = "Sisestatud salasõnad ei olnud ühesugused!";
		  }
	  }
	  
	  if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror) and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($birthdateerror) and empty($emailerror) and empty($passworderror) and empty($confirmpassworderror)){
		$result = signup($firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
			if($result == "Ok"){
				$firstname= "";
				$lastname = "";
				$gender = "";
				$birthday = null;
				$birthmonth = null;
				$birthyear = null;
				$birthdate = null;
				$email = "";
				$notice = "Kasutaja loomine õnnestus!";
			} else {
				$notice = "Tekkis tehniline viga: " .$result;
		} 
		
		//echo $firstname ." " .$lastname ." " .$email ." " .$gender ." " .$birthdate ." " .$_POST["passwordinput"];
		
	  }
	  
  }
  

  $username = "Liisa Mikola";

  require("header.php");
?>
<head>
  <meta charset="utf-8">  
  <title><?php echo $username; ?> programmeerib veebi</title>
  
</head>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <form method="POST">
      <label for="firstnameinput">Eesnimi:</label>
	  <br>
	  <input name="firstnameinput" id="firstnameinput" type="text" value="<?php echo $firstname; ?>"><span style="color:#FF0000;"><?php echo $firstnameerror; ?></span>
	  <br>
	  <br>
      <label for="lastnameinput">Perekonnanimi:</label><br>
	  <input name="lastnameinput" id="lastnameinput" type="text" value="<?php echo $lastname; ?>"><span style="color:#FF0000;"><?php echo $lastnameerror; ?></span>
	  <br>
	  <br>
	  <input type="radio" name="genderinput" id="genderfemaleinput" value="2" <?php if($gender == "2"){		echo " checked";} ?>><label for="genderfemaleinput">Naine</label>
	  <input type="radio" name="genderinput" id="gendermaleinput" value="1" <?php if($gender == "1"){		echo " checked";} ?>><label for="gendermaleinput">Mees</label>
	  <span style="color:#FF0000;"><?php echo "&nbsp; &nbsp; &nbsp;" .$gendererror; ?></span>
	  <br>
	  <br>
	  	  <label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span style="color:#FF0000;"><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
	  <br>
	  <br>
	  <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span style="color:#FF0000;"><?php echo $emailerror; ?></span>
	  <br>
	  <br>
	  <label for="passwordinput">Salasõna (min 8 tähemärki):</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span style="color:#FF0000;"><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <label for="confirmpasswordinput">Korrake salasõna:</label>
	  <br>
	  <input name="confirmpasswordinput" id="confirmpasswordinput" type="password"><span style="color:#FF0000;"><?php echo $confirmpassworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Loo kasutaja"><span style="color:#FF0000;"><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
	</form>
	<br>
	<hr>
	<br>
  <li><button><a href="home.php">Tagasi avalehele</button></li>
</body>
</html>