<?php
   //algatan sessiooni
   session_start();
   require("../../../config.php");
   require("../../../fnc_common.php");
   require("../../../fnc_user.php");

   $fulltimenow = date("d.m.Y H:i:s");
   $datenow = date("d");
   $monthnow = date("m");
   $yearnow = date("Y");
   $timenow = date("H:i:s");
   $hournow = date("H");
   $partofday = "lihtsalt aeg";
   $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
   $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
   //echo $weekdaysnameset;
   //var_dump ($weekdaynameset);
   $weekdaynow = date("N");
   //echo $weekdaynow;
   
   $email = "";
   
   $emailerror = "";
   $passworderror = "";
   
   $notice = "";
   
   if(isset($_POST["submituserdata"])){
	   
	   if(!empty($_POST["emailinput"])){
		   $email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
		   if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			   $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	   } else {
		   $emailerror = "Palun sisesta e-posti aadress!";
	   }
	   }
	   if(empty($_POST["passwordinput"])){
		   $passworderror = "Palun sisesta salasõna!";
	   } else {
		   if(strlen($_POST["passwordinput"]) < 8){
			   $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		   }
	   }
		   
		   if(empty($emailerror) and empty($passworderror)){
			   $result = signin($email, $_POST["passwordinput"]);
				if($result == "Ok"){
					$email = "";
					$notice - "Sisselogimine õnnestus!";
				} else {
					$notice = "Tekkis tehniline viga: " .$result;
				}
		   }
   }
   
   if($hournow >= 0 and $hournow <= 5){
			$partofday = "uneaeg";
   } //enne 6 
   if($hournow >= 6 and $hournow <= 7) {
			$partofday = "ärkamise aeg";
   } //enne 8
   if($hournow >= 8 and $hournow <= 16){
			$partofday = "õppimise aeg";
   }
   if($hournow >= 22 and $hournow <= 23) {
			$partofday = "magama mineku aeg";
   }
   
   //vaatame semestri kulgemist
   $semesterstart = new DateTime("2020-8-31");
   $semesterend = new DateTime("2020-12-13");
   $semesterduration = $semesterstart->diff($semesterend);
   $semesterdurationdays = $semesterduration->format("%r%a");
   $today = new DateTime("now");
   $sincesemesterstart = $semesterstart->diff($today);
   $sincesemesterstartdays = $sincesemesterstart->format("%r%a");
   $semesterstatus = "on täies hoos";
   if($sincesemesterstartdays < 0) {
			$semesterstatus = "pole veel alanud";
   } //negatiivne
   if($sincesemesterstartdays > 104) {
			$semesterstatus = "on lõppenud";
   } //rohkem kui 104
   $percentagetoday = ($sincesemesterstartdays/$semesterdurationdays)*100;
   $percentage = $percentagetoday;
   if($percentagetoday <0) {
			$percentage = "0";
   }
   if($percentagetoday >100) {
			$percentage = "100";
   }
   
   //annan ette lubatud pildivormingute loendi
   $picfiletypes = ["image/jpeg", "image/png"];
   //loeme piltide kataloogi sisu ja näitame pilte
   //$allfiles = scandir("../vp_pics/");
   $allfiles = array_slice(scandir("../vp_pics/"), 2);
   //var_dump($allfiles);
   //$picfiles = array_slice($allfiles, 2);
   $picfiles = [];
   //var_dump($picfiles);
   foreach($allfiles as $thing){
	   $fileinfo = getImagesize("../vp_pics/" .$thing);
	   //var_dump($fileinfo);
	   if(in_array($fileinfo["mime"], $picfiletypes) == true){
		   array_push($picfiles, $thing);
	   }
   }
   
   
      //paneme kõik pildid ekraanile/1 pilt ekraanil
   $piccount = count($picfiles);
   $picnum = mt_rand(0, ($piccount - 1));
   //$i = $i + 1;
   //$i ++;
   //$i += 2;
   $imghtml = "";
   //<img src="../vp_pics/failinimi.png" alt="tekst">
   for($i = 0; $i < $piccount - 3; $i++){
	   $imghtml .= '<img src="../vp_pics/' .$picfiles[$picnum] .'" ';
	   $imghtml .= 'alt="Tallinna Ülikool">';
   }
   
  require("header.php");
  
?>
<!DOCTYPE html>
<html lang="et">
<body>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset[$weekdaynow -1] .", " .$datenow .". " .$monthnameset[$monthnow -1] ." " .$yearnow ." ".$timenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Semestri pikkus on " .$semesterdurationdays ." päeva."; ?></p>
  <p><?php echo "Semestri algusest on möödunud " .$sincesemesterstartdays ." päeva."; ?></p>
  <p><?php echo "Semester " .$semesterstatus ."."; ?></p>
  <p><?php echo "Semestrist on läbitud " .$percentage ." protsenti."; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <h3>Logi sisse:</h3>
  <form method="POST">
	<label for="emailinput">E-mail(kasutajatunnus):</label><br>
	<input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span style="color:#FF0000;"><?php echo $emailerror; ?></span>
	 <br>
	 <label for="passwordinput">Salasõna (min 8 tähemärki):</label>
	 <br>
	 <input name="passwordinput" id="passwordinput" type="password"><span style="color:#FF0000;"><?php echo $passworderror; ?></span>
	 <br>
	 <input name="submituserdata" type="submit" value="Logi sisse"><span style="color:#FF0000;"><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
	 <hr>
	 </form>
	<li><button><a href="addnewuser.php">Lisa uus kasutaja</a></button></li>
  <hr>
</body>
</html>