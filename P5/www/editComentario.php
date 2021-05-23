<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $bd = new BD();
    $id = $_GET['id'];
    $idEv = $_GET['idEv'];
    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    if($user['nivel'] >= 2){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cuerpo = $_POST['cuerpo'];
            if(strpos($cuerpo, "Edited by a moderator --") == false){
                $cuerpo = "Edited by a moderator -- " . $cuerpo;
            }
            
            $bd->updateComentario($id,$cuerpo);
            $comment = $bd->getComentario($id);

            header("Location: evento.php?ev=" . $idEv);
            exit();
        }

        if(isset($_GET['rmv'])){
            $bd->deleteComentario($id);
            header("Location: evento.php?ev=" . $idEv);
            exit();
        }
        else{
            $comment = $bd->getComentario($id);

            echo $twig->render('/html/editComentario.html.twig', ['comment' => $comment, 'user' => $user, 'idEv' => $idEv]);
        }
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }
?>