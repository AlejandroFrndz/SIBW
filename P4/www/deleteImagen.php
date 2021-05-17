<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

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
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }
?>