<?php
	
	if (session_id() == "")
		session_start();

	$aktivni_korisnik=0;
	$aktivni_korisnik_tip=-1;
	if(isset($_SESSION['aktivni_korisnik'])) {
		$aktivni_korisnik=$_SESSION['aktivni_korisnik'];
		$aktivni_korisnik_ime=$_SESSION['aktivni_korisnik_ime'];
		$aktivni_korisnik_tip=$_SESSION['aktivni_korisnik_tip'];
		$aktivni_korisnik_id = $_SESSION["aktivni_korisnik_id"];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="shortcut icon" href="images/ugostiteljstvo.png">
		<link rel="stylesheet" type="text/css" href="dizajn.css"/>
		<title>Caffe bar Silver</title>
	</head>
	<body>
	
	<script type="text/javascript">
	 function setDate(text) {
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		
		text.value=day + "." + month + "." + year + ".";
    }
	</script>

	<div class ="content">		
		<div class="header">
		
		<span>
			<b>Caffe bar Silver</b>
			<br/>
			<?php
				if ($aktivni_korisnik===0) {
					echo "Neprijavljeni korisnik <br/>";
					echo "<a class='link' href='login.php'>Prijava</a>";
				} else {
					echo "Dobrodošli, $aktivni_korisnik_ime <br/>";
					echo "<br/>";
					echo "<a class='link' href='login.php?logout=1'>Odjava</a>";
				}
			?>
		</span>
		</div>
	<div class="menu">
	<a href="index.php">NASLOVNA</a>
	<?php
		echo '<a href="prostorije.php">PROSTORIJE</a>';
		if ($aktivni_korisnik_tip >=2 ) {
			echo '<a href="korisnici.php">KORISNICI</a>';
			echo '<a href="proizvodi.php">PROIZVODI</a>';
			echo '<a href="narudzbe.php">NARUDŽBE</a>';
		}
		else if ($aktivni_korisnik_tip >=1 ) {
			echo '<a href="korisnici.php">KORISNICI</a>';
			echo '<a href="proizvodi.php">PROIZVODI</a>';
			echo '<a href="narudzbe.php">NARUDŽBE</a>';
			echo '<a href="statistika_meni.php">STATISTIKA</a>';
		}else if ($aktivni_korisnik_tip >=0) {
			echo '<a href="korisnici.php">KORISNICI</a>';
			echo '<a href="narudzbe.php">NARUDŽBE</a>';
			echo '<a href="proizvodi.php">PROIZVODI</a>';
			echo '<a href="statistika_meni.php">STATISTIKA</a>';
			}

	?>
	</div>
