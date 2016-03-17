<?php
	include("configBP.php");
	if(isset($_GET['logout'] )) {
		session_start();
		unset($_SESSION["aktivni_korisnik"]);
		unset($_SESSION["aktivni_korisnik_tip"]);
		unset($_SESSION["aktivni_korisnik_id"]);
		session_destroy();
		header("Location:index.php");
	}
	$greska = "";
	if (isset($_POST['korisnicko_ime'])) {
		
		$bp = otvoriBP();
		$kor_ime=mysql_real_escape_string($_POST['korisnicko_ime']);
		$lozinka =mysql_real_escape_string($_POST['lozinka']);
		if (!empty($kor_ime) && !empty($lozinka)) {
			
			$sql = "select korisnik_id, tip_id, ime, prezime from korisnik where korisnicko_ime='$kor_ime' and lozinka = '$lozinka'";
			$rs = izvrsiBP($sql);
			if(mysql_num_rows($rs) == 0) {
				$greska = "Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
			} else {	
				session_start();			
				list($id, $tip, $ime, $prezime) = mysql_fetch_array($rs);
				$_SESSION['aktivni_korisnik'] = $kor_ime;
				$_SESSION['aktivni_korisnik_ime'] = $ime . " " . $prezime;
				$_SESSION["aktivni_korisnik_id"] = $id;
				$_SESSION['aktivni_korisnik_tip'] = $tip;
				header("Location:index.php");
			}
			mysql_close();
		} else {
			$greska = "Molim unesite korisničko ime i lozinku";
		}
	}
	include("header.php");

?>

<form method="post" action="login.php">
	<table>
		<tr>
			<td>Korisničko ime</td>
			<td><input type="text" name="korisnicko_ime"/></td>
		</tr>
		<tr>
			<td>Lozinka</td>
			<td><input type="password" name="lozinka"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Prijavi se"/></td>
		</tr>
	</table>
</form>

<?php
	if ($greska != "") {
		echo "<div class='greska'>$greska</div>";
	}
	include("footer.php");
?>

