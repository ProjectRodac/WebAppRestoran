<?php
include("configBP.php");
include("header.php");
otvoriBP();
$id=$_GET['prostorija'];

echo "<table cellspacing='0' cellpadding='0'>";
		echo "<tr>
		<th>Proizvod</th>
		<th>Naručene količine</th>
		<th></th>
	</tr>";

$sql = "SELECT p.naziv, SUM(s.kolicina) FROM proizvod p  
INNER JOIN stavka_narudzbe s ON s.proizvod_id=p.proizvod_id
INNER JOIN narudzba n ON s.narudzba_id=n.narudzba_id
WHERE n.prostorija_id=$id
GROUP BY p.naziv
ORDER BY 2 DESC";
$rs = mysql_query($sql);
$num_results = mysql_num_rows($rs);
$brojac=0;
while(list($proizvod, $kolicina) =
mysql_fetch_array($rs)) {
		
		echo "<tr>
		<td>$proizvod</td>
		<td>$kolicina</td>";
		echo "</tr>";
$brojac=$brojac+1;
	}
	$broj_redova=$brojac;
	echo "</table>";
	echo "<br/>";
	echo "U ovoj prostoriji je naručeno $broj_redova vrsti proizvoda.";
	echo "<br/>";
	echo "Proizvodi su poredani prema naručenim količinama, od najveće prema najmanjoj.";
	echo "<br/>";
	echo "<br/>";
	echo '<a class="link" href="stat_pice.php">Povratak na prostorije</a>';
include("footer.php");
?>