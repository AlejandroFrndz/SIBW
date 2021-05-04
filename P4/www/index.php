<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $db = new BD();

    $imgs = $db->getImagenesPortada();

    session_start();

    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    echo $twig->render('/html/portada.html.twig',['imgs' => $imgs, 'user' => $user]);
?>