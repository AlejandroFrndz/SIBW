<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        
        if($user['nivel'] >= 4){
            $bd = new BD();
            $uname = $_GET['uname'];
            $lvl = $_GET['lvl'];
            $bd->updateRol($uname,$lvl);

            header("Location: listaUsuarios.php");
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
