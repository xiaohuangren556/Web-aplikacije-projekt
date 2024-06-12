<?php
global $dbc;
header('Content-type: text/html; charset=UTF-8');
$server="localhost";
$user="root";
$pass="";
$baza="projekt";

$dbc = mysqli_connect($server, $user, $pass, $baza) or die("<script>console.log('Prije pokušaja uploada');</script>");
mysqli_set_charset($dbc, "utf8");
?>