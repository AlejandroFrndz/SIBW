<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

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
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }
?>