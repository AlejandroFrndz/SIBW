<?php
    include("BD.php");

    $bd = new BD();
    $id = $_GET['id'];
    $idEv = $_GET['idEv'];

    if(isset($_GET['rmv'])){
        $bd->deleteComentario($id);
        header("Location: evento.php?ev=" . $idEv);
        exit();
    }
    else{
        header("Location: evento.php?ev=" . $idEv);
    }
?>