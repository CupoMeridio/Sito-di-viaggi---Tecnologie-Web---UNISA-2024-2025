<?php
$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
//$host='localhost';
$port = '5432';
$db= 'tw_prova';
//$db='tw_gruppo11';
//$user='www';
//$pass='tw2024';
$user= 'postgres';
$pass= 'Farinotta01_';

$connection_string = "host=$host port=$port dbname=$db user=$user password=$pass";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());

?>