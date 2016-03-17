<?php
	include("configBP.php");
	include("header.php");
	otvoriBP();
	
	// najprije je potrebno provjeriti koliko imamo zapisa u tablici korisnici kako bi mogli izracunati broj stranica i generirati izbornik
	$sql = "SELECT count(*) FROM korisnik";
	$rs = mysql_query($sql);	
	$red = mysql_fetch_array($rs);
	$broj_redaka = $red[0];
	
	$broj_stranica = ceil($broj_redaka / $vel_str);
	
	
	//dohvacamo podatke za aktivnu stranicu
	$sql = "SELECT * FROM korisnik order by korisnik_id LIMIT " . $vel_str;
	if (isset($_GET['stranica'])){
		$sql = $sql . " OFFSET " . (($_GET['stranica'] - 1) * $vel_str);
		$aktivna = $_GET['stranica'];
	} else {
		$aktivna = 1;
	}

	$rs = mysql_query($sql);
	
	if ($aktivni_korisnik_tip==0) {
	echo "<table cellspacing='0' cellpadding='0'>";
	echo "<tr>
		<th>Korisničko ime</th>
		<th>Ime</th>";
	
	
	echo "<th>Prezime</th>
		<th>E-mail</th>
		<th>Lozinka</th>
		<th>Slika</th>
		<th></th>
	</tr>";
	
	while(list($id, $tip, $kor_ime,$lozinka,$ime,$prezime,$email, $slika) = 
		mysql_fetch_array($rs)) {
		
		echo "<tr>
			<td>$kor_ime</td>
			<td>$ime</td>";
		
		echo "<td>" .  (empty($prezime) ? "&nbsp;" : "$prezime") . "</td>
			<td>" .  (empty($email) ? "&nbsp;" : "$email") . "</td>
			<td>$lozinka</td>
			<td><img src='$slika' width='60' height='70' border='2pt' alt='slika korisnika $ime $prezime'/></td>";
		if ($aktivni_korisnik_tip==0) {
			echo "<td><a class='link' href='korisnik.php?korisnik=$id'>UREDI</a></td>";
		}
		echo	"</tr>";
	}

	echo "</table>";
	if ($aktivni_korisnik_tip == 0) {
		
		echo "<br/>";
		echo "<br/>";
		echo '<a class="link" href="korisnik.php">Dodaj novog korisnika</a>';
}
	zatvoriBP();
	
	
	//ispis paginacije
	echo '<div id="paginacija">';
	
	//ako je aktivna stranica prva, nije potrebno stavljati link za prethodnu stranicu
	if ($aktivna != 1) { 
		$prethodna = $aktivna - 1;
		echo "<a class='link' href=\"korisnici.php?stranica=" .$prethodna . "\">&lt;</a>";	
	}
	for ($i = 1; $i <= $broj_stranica; $i++) {
		echo "<a class='link";
		if ($aktivna == $i) {
			echo " aktivna"; //aktivnu stranicu oznacimo na odgovarajuci nacin
		}
		echo "' href=\"korisnici.php?stranica=" .$i . "\">$i</a>";
	}
	
	//ako je aktivna stranica zadnja, nije potrebno stavljati link za sljedecu stranicu
	if ($aktivna < $broj_stranica) {
		$sljedeca = $aktivna + 1;
		echo "<a class='link' href=\"korisnici.php?stranica=" .$sljedeca . "\">&gt;</a>";	
	}
	echo '</div>';
	}
	if(isset($_SESSION["aktivni_korisnik_id"])) {
		echo "<br/>";
		echo '<a class="link" href="korisnik.php?korisnik=' . $_SESSION["aktivni_korisnik_id"] . '">Uredi moje podatke</a>';
	}
	include("footer.php");
?>

