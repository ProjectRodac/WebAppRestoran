<?php
	include("configBP.php");
	include("header.php");
?>

<div id="opis_naslovna">
<h1>Aplikacija Caffe bara Silver</h1>

<p>Aplikacija omogučava dodavanje korisnika, pregled istih, pregled i promjenu prostorija i slično.</p>
<h2>Uloge</h2>
<table cellspacing='0' cellpadding='0'>
	<tr><td class="lijevi">
	Administrator</td><td>Unosi korisnike i definira njihove tipove, administrator može vidjeti sve preglede koje ima prijavljeni korisnik. Administrator unosi proizvode i cijene te kreira područja/prostorije i određuje voditelje svake prostorije između korisnika koji imaju tip voditelj.</td></tr>
	<tr><td>Voditelj</td><td>Uređuje podatke o prostoriji (naziv, slika, opis), može vidjeti statistiku svoje prostorije (broj i iznose narudžbi, broj konobara, koliko je koji konobar preuzeo narudžbi, najčešće konzumirani proizvod). Voditelj ima i ostale poglede kao prijavljeni korisnik/konobar.</td></tr>
	<tr><td>Konobar</td><td>Preuzima narudžbu u nekoj prostoriji (zamislimo da ima smartphone ili tablet za preuzimanje narudžbi pa u skladu s time s treba složiti sučelje) te naplaćuje tu narudžbu (prebacuje status u 'plaćeno'). Konobar može vidjeti i preglede koje vidi anonimni/neprijavljeni korisnik.</td></tr>
	<tr><td>Anonimni/neprijavljeni korisnik </td><td>Može samo vidjeti popis prostorija/područja sa osnovnim informacijama o njima.</td></tr>
</table>
</div>
</br>
<?php
	include("footer.php");
?>

