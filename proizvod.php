<?php
	include("configBP.php");
	
	session_start();
	otvoriBP();
	
	if(isset($_POST['naziv'])) {
		$naziv = $_POST['naziv'];
		$cijena = $_POST['cijena'];
		$slika = $_POST['slika'];
		$id = $_POST['novi'];
		
		if ($id == 0) {
		
			$sql = "INSERT INTO proizvod 
			(naziv, slika, cijena)
			VALUES
			('$naziv', '$slika','$cijena');
			";
		} else {
			$sql = "UPDATE proizvod SET 				 
				cijena='$cijena',
				slika='$slika',
				naziv = '$naziv'
				
				WHERE proizvod_id = '$id'
			";
		}	
		
		izvrsiBP($sql);		
		header("Location: proizvodi.php");
	}
	
	
	include("header.php");
	
	if(isset($_GET['proizvod'])) {
		$id = $_GET['proizvod'];
		
		$sql = "SELECT proizvod_id, naziv, slika, cijena FROM proizvod WHERE proizvod_id='$id'";
		
		otvoriBP();
		$rs = izvrsiBP($sql);
		list($id, $naziv,$slika,$cijena) = 
		mysql_fetch_array($rs);
		
		
	} else {
		$naziv = "";
		$cijena = "";
		$slika = "";		
	}
	?>
		<form method="post" action="proizvod.php">
			<div>
			<input type="hidden" name="novi" value="<?php echo $id?>"/>
			
			<table>
				<tr>
					<td><label for="naziv">Naziv:</label></td>
					<td><input type="text" name="naziv" id="naziv"
						
						value="<?php echo $naziv?>"/></td>
				</tr>
				
				<tr>
					<td><label for="cijena">Cijena:</label></td>
					<td><input type="text" name="cijena" id="cijena" value="<?php echo $cijena?>"/></td>
				</tr>
				
				<tr>
					<td><label for="slika" >Slika:</label></td>
					<td><input type="text" name="slika" id="slika" value="<?php echo $slika?>"/></td>
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