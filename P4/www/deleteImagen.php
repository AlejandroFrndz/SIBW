<?php
    include("BD.php");

    $id = $_GET['id'];
    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    if($user['nivel'] >= 3){
        $bd = new BD();
        $bd->deleteImagen($id);
        header("Location: evento.php?ev=".$_GET['idEv']);
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
    }
?>