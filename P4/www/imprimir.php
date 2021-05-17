<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $db = new BD();
    $idEv = $_GET['ev'];
    $event = $db->getEvento($idEv);
    if(empty($event)){
        echo $twig->render('/html/error.html.twig',['error' => "404 NOT FOUND"]);
    }
    else{
        $textImgs = $db->getImagenesEvento($idEv);

        echo $twig->render('/html/imprimir.html.twig',['event' => $event, 'textImgs' => $textImgs]);
    }
?>