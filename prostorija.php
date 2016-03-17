<?php
	include("configBP.php");
	session_start();
	otvoriBP();
	
	if(isset($_POST['naziv'])) {
		$naziv = $_POST['naziv'];
		$slika = $_POST['slika'];
		$opis = $_POST['opis'];
		$korisnik = $_POST['korisnik'];
		
		$id = $_POST['novi'];
		
		if ($id == 0) {
		
			$sql = "INSERT INTO prostorija
			(naziv, slika, opis, korisnik_id)
			VALUES
			('$naziv', '$slika', '$opis', '$korisnik');
			";
		} else {
			$sql = "UPDATE prostorija SET 				 
				naziv = '$naziv',
				slika= '$slika',
				opis = '$opis',
				korisnik_id = '$korisnik'
				WHERE prostorija_id = '$id'
			";
		}	
		izvrsiBP($sql);		
		header("Location: prostorije.php");
	}
	
	include("header.php");
	
	if(isset($_GET['prostorija'])) {
		$id = $_GET['prostorija'];
		
		$sql = "SELECT prostorija_id, naziv, slika, opis, korisnik_id FROM prostorija WHERE prostorija_id='$id'";
		
		otvoriBP();
		$rs = izvrsiBP($sql);
		list($id, $naziv, $slika, $opis, $korisnik) = 
		mysql_fetch_array($rs);
		
		
	} else {
		$naziv = "";
		$slika = "";
		$opis = "";
		$korisnik = "";		
	}
	?>
		<form method="post" action="prostorija.php">
			<div>
			<input type="hidden" name="novi" value="<?php echo $id?>"/>
			
			<table>
				<tr>
					<td><label for="naslov">Naziv:</label></td>
					<td><input type="text" name="naziv" id="naziv" value="<?php echo $naziv?>"/></td>
				</tr>
				
				<tr>
					<td><label for="slika" >Slika:</label></td>
					<td><input type="text" name="slika" id="slika" value="<?php echo $slika?>"/></td>
				</tr>
				
				<tr>
					<td><label for="opis">Opis:</label></td>
					<td><input type="text" name="opis" id="opis" value="<?php echo $opis?>"/></td>
				</tr>
				
				<tr>
				<td>Voditelj:</td>
				<td>
					<select name="korisnik">
					
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
				
				<tr>
					<td colspan="2"><input type="submit" value="Pohrani promjene"/></td>
				</tr>
			</table>
			</div>
		</form>		
<?php
	zatvoriBP();
	include("footer.php");
?>