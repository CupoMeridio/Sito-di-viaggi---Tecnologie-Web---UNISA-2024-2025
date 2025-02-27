<?php


function controlloPatternPassword($pass){
    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/";
    return preg_match($pattern, $pass);
    
}
function controlloPatternEmail($email){
    $pattern = "/^[a-zA-Z0-9_.±]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
    return preg_match($pattern, $email);
    
}
function controlloPatternNome($nome){
    $pattern = "/^[a-zA-Z][a-zA-Z0-9]*$/";
    return preg_match($pattern,$nome);
}
function controlloPatternCognome($cognome){
    $pattern ="/^[a-zA-Z]+$/";
    return preg_match($pattern,$cognome);
}

function controlloEmail($email,$db){    
        $query_no_injection = "SELECT LOWER(email) FROM utente WHERE email = LOWER($1)";
        $result = pg_prepare($db, "select email", $query_no_injection);
        $result=pg_execute($db, "select email", array($email));
        if ($result) {
             $row = pg_fetch_assoc($result);
            if ($row) {
             return true; //L'EMAIL E' PRESENTE
            }else {
            return false; //L'EMAIL NON E' DISPONIBILE
            }
        }else{
            $_SESSION['errore']='Impossibile contattre il database, riprova più tardi.';
            return false;
        }
}

function controlloPassword($email, $pass,$db){
    if(!controlloPatternPassword($pass)){
        return false;
    }
    $query_no_injection = "SELECT password FROM utente WHERE email = LOWER($1)";
    $result = pg_prepare($db, "select_pw", $query_no_injection);
    $result=pg_execute($db, "select_pw", array($email));

    if($result){
        $row=pg_fetch_assoc($result);
        if($row){
            $hash=$row['password'];

            if(password_verify($pass, $hash)){
                return true;//PASSWORD CORRETTA
            }else{
                return false; //PASSWORD ERRATA
            }
        }else {
            return false;//non esiste l'utenete???????
        }
    }else{
        $_SESSION['errore']='Impossibile contattre il database, riprova più tardi.';
        return false;
    }
}

?>