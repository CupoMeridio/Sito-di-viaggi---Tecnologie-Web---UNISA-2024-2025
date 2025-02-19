<?php
session_start();
include 'connection.php';


//$_SESSION['email']='mattiasanzari03@gmail.com';// da togliere

if(isset($_SESSION['email'])){

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
        $email=$row['email'];
        $username=$row['username'];
        $image_data = pg_unescape_bytea($row['img']);
        $img= base64_encode ($image_data);
        $type=$row['type'];
        $row = pg_fetch_assoc($result);
    }

    $_SESSION['nome']= $nome;
    $_SESSION['cognome']= $cognome;
    $_SESSION['username']= $username;
    if ($img != null && $type !=null || $img != '') {
          $_SESSION['type'] = $type;
        $_SESSION['img']= "data:". $type . ";base64," . $img ;// passo direttamente la stringa da mettere nel src
    }else {
        $_SESSION['img']="immagini/default.png";
    }
    // quindi l'utilizzatore dovra scrivere
    /* <img src= <?php echo $_SESSION['img'] ?> />;*/
    $img=$_SESSION['img'];
}
pg_close($db);

?>
