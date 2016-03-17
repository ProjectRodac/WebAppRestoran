<?php
include("configBP.php");
include("header.php");
otvoriBP();
$id=$_GET['narudzba_id'];

echo "<table cellspacing='0' cellpadding='0'>";
echo "<tr>
		<th>Proizvod</th>
		<th>Količina</th>
	</tr>";

$sql = "SELECT * FROM stavka_narudzbe WHERE narudzba_id=$id";
$rs = mysql_query($sql);
$num_results = mysql_num_rows($rs);
while(list($id, $proizvod, $kolicina) =
mysql_fetch_array($rs)) {

$sql2 = "SELECT naziv FROM proizvod WHERE proizvod_id=$proizvod";
$rs2 = mysql_query($sql2);
$num_results = mysql_num_rows($rs2);
while(list($naziv) =
mysql_fetch_array($rs2)) {

	echo "<tr>
		<td>$naziv</td>
		<td>$kolicina</td>";
	echo "</tr>";
}
}
echo "</table>";
echo "<br/>";
echo '<a class="link" href="narudzbe.php">Povratak</a>';

include("footer.php");
?>