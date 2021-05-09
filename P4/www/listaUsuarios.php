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

            $usuarios = $bd->getAllUsuarios();

            echo $twig->render('/html/listaUsuarios.html.twig',['usuarios' => $usuarios, 'user' => $user]);
        }
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
    }
?>