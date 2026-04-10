<?php
session_start();
include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */


if(isset($_SESSION['email'])){

$email= $_SESSION['email'];

$query_no_injection = "SELECT * FROM utente WHERE email = LOWER(?)";
$stmt = mysqli_prepare($db, $query_no_injection);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

while ( $row != false ) {
    try{
    $nome=$row['nome'];
    $cognome=$row['cognome'];
    $email=$row['email'];
    $username=$row['username'];
    $img_data = $row['img'];
    $type=$row['type'];
    if ($img_data !== null) {
        $img = base64_encode($img_data);
    } else {
        $img = '';
    }
    $row = mysqli_fetch_assoc($result);
    }catch(Exception $e){

        $_SESSION['errore']="Errore: ". $e->getMessage();
        header("Location: logout_utente.php");
    }
}
if(isset($nome))
$_SESSION['nome']= $nome;
if(isset($cognome))
$_SESSION['cognome']= $cognome;
if(isset($username))
$_SESSION['username']= $username;
if(isset($img))
if ($img != null && $type !=null || $img != '' ) {
      $_SESSION['type'] = $type;
    $_SESSION['img']= "data:". $type . ";base64," . $img ;
}else {
    $_SESSION['img']="img/common/default.png";
}
if(isset($_SESSION['img']))
    $img=$_SESSION['img'];
}
mysqli_close($db);
?>