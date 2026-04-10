<?php
require __DIR__ . '/connessione_db.php';
/** @var mysqli $db */


require __DIR__ . '/validazione_generale.php';
    //echo $_POST['email'];

 if (isset($_POST['email'])) {
    $email = $_POST['email'];

if(controlloEmail($email, $db)){
    echo "esiste";
}else{
    echo "disponibile";
}
 }
mysqli_close($db);
?>