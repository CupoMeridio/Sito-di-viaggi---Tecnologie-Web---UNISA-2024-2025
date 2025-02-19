<?php
session_start();
include 'connection.php';


//$_SESSION['email']='mattiasanzari03@gmail.com';// da togliere


if(isset($_SESSION['email'])){

$email= $_SESSION['email'];

$query_no_injection= " SELECT * FROM  utente where email=LOWER($1) ";
    //inserimento dei dati nel database
    $result=pg_prepare($db, "select", $query_no_injection); 
    $values=array($email);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "select", $values);

    
    $row = pg_fetch_assoc($result);

    while ( $row != false ) {
        try{
        $nome=$row['nome'];
        $cognome=$row['cognome'];
        $email=$row['email'];
        $username=$row['username'];
        $image_data = pg_unescape_bytea($row['img']);
        $img= base64_encode ($image_data);
        $type=$row['type'];
        $row = pg_fetch_assoc($result);
        }catch(Exception $e){

            $_SESSION['errore']="Errore: ". $e->getMessage();
           // echo "Errore: ". $e->getMessage();
            header("Location: logout.php");
        }
    }
    if(isset($nome))
    $_SESSION['nome']= $nome;
    if(isset($cognome))
    $_SESSION['cognome']= $cognome;
    if(isset($username))
    $_SESSION['username']= $username;
    if(isset($img))
    if ($img != null && $type !=null || $img != '') {
          $_SESSION['type'] = $type;
        $_SESSION['img']= "data:". $type . ";base64," . $img ;// passo direttamente la stringa da mettere nel src
    }else {
        $_SESSION['img']="immagini/default.png";
    }
    // quindi l'utilizzatore dovra scrivere
    /* <img src= <?php echo $_SESSION['img'] ?> />;*/
    if(isset($_SESSION['img']))
    $img=$_SESSION['img'];
}
pg_close($db);

?>