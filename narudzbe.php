<?php
	include("configBP.php");
	include("header.php");
	otvoriBP();
	
	// najprije je potrebno provjeriti koliko imamo zapisa u tablici korisnici kako bi mogli izracunati broj stranica i generirati izbornik
	$sql = "SELECT count(*) FROM narudzba";
	$rs = mysql_query($sql);	
	$red = mysql_fetch_array($rs);
	$broj_redaka = $red[0];
	
	$broj_stranica = ceil($broj_redaka / $vel_str_narudzba);
	
	//dohvacamo podatke za aktivnu stranicu
	$sql = "SELECT narudzba_id, vrijeme, prostorija_id, konobar_id, status FROM narudzba order by narudzba_id LIMIT " . $vel_str_narudzba;
	if (isset($_GET['stranica'])){
		$sql = $sql . " OFFSET " . (($_GET['stranica'] - 1) * $vel_str_narudzba);
		$aktivna = $_GET['stranica'];
	} else {
		$aktivna = 1;
	}
	
	$rs = izvrsiBP($sql);
	echo "<table cellspacing='0' cellpadding='0'>";
		echo "<tr>
		<th>Br.nar.</th>
		<th>Vrijeme</th>
		<th>Prostorija</th>
		<th>Konobar</th>
		<th>Status</th>
		<th></th>
		<th></th>
	</tr>";
	while(list($id, $vrijeme, $prostorija, $konobar, $status) = 
		mysql_fetch_array($rs)) {
		
		$sql2 = "SELECT prezime FROM korisnik WHERE korisnik_id=$konobar";
$rs2 = mysql_query($sql2);
$num_results = mysql_num_rows($rs2);
while(list($prezime) =
mysql_fetch_array($rs2)) {

		$sql3 = "SELECT naziv FROM prostorija WHERE prostorija_id=$prostorija";
$rs3 = mysql_query($sql3);
$num_results = mysql_num_rows($rs3);
while(list($naziv) =
mysql_fetch_array($rs3)) {
		
		echo "<tr>
			<td>$id</td>
			<td>$vrijeme</td>
			<td>$naziv</td>
			<td>$prezime</td>
			<td>$status</td>";
			if ($aktivni_korisnik_tip ==0 or 1 or 2) {
				echo "<td><a href='narudzba.php?narudzba_id=$id' class='link'>ISPIS</a></td>";
				if ($status == 0) {
				echo "<td><a href='naplati.php?narudzba_id=$id' class='link'>NAPLATI</a></td>";
				}else{
				echo "<td>Plaćeno</td>";
			}
			}
			echo "</tr>";
	}}}
	echo "</table>";
	if ($aktivni_korisnik_tip == 0 or 1 or 2) {
		echo '</br>';
		echo '<a class="link" href="dodajnarudzbu.php">Nova narudžba</a>';
	}
	zatvoriBP();
	
		//ispis paginacije
	echo '<div id="paginacija">';
	
	//ako je aktivna stranica prva, nije potrebno stavljati link za prethodnu stranicu
	if ($aktivna != 1) { 
		$prethodna = $aktivna - 1;
		echo "<a class='link' href=\"narudzbe.php?stranica=" .$prethodna . "\">&lt;</a>";	
	}
	for ($i = 1; $i <= $broj_stranica; $i++) {
		echo "<a class='link";
		if ($aktivna == $i) {
			echo " aktivna"; //aktivnu stranicu oznacimo na odgovarajuci nacin
		}
		echo "' href=\"narudzbe.php?stranica=" .$i . "\">$i</a>";
	}
	
	//ako je aktivna stranica zadnja, nije potrebno stavljati link za sljedecu stranicu
	if ($aktivna < $broj_stranica) {
		$sljedeca = $aktivna + 1;
		echo "<a class='link' href=\"narudzbe.php?stranica=" .$sljedeca . "\">&gt;</a>";	
	}
	echo '</div>';
	
	include("footer.php");
?>