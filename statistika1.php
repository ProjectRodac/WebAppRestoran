<?php
include("configBP.php");
include("header.php");
otvoriBP();
$id=$_GET['prostorija'];

echo "<table cellspacing='0' cellpadding='0'>";
echo "<tr>
		<th>Br. narudžbe</th>
		<th>Vrijeme</th>
		<th>Status</th>
		<th>Konobar</th>
	</tr>";

$sql = "SELECT narudzba_id, vrijeme, status, prostorija_id, konobar_id FROM narudzba WHERE prostorija_id='$id'";
$rs = mysql_query($sql);
$num_results = mysql_num_rows($rs);
$brojac=0;
while(list($narudzba, $vrijeme, $status, $prostorija_id, $konobar) =
mysql_fetch_array($rs)) {
	echo "<tr>
		<td>$narudzba</td>
		<td>$vrijeme</td>";
		if ($status == 0) {
				echo "<td>Neplaćeno</td>";
		}else{
				echo "<td>Plaćeno</td>";
				}
		echo"<td>$konobar</td>";
	echo "</tr>";
$brojac=$brojac+1;
}
$broj_redova=$brojac;
echo "</table>";
echo "<br/>";
echo "U ovoj prostoriji je bilo $broj_redova narudžbi.";
echo "<br/>";
echo "<br/>";
echo '<a class="link" href="stat_prostorije.php">Povratak na prostorije</a>';

include("footer.php");
?>