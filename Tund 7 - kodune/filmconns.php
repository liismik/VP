<?php

	require("session_start.php");
	require("../../../config.php");
	require("fnc_filmrelations.php");
  
	$genrenotice = "";
	$selectedfilm = "";
	$selectedgenre = "";
	$studionotice = "";
	$selectedstudio = "";
	
	 if(isset($_POST["filmstudiorelationsubmit"])){
	  if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$studionotice = " Vali film!";
	}
	if(!empty($_POST["filmstudioinput"])){
		$selectedstudio = intval($_POST["filmstudioinput"]);
	} else {
		$studionotice .= " Vali stuudio!";
	}
	if(!empty($selectedfilm) and !empty($selectedstudio)){
		$studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
	}
  }
  
  if(isset($_POST["filmgenrerelationsubmit"])){
	//$selectedfilm = $_POST["filminput"];
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$genrenotice = " Vali film!";
	}
	if(!empty($_POST["filmgenreinput"])){
		$selectedgenre = intval($_POST["filmgenreinput"]);
	} else {
		$genrenotice .= " Vali žanr!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$genrenotice = storenewgenrerelation($selectedfilm, $selectedgenre);
	}
  }
  
  $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);

  
	require ("header.php");
?>
<!DOCTYPE html>
<html>
 <body>
	<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
	<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
	<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
	<hr>
		<h2>Määrame filmi stuudio/tootja:</h2>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<?php
				echo $filmselecthtml;
				echo $filmstudioselecthtml;
			?>
		<input type="submit" name="filmstudiorelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
		</form>
	 <hr>
	  <h2>Määrame filmile žanri:</h2>
	  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php
			echo $filmselecthtml;
			echo $filmgenreselecthtml;
		?>
		
		<input type="submit" name="filmrelationsubmit" value="Salvesta filmiinfo"><span><?php echo $notice; ?></span>
	  </form>
	 <hr>
	<li><button><a href="home.php">Tagasi avalehele</a></button></li>
	<hr>
	<li><button><a href="?logout=1">Logi välja</a></button></li>
	<hr>
 </body>
</html>