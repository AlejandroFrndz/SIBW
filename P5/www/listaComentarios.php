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

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['autor'])){
                    $autor = $_POST['autor'];

                    $comments = $bd->getComentariosByAutor($autor);
                }
            }
            else{
                $autor = "";
                $comments = $bd->getAllComentarios();
            }

            echo $twig->render('/html/listaComentarios.html.twig',['comments' => $comments, 'user' => $user, 'filtro' => $autor]);
        }
        else{
            echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
        }
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }

?>