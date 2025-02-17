<?php 

session_start();


$email= $_SESSION['email'];
$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];

$num_biglietti=$_POST['num_biglietti'];
$mondo = $_POST['location'];
$data_p = $_POST['data_p'];
$data_r = $_POST['data_r'];

if(isset($email)){

    // Array di date
    $dateArray = array($data_p,$data_r);

    // Converti l'array in una stringa formattata per PostgreSQL
    $dateArrayString = '{' . implode(',', $dateArray) . '}';

    $query= "INSERT INTO prenotazione (email, id_prenotazione, nome, cognome, data , desinazione ) VALUES ($1,$2,$3,$4,$5,$6)";

    
    for( $i = 0 ; $i < $num_biglietti; $i=$i+1)  {
    
        $stmt =  pg_prepare($db,"prenotazione",$query);
        $values=array($email, $id_prenotazione, $nome, $cognome, $data , $desinazione);
        $result= pg_execute($db, "prenotazione", $values);
    }

    //includi creazione pdf;
}


?>