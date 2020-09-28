<?php

   $username = "Liisa Mikola";
   require("../../../config.php");
   
   $firstname = "";
   $lastname = "";
   $gender = "";
   $email = "";
   
   $inputerror = "";
   $firstnameerror = ""; 
   $lastnameerror = ""; 
   $gendererror = ""; 
   $emailerror = ""; 
   $passworderror = ""; 
   $passwordsecondaryerror = ""; 
   $passwordlengtherror = ""; 
   $passwordsecondarylengtherror = ""; 
   $confirmpassworderror = "";
   
   
   if(isset($_POST["usersubmit"])){
	   if(empty($_POST["firstnameinput"])){
		   $firstnameerror = "Eesnimi on sisestamata!";
	   }
	   if(empty($_POST["lastnameinput"])){
		   $lastnameerror = "Perekonnanimi on sisestamata!";
	   }
	   if(empty($_POST["genderinput"])){
		   $gendererror = "Sugu on valimata!";
	   }
	   if(empty($_POST["emailinput"])){
		   $emailerror = "Emaili aadress on sisestamata!";
	   }
	   if(empty($_POST["passwordinput"])){
		   $passworderror = "Salasõna sisestamata!";
	   }
	   if(empty($_POST["passwordsecondaryinput"])){
		   $passwordsecondaryerror = "Salasõna sisestamata!";
	   }
	   if(strlen($_POST["passwordinput"]) < 8){
		   $passwordlengtherror = "Salasõna on liiga lühike!";
	   }
	   if(strlen($_POST["passwordsecondaryinput"]) < 8){
		   $passwordsecondarylengtherror = "Salasõna on liiga lühike!";
	   }
	   if($_POST["passwordsecondaryinput"] != $_POST["passwordinput"]){
		   $confirmpassworderror = "Sisestatud salasõnad ei olnud ühesugused!";
	   }
	   if(empty($inputerror)){
		   saveuser($_POST["firstnameinput"], $_POST["lastnameinput"], $_POST["genderinput"], $_POST["emailinput"], $_POST["passwordinput"], $_POST["passwordsecondaryinput"]);
	   }
	   if(!empty($_POST["firstnameinput"]) and empty($firstnameerror)) {
           $firstname = $_POST["firstnameinput"];
	   }
	         if(!empty($_POST["lastnameinput"]) and empty($lastnameerror)) {
        $lastname = $_POST["lastnameinput"];
      }
      if(!empty($_POST["genderinput"]) and empty($gendererror)) {
        $gender = $_POST["genderinput"];
      }
      if(!empty($_POST["emailinput"]) and empty($emailerror)) {
        $email = $_POST["emailinput"];
      }
      if(empty($firstnameerror) and empty($lastnameerror) and empty($emailerror) and empty($gendererror) and empty($passworderror) and empty($passwordsecondaryerror)) {
          $notice = "Olete edukalt registreeritud!";
      }
   require("header.php");
   }
   
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">  
  <title><?php echo $username; ?> programmeerib veebi</title>
  
</head>
<html>
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <form method="POST">
  
  	<label for="firstnameinput">Eesnimi</label>
	<input type ="text" name="firstnameinput" id="firstname" value="<?php echo $firstname; ?>">
	<span style="color:#FF0000;"><p><?php echo $firstnameerror; ?></p></span>
	
	<label for="lastnameinput">Perekonnanimi</label>
	<input type="text" name="lastnameinput" id="lastname" value="<?php echo $lastname; ?>">
	<span style="color:#FF0000;"><P><?php echo $lastnameerror; ?></p></span>
	
	<label for="genderinput">Sugu:</label>
	<br>
	<input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
	<br>
	<input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1"){echo " checked";}?>><label for="gendermale">Mees</label><span style="color:#FF0000;"><p><?php echo $gendererror; ?></p></span>
	
	<label for="emailinput">Kasutajatunnus</label>
	<input type="email" name="emailinput" id="email" value="<?php echo $email; ?>">
	<span style="color:#FF0000;"><p><?php echo $emailerror; ?></p></span>
	
	<label for="passwordinput">Salasõna</label>
	<input type="password" name="passwordinput" id="password">
	<span style="color:#FF0000;"><p><?php echo $passworderror; ?></p></span><span style="color:#FF0000;"><p><?php echo $passwordlengtherror; ?></p></span>
	
	<label for="passwordsecondaryinput">Salasõna uuesti</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondary">
	<span style="color:#FF0000";><p><?php echo $passwordsecondaryerror; ?></p></span><span style="color:#FF0000;"><p><?php echo $passwordsecondarylengtherror; ?></p></span><span style="color:#FF0000;"><p><?php echo $confirmpassworderror; ?></p></span>
	
	<input type="submit" name="loginsubmit" value="Loo uus kasutaja">
   </form>
   <br>
  <button><a href="home.php">Tagasi avalehele</button>
 </body>
</html>

