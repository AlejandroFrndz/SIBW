<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if($user['nivel'] >= 3){
            $bd = new BD();
            $events = $bd->getAllEventos();

            echo $twig->render('/html/listaEventos.html.twig',['events' => $events, 'user' => $user]);
        }
        else{
            echo "<h1>403 FORBIDDEN</h1>";
        }
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
    }

?>