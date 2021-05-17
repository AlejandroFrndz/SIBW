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
            if(empty($_GET['tag'])){
                $activeTag = "";
                $events = $bd->getAllEventos();
            }
            else{
                $activeTag = $_GET['tag'];
                $events = $bd->getEventosByEtiqueta($activeTag);
            }
            $tags = $bd->getAllEtiquetas();

            echo $twig->render('/html/listaEventos.html.twig',['events' => $events, 'user' => $user, 'tags' => $tags, 'activeTag' => $activeTag]);
        }
        else{
            echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
        }
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }

?>