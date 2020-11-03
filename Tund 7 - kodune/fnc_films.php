<?php
	$database = "if20_liisa_mi_1";
	
   //loen lehele kõik olemasolevad mõtted
   function readfilms(){
	   $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	   $stmt = $conn->prepare("SELECT * FROM film");
	   //$stmt = $conn->prepare("SELECT peakiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	   echo $conn->error;
	   //seome tulemuse muutujaga
	   $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	   $stmt->execute();

	   
   $filmhtml = "\t <ol> \n ";
   while($stmt->fetch()){
	   $filmhtml .= "\t \t <li>" .$titlefromdb ." \n";
	   $filmhtml .= "\t \t \t <ul> \n";
	   $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ." minutit</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Zanr: " .$genrefromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t </ul> \n";
	   $filmhtml .= "\t \t </li> \n";
   }
   $filmhtml .= "\t </ol> \n";

	$stmt->close();
	$conn->close();
	return $filmhtml;
	} //readfilms loppeb
	
	// function savemovie($titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput){
		// $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		// $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
		// echo $conn->error;
		// $stmt->bind_param("siisss", $titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput);
		// $stmt->execute();
		// $stmt->close();
		 // $conn->close();
	// }//savefilm loppeb
	
	function saveperson($personfirstnameinput, $personlastnameinput, $personbirthdateinput){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO person (first_name, last_name, birth_date) VALUES(?,?,?)");
		echo $conn->error;
		$stmt->bind_param("sss", $personfirstnameinput, $personlastnameinput, $personbirthdateinput);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}
	
function savefilm($title, $productionyear, $duration, $filmdescription) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_id FROM movie WHERE title = ? AND production_year = ? AND duration = ?");
	echo $conn->error; 
	$stmt->bind_param("sii", $title, $productionyear, $duration);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()) {
		$notice = "Selline film on juba olemas!";
	}
	else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie (title, production_year, duration, description) VALUES(?, ?, ?, ?)");
		echo $conn->error; 
		$stmt->bind_param("siis", $title, $productionyear, $duration, $filmdescription);
		if($stmt->execute()) {
			$notice = "OK";
		}
		else {
			$notice = "Filmi salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}		
	$stmt->close();
	$conn->close();
	return $notice;
}
	
	function saveposition($positionnameinput, $positiondescriptioninput){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO position (position_name, description) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ss", $positionnameinput, $positiondescriptioninput);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}
	
	function savegenre($genrenameinput, $genredescriptioninput){
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO genre (genre_name, description) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ss", $genrenameinput, $genredescriptioninput);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}