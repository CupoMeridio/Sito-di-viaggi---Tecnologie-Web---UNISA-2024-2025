<?php
require 'connection.php';
require 'controlloGenerale.php';

if(!isset($_POST["action"])){
    exit;
}

$form=$_POST["action"];
$_SESSION['errore']="";
if($form=="reg"){
    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
        $nome=$_POST["nome"];
        $cognome=$_POST["cognome"];
        $email=$_POST["email"];
        $username=$_POST["username"];
        $password_pre_hash=$_POST["password"];



        
        $bytea="";
        $type="";
    //di sicuro prendo le variabili da un form    
        if(($_FILES["fotoProfilo"]['tmp_name'])!=null|| $_FILES["fotoProfilo"]['tmp_name']!=""){
            $img=$_FILES["fotoProfilo"]['tmp_name'];
            $type=$_FILES["fotoProfilo"]['type'];
            $bin=file_get_contents($img);
            $bytea=pg_escape_bytea($bin);
        }
        if(controlloPatternEmail($email) && controlloPatternPassword($password) && controlloPtternNome($nome) && controlloPatternCognome($cognome)){
                $hash=password_hash($password_pre_hash, PASSWORD_DEFAULT);
                $query_no_injection="INSERT INTO utente (nome, cognome, username, email, password, img,type) VALUES ($1, $2, $3, $4, $5, $6, $7)";
                //inserimento dei dati nel database
                $result=pg_prepare($db, "insert", $query_no_injection); 
                $values=array($nome, $cognome, $username, $email, $hash, $bytea, $type);

                //adesso eseguo la query con i valori escapati
                $result=pg_execute($db, "insert", $values);
            

                if(!$result){
                    $_SESSION['errore']="inserimento fallito";
                    header("Location: registrazione.php");
                    exit();
                }else{
                    header("Location: index.php");
                    exit();
                }

            }
        
}
}else if($form == "login"){
    $email= $_POST["email"];
    $password=$_POST["password"];
    if(controlloEmail($email, $db)){
        if(controlloPassword($email,$password, $db)){
        $_SESSION['email']=$email;
         header("Location: index.php"); 
        }else{//CONTROLLO PASSWORD FALLITO
            $_SESSION['errore']= $_SESSION['errore'].". Password non esistente. ";
            //header("Location: index.php"); 
            header("Location: registrazione.php?login"); 
            exit();            
        }

    }else{//CONTROLLO EMAIL FALLITO
        $_SESSION['errore']= $_SESSION['errore'].". E-mail non esistente. ";
        //header("Location: index.html"); 
        header("Location: registrazione.php?login"); 
        exit();        
    }
    
}
pg_close($db);
?>