<?php
   $username = "Liisa Mikola";
   $fulltimenow = date("d.m.Y H:i:s");
   $hournow = date("H");
   $partofday = "lihtsalt aeg";
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
   $percentageperday = $semesterdurationdays/100;
   $percentagetoday = $percentageperday*$sincesemesterstartdays;
   $percentage = $percentagetoday;
   if($percentagetoday <0) {
			$percentage = "0";
   }
   if($percentagetoday >100) {
			$percentage = "100";
   }
   
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">  
  <title><?php echo $username; ?> programmeerib veebi</title>
  
</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Semestri pikkus on " .$semesterdurationdays ." päeva."; ?></p>
  <p><?php echo "Semestri algusest on möödunud " .$sincesemesterstartdays ." päeva."; ?></p>
  <p><?php echo "Semester " .$semesterstatus ."."; ?></p>
  <p><?php echo "Semestrist on läbitud " .$percentage ." protsenti."; ?></p>
</body>
</html>