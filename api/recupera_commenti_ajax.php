<?php
session_start();


include __DIR__ . '/connessione_db.php';

$MAX=0;

if ( isset($_POST['max']))
    $MAX = $_POST['max'];


if(!isset($_SESSION['mondo'])){
    $query_no_injection= "SELECT email, username, testo, id_testo, mondo, stelle FROM commento WHERE id_testo > ?";
    $stmt = mysqli_prepare($db, $query_no_injection);
    mysqli_stmt_bind_param($stmt, "i", $MAX);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}else{
    $query_no_injection = "SELECT email, username, testo, id_testo, mondo, stelle FROM commento WHERE (id_testo > ?) AND (mondo = ?)";
    $stmt = mysqli_prepare($db, $query_no_injection);
    mysqli_stmt_bind_param($stmt, "is", $MAX, $_SESSION['mondo']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

$out = [];
while ($row = mysqli_fetch_assoc($result)) {
    $entry = [
        "email" => $row['email'],
        "username" =>$row['username'],
        "testo" => $row['testo'],
        "id_testo" => $row['id_testo'],
        "stelle" => $row['stelle'],
        "mondo" => $row['mondo']
    ];
    $out[] = $entry;
}
$commenti = json_encode($out);
echo $commenti;

mysqli_close($db);

?>