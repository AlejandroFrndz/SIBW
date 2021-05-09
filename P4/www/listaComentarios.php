<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if($user['nivel'] >= 2){
            $bd = new BD();
            $comments = $bd->getAllComentarios();

            echo $twig->render('/html/listaComentarios.html.twig',['comments' => $comments, 'user' => $user]);
        }
        else{
            echo "<h1>403 FORBIDDEN</h1>";
        }
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
    }

?>