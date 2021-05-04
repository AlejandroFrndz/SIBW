<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $db = new BD();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_start();

        $comentario = $_POST['comment'];
        $palabras = $db->getPalabrasProhibidas();
        $censurada;

        foreach($palabras as $pal){
            $censurada = "";
            for($i = 0; $i < strlen($pal['palabra']); $i++){
                $censurada = $censurada . "*";
            }
            $badWords[$pal['palabra']] = $censurada;
        }

        $filtrado = strtr($comentario,$badWords);
        $idEv = $_GET['ev'];
        $uname = $_SESSION['user']['uname'];
        
        $db->guardarComentario($uname,$filtrado,$idEv);
        header("Location: evento.php?ev=" . $idEv);

        exit();
    }

    $idEv = $_GET['ev'];
    $event = $db->getEvento($idEv);
    if(empty($event)){
        echo $twig->render('/html/notFound.html.twig',[]);
    }
    else{
        session_start();

        $user;
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }
        $textImgs = $db->getImagenesEvento($idEv);
        $comments = $db->getComentariosEvento($idEv);
        $consulta = $db->getPalabrasProhibidas();
        $palabras = array();
        foreach($consulta as $palabra){
            $palabras[] = $palabra['palabra'];
        }

        echo $twig->render('/html/evento.html.twig',['event' => $event, 'textImgs' => $textImgs, 'comments' => $comments, 'user' => $user, 'palabras' => $palabras]);
    }
?>