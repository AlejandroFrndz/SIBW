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
            $idEv = $_GET['idEv'];
            if(isset($_GET['hide'])){
                $vis = 0;
            }
            else{
                $vis = 1;
            }
            $bd->publicarEvento($idEv,$vis);

            header("Location: evento.php?ev=" . $idEv);
            exit();
        }
        else{
            echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
            exit();
        }
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
        exit();
    }
?>