<?php
session_start();


$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$username= 'postgres';
$password= 'Farinotta01_';

$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());




if(!isset($_POST["action"])){
    exit;
}
$form=$_POST["action"];


if($form=="reg"){
if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
    $nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password_pre_hash=$_POST["password"];
    
}
    
    $bytea=null;
    $type=null;
//di sicuro prendo le variabili da un form    
    if(isset($_FILES["fotoProfilo"]['tmp_name']) && $_FILES["fotoProfilo"]['tmp_name']!=""){
        $img=$_FILES["fotoProfilo"]['tmp_name'];
        $type=$_FILES["fotoProfilo"]['type'];
        $bin=file_get_contents($img);
        $bytea=pg_escape_bytea($img);
    }

    $hash=password_hash($password_pre_hash, PASSWORD_DEFAULT);
    $query_no_injection="INSERT INTO utente (nome, cognome, username, email, password, img,type) VALUES ($1, $2, $3, $4, $5, $6, $7)";
    //inserimento dei dati nel database
    $result=pg_prepare($db, "insert", $query_no_injection); 
    $values=array($nome, $cognome, $username, $email, $hash, $bytea, $type);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "insert", $values);

    if(!$result){
        echo "inserimento fallito";
    }
}else if($form == "login"){
    $email= $_POST["email"];
    $password=$_POST["password"];
    //predno hash dal database
    $query_no_injection="SELECT password FROM utente WHERE email=$1";
    $result=pg_prepare($db, "select password", $query_no_injection);
    $values=array($email);

    //eseguo la query
    $result=pg_execute($db, "select password", $query_no_injection);
    if(!password_verify($password, $hash)){
        echo "La password non "
    }
}
header("Location: index.html");

?>