<?php
session_start();


$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$username= 'postgres';
$password= 'Farinotta01_';

$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());

$nome="";
$cognome="";
$email="";
$username="";
$img="";
$type="";

$_SESSION['email']='mattiasanzari03@gmail.com';// da togliere

$email= $_SESSION['email'];

$query_no_injection= " SELECT * FROM  utente where email= $1 ";
    //inserimento dei dati nel database
    $result=pg_prepare($db, "select", $query_no_injection); 
    $values=array($email);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "select", $values);

    
    $row = pg_fetch_assoc($result);

    while ( $row != false ) {
        $nome=$row['nome'];
        $cognome=$row['cognome'];
        //$email=$row['email'];
        $username=$row['username'];
        $image_data = pg_unescape_bytea($row['img']);
        $img= base64_encode ($image_data);
        $type=$row['type'];
        $row = pg_fetch_assoc($result);
    }

    $_SESSION['nome']= $nome;
    $_SESSION['cognome']= $cognome;
    $_SESSION['username']= $username;
    

pg_close($db);

?>
<html>
    <body>
        <?php   
        echo $nome . $cognome . $username . $type;
        if ($img != null) {
            $_SESSION['type'] = $type;
            echo '<img src="data:' . $type . ';base64,' . $img . '" />';
        }
        ?>
    </body>
</html>