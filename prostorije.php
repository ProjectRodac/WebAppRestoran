<?php
	include("configBP.php");
	include("header.php");
	otvoriBP();
	
	// najprije je potrebno provjeriti koliko imamo zapisa u tablici korisnici kako bi mogli izracunati broj stranica i generirati izbornik
	$sql = "SELECT count(*) FROM prostorija";
	$rs = mysql_query($sql);	
	$red = mysql_fetch_array($rs);
	$broj_redaka = $red[0];
	
	$broj_stranica = ceil($broj_redaka / $vel_str_prostorija);
	
	//dohvacamo podatke za aktivnu stranicu
	$sql = "SELECT * FROM prostorija order by prostorija_id LIMIT " . $vel_str_prostorija;
	if (isset($_GET['stranica'])){
		$sql = $sql . " OFFSET " . (($_GET['stranica'] - 1) * $vel_str_prostorija);
		$aktivna = $_GET['stranica'];
	} else {
		$aktivna = 1;
	}
	
	$rs = izvrsiBP($sql);
	echo "<table cellspacing='0' cellpadding='0'>";
		echo "<tr>
		<th>Naziv</th>
		<th>Slika</th>
		<th>Opis</th>
		<th>Voditelj</th>
		<th></th>
	</tr>";
	while(list($id, $naziv, $slika, $opis, $korisnik) = 
		mysql_fetch_array($rs)) {
		
		
		echo "<tr>
			<td>$naziv</td>
			<td><img src='$slika' width='150' height='100' border='2pt' alt='slika prostorije $naziv'/></td>
			<td>$opis</td>
			<td>$korisnik</td>";
			if ($aktivni_korisnik_tip==0) {
				echo "<td><a href='prostorija.php?prostorija=$id' class='link'>UREDI</a></td>";
			}
			if ($aktivni_korisnik_tip==1) {
				echo "<td><a href='prostorija.php?prostorija=$id' class='link'>UREDI</a></td>";
			}
			echo "</tr>";
	}
			echo "</table>";
			if ($aktivni_korisnik_tip==0) {
			echo "<br/>";
			echo '<a class="link" href="prostorija.php">Dodaj prostoriju</a>';
	}
			echo "</tr>";
	
	zatvoriBP();
	
		//ispis paginacije
	echo '<div id="paginacija">';
	
	//ako je aktivna stranica prva, nije potrebno stavljati link za prethodnu stranicu
	if ($aktivna != 1) { 
		$prethodna = $aktivna - 1;
		echo "<a class='link' href=\"prostorije.php?stranica=" .$prethodna . "\">&lt;</a>";	
	}
	for ($i = 1; $i <= $broj_stranica; $i++) {
		echo "<a class='link";
		if ($aktivna == $i) {
			echo " aktivna"; //aktivnu stranicu oznacimo na odgovarajuci nacin
		}
		echo "' href=\"prostorije.php?stranica=" .$i . "\">$i</a>";
	}
	
	//ako je aktivna stranica zadnja, nije potrebno stavljati link za sljedecu stranicu
	if ($aktivna < $broj_stranica) {
		$sljedeca = $aktivna + 1;
		echo "<a class='link' href=\"prostorije.php?stranica=" .$sljedeca . "\">&gt;</a>";	
	}
	echo '</div>';
	
	include("footer.php");
?>

