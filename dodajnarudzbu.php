<?php
	include("configBP.php");
	session_start();
	if(!isset($_SESSION['aktivni_korisnik_tip']) || $_SESSION['aktivni_korisnik_tip'] == 3
) {
		header("Location:header.php");
	}
	otvoriBP();
	if(isset($_POST['prostorija'])) {
		
		$prostorija= $_REQUEST['prostorija'];
		$konobar= $_REQUEST['konobar'];
		$status= '0';
		$kolicina = $_POST['kolicina'];
		$proizvod_id = $_POST['proizvodi'];
		$kolicina = array_diff($kolicina, array(''));
		
		$sql = "INSERT INTO narudzba (status, prostorija_id, konobar_id) VALUES
			('$status','$prostorija','$konobar')";
		
		$rs= izvrsiBP($sql);
		
		$novi = mysql_insert_id();
		foreach($kolicina as $x => $y){
				$sql2 = "INSERT INTO stavka_narudzbe (narudzba_id, proizvod_id, kolicina)
							VALUES ( '$novi', '{$proizvod_id[$x]}','{$kolicina[$x]}')";
			$rs= izvrsiBP($sql2);
			}
		header("Location:narudzbe.php");
	}
	include("header.php");
?>
<form method="post" action="dodajnarudzbu.php">
	<table id="Tablica">
		<tr>
			<td>Prostorija</td>
			<td>
				<select name="prostorija">
					<?php
							otvoriBP();
	
							$sql = "SELECT prostorija_id , naziv
								FROM prostorija ";
							$rs = izvrsiBP($sql);
							
							while(list($prostorija_id, $naziv) = 
								mysql_fetch_array($rs)) {
								echo "<option value='$prostorija_id'>$naziv </option>";
							}    	
					?>
				</select>
			</td>
	</tr>
			<tr>
				<td>Konobar</td>
				<td>
					<select name="konobar">
					
						<?php
								otvoriBP();
	
								$sql = "SELECT korisnik_id , ime, prezime 
									FROM korisnik WHERE tip_id <= 2 ";
								$rs = izvrsiBP($sql);
							
								while(list($korisnik_id, $ime, $prezime) = 
									mysql_fetch_array($rs)) {
									echo "<option value='$korisnik_id'>$ime $prezime</option>";
								}
						?>
					</select>
				</td>
			</tr>
<?php
		echo "<tr>
		<th>Proizvod</th>
		<th>Količina</th>
		</tr>";
?>
		<tr id= "proizvod">
			<td>
					<?php
							otvoriBP();
	
							$sql = "SELECT proizvod_id, naziv 
								FROM proizvod";
							$rs = izvrsiBP($sql);
							
							while(list($proizvod_id, $naziv) = 
						mysql_fetch_array($rs)) {
		
						echo "<tr>
							<td id='nzv_DB'>$naziv</td>
							<input type='hidden' name='proizvodi[]' value='$proizvod_id'/>
							<td id='nzv_DB'><input type='text' name='kolicina[]'/>Kom</td>
							</tr>";
						}
						echo "</table>";	
					?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Pošalji"/>
			</td>
		</tr>
	</table>
</form>
<?php
	include("footer.php");
?>