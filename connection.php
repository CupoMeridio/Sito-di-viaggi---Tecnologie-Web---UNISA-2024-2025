<?php
/* Database Online 
$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$user= 'postgres';
$pass= 'Farinotta01_'; */

/*  Database Offline */
$host='postgres';
$port = '5432';
$db='gruppo11';
$user='www';
$pass='tw2024';

//echo  "Prima";

$connection_string = "host=$host port=$port dbname=$db user=$user password=$pass";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());

//echo  "Dopo";

?>