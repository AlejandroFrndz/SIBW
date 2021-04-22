<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $db = new BD();

    $imgs = $db->getImagenesPortada();

    echo $twig->render('/html/portada.html.twig',['imgs' => $imgs]);
?>