<?php
$BP_server = 'localhost';
$BP_bazaPodataka = 'IWA_2012_VZ_PROJEKT';
$BP_korisnik = 'iwa_2012';
$BP_lozinka = 'FOI';


$dbc = null;
$db = null;
$vel_str = 5; //broj prikazanih elemenata na stranici s korisnicima
$vel_str_proizvod = 6; // broj prikazanih elemenata na stranici sa proizvodima
$vel_str_prostorija = 10; // broj prikazanih elemenata na stranici sa prostorijama
$vel_str_narudzba = 20; // broj prikazanih elemenata na stranici sa narudžbama
$vel_str_nar = 20; // broj prikazanih elemenata na jednoj narudžbi

function otvoriBP() {
	global $dbc;
	global $db;
	global $BP_server;
	global $BP_bazaPodataka;
	global $BP_korisnik;
	global $BP_lozinka;

	$dbc = mysql_connect($BP_server, $BP_korisnik, $BP_lozinka);
	if(! $dbc) {
		pogreska('Pogreška! ' . mysql_error());
		exit();
	}

	$db = mysql_select_db($BP_bazaPodataka, $dbc);
	if(! $db) {
		pogreska('Pogreška! ' . mysql_error());
		exit();
	}
	mysql_query("set names 'utf8'",$dbc);
}

function izvrsiBP($sql) {
	$rs = mysql_query($sql);
	if(! $rs) {
		pogreska('Pogreška! ' . mysql_error());
		exit();
	}
	return $rs;
}	
function zatvoriBP(){
	global $dbc;
	mysql_close($dbc);
}
function pogreska ($error) {
	echo $error;
}
?>