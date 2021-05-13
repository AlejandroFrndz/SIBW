<?php
    include("BD.php");

    $idEv = $_GET['idEv'];
    $tag = $_GET['tag'];
    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    if($user['nivel'] >= 3){
        $bd = new BD();
        $bd->deleteEtiqueta($tag,$idEv);
        header("Location: editEvento.php?idEv=".$_GET['idEv']);
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
    }
?>