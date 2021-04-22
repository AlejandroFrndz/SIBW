<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $db = new BD();
    $idEv = $_GET['ev'];
    $event = $db->getEvento($idEv);
    if(empty($event)){
        echo $twig->render('/html/notFound.html.twig',[]);
    }
    else{
        $textImgs = $db->getImagenesEvento($idEv);
        $comments = $db->getComentariosEvento($idEv);
        echo $twig->render('/html/evento.html.twig',['event' => $event, 'textImgs' => $textImgs, 'comments' => $comments]);
    }
?>