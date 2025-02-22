<?php 

session_start();

include('../connection.php');



$email= $_SESSION['email'];
$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];

$num_biglietti=$_POST['numbiglietti'];

$data_p = $_POST['datap'];
$data_r = $_POST['datar'];
$destinazione=$_POST['location'];

if(isset($email)){

    // Array di date
    $dateArray = array($data_p,$data_r);

    // Converti l'array in una stringa formattata per PostgreSQL
    $dateArrayString = '{' . implode(',', $dateArray) . '}';

    $query= "INSERT INTO prenotazione (email, nome, cognome, data , destinazione ) VALUES ($1,$2,$3,$4,$5)";

    
    $stmt =  pg_prepare($db,"prenotazione",$query);
    for( $i = 0 ; $i < $num_biglietti; $i=$i+1)  {
    
       
        $values=array($email, $nome, $cognome, $dateArrayString , $destinazione);
        $result= pg_execute($db, "prenotazione", $values);
    }


    $json= json_decode($_POST['dati']);
    $info="\nAltri Membri: \n";

    
//  "nominativo" + i
/*
    for ($i = 0 ; $i < $num_biglietti; $i=$i+1) {
         $info.$json['nominativo'.$i]."\n";
    }
    $info."Commento speciali\n".$json['commento'];*/

    $info= print_r($json, true);
    echo(print_r($json, true));
    

    echo $info;
    $_SESSION['info']=$info;
    //includi creazione pdf
    $_SESSION['datap']=$data_p ;
    $_SESSION['datar']=$data_r ;
    $_SESSION['prezzo']=$_POST['prezzo'];
    $_SESSION['location']=$destinazione;
    $_SESSION['datap']=$data_p ;
    $_SESSION['datar']=$data_r ;
    
    //header("Location: gen_pdf.php");
}


?>