<?php
require 'connection.php';

require 'controlloGenerale.php';
    //echo $_POST['email'];

 if (isset($_POST['email'])) {
    $email = $_POST['email'];

if(controlloEmail($email, $db)){
    echo "esiste";
}else{
    echo "disponibile";
}
 }
pg_close($db);
?>