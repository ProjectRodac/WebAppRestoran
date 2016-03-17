<?php
	include("configBP.php");
	include("header.php");
	otvoriBP();
	
	// najprije je potrebno provjeriti koliko imamo zapisa u tablici korisnici kako bi mogli izracunati broj stranica i generirati izbornik
	$sql = "SELECT count(*) FROM proizvod";
	$rs = mysql_query($sql);	
	$red = mysql_fetch_array($rs);
	$broj_redaka = $red[0];
	
	$broj_stranica = ceil($broj_redaka / $vel_str_proizvod);
	
	//dohvacamo podatke za aktivnu stranicu
	$sql = "SELECT * FROM proizvod order by proizvod_id LIMIT " . $vel_str_proizvod;
	if (isset($_GET['stranica'])){
		$sql = $sql . " OFFSET " . (($_GET['stranica'] - 1) * $vel_str_proizvod);
		$aktivna = $_GET['stranica'];
	} else {
		$aktivna = 1;
	}
	
	
	$rs = izvrsiBP($sql);
	echo "<table cellspacing='0' cellpadding='0'>";
		echo "<tr>
		<th>Naziv</th>
		<th>Cijena</th>
		<th>Slika</th>
		<th></th>
	</tr>";
	while(list($id, $naziv,$cijena,$slika) = 
		mysql_fetch_array($rs)) {
		
		
		echo "<tr>
			<td>$naziv</td>
			<td>$cijena</td>
			<td><img src='$slika' width='90' height='80' border='2pt' alt='slika proizvoda $naziv'/></td>";
			if ($aktivni_korisnik_tip==0) {
				echo "<td><a href='proizvod.php?proizvod=$id' class='link'>UREDI</a></td>";
			}
	
			echo "</tr>";
	}
	echo "</table>";
	if ($aktivni_korisnik_tip==0) {
		echo "<br/>";
		echo '<a class="link" href="proizvod.php">Dodaj proizvod</a>';
	}
	zatvoriBP();
	
		//ispis paginacije
	echo '<div id="paginacija">';
	
	//ako je aktivna stranica prva, nije potrebno stavljati link za prethodnu stranicu
	if ($aktivna != 1) { 
		$prethodna = $aktivna - 1;
		echo "<a class='link' href=\"proizvodi.php?stranica=" .$prethodna . "\">&lt;</a>";	
	}
	for ($i = 1; $i <= $broj_stranica; $i++) {
		echo "<a class='link";
		if ($aktivna == $i) {
			echo " aktivna"; //aktivnu stranicu oznacimo na odgovarajuci nacin
		}
		echo "' href=\"proizvodi.php?stranica=" .$i . "\">$i</a>";
	}
	
	//ako je aktivna stranica zadnja, nije potrebno stavljati link za sljedecu stranicu
	if ($aktivna < $broj_stranica) {
		$sljedeca = $aktivna + 1;
		echo "<a class='link' href=\"proizvodi.php?stranica=" .$sljedeca . "\">&gt;</a>";	
	}
	echo '</div>';
	
	include("footer.php");
?>

