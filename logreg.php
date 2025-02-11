<?php
session_start();


$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$username= 'postgres';
$password= 'Farinotta01_';
echo "Prima della connessione";
$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";

echo "Dopo la conessione";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());


$form=$_POST['action'];
//di sicuro prendo le variabili da un form
if($form=="reg"){
    $nome=$_POST["nome"];
    $cognome=$_POST["cognome"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password_pre_hash=$_POST["password"];
    $img=null;
    $type=null;
    if(isset($_FILES["fotoProfilo"]['tmp_name'])){
        $img=$_FILES["fotoProfilo"]['tmp_name'];
        $type=$_FILES["fotoProfilo"]['type'];
        $bin=pg_get_contents($img);
        $bytea=pg_escape_bytea($img);
    }

    $hash=password_hash($password_pre_hash, PASSWORD_DEFAULT);
    $query_no_injection="INSERT INTO utemte (nome, cognome, username, email, password, img,type) VALUES ($1, $2, $3, $4, $5, $6, $7)";
    //inserimento dei dati nel database
    $result=pg_prepare($db, "insert", $query_no_injection); 
    $values=array($nome, $cognome, $username, $email, $hash, $bytea);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "insert", $values);

    if(!$result){
        echo "inserimento fallito";
    }
}else if($form == "login"){
    
}
?>