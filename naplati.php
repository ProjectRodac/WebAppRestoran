<?php
include("configBP.php");
if (isset($_GET['narudzba_id'])){
$id = $_GET['narudzba_id'];
otvoriBP();
$sql = "UPDATE narudzba
SET status=1
WHERE narudzba_id=$id";
izvrsiBP($sql);
zatvoriBP();
header("Location: narudzbe.php");
}
?>