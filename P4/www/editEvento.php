<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    $idEv = $_GET['idEv'];
    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    if($user['nivel'] >= 3){
        $bd = new BD();

        if(isset($_GET['rmv'])){
            $bd->deleteEvento($idEv);
            header("Location: index.php");
            exit();
        }

        $evento = $bd->getEvento($idEv);
        $evento['fecha'] = $bd->getFechaSinFormato($idEv);
        $pieces = explode(" ",$evento['fecha']);
        $evento['date'] = $pieces[0];
        $evento['time'] = $pieces[1];
        $tags = $bd->getEtiquetas($idEv);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $required = array('titulo', 'href', 'organizador','descripcion');

            $errores;

            foreach($required as $field){
                if(empty($_POST[$field])){
                    $errores[$field] = "This field cannot be empty";
                }
            }

            if(empty($_POST['date']) || empty($_POST['time'])){
                $errores['fecha'] = "This field cannot be empty";
            }

            if($errores){
                echo $twig->render('/html/editEvento.html.twig',['errores' => $errores, 'user' => $user, 'evento' => $evento, 'idEv' => $idEv]);
                exit();
            }

            if($_FILES['imagenPortada']['name'] != ''){
                $file_name = $_FILES['imagenPortada']['name'];
                $file_name = str_replace(' ', '', $file_name);
                $file_tmp = $_FILES['imagenPortada']['tmp_name'];
                $file_ext = strtolower(end(explode('.',$_FILES['imagenPortada']['name'])));

                $extensions = array("jpeg","jpg","png","svg");

                if(!in_array($file_ext,$extensions)){
                    $errores['imagenPortada'] = "Invalid file extension";
                    echo $twig->render('/html/editEvento.html.twig',['errores' => $errores, 'user' => $user, 'evento' => $evento, 'idEv' => $idEv]);
                    exit();
                }

                $path = '/templates/images/'.$file_name;
                $imagen['src'] = $path;
                $imagen['alt'] = $file_name;
                $imagen['href'] = "evento.php?ev=".$idEv;
                $bd->updateImagenPortada($imagen,$idEv);
                move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT'].$path);
            }

            $modified = array();
            $modified['id'] = $idEv;
            $modified['titulo'] = $_POST['titulo'];
            $modified['href'] = $_POST['href'];
            $modified['organizador'] = $_POST['organizador'];
            $modified['fecha'] = $_POST['date'] . " " . $_POST['time'];
            $modified['descripcion'] = $_POST['descripcion'];
            $bd->updateEvento($modified);

            if(!empty($_POST['etiquetas'])){
                $stringTags = $_POST['etiquetas'];
                $tags = explode(",",$stringTags);
                $bd->addEtiquetas($tags,$idEv);
            }
            
            header("Location: evento.php?ev=".$idEv);
            exit();
        }
        echo $twig->render('/html/editEvento.html.twig', ['user' => $user, 'evento' => $evento, 'idEv' => $idEv, 'tags' => $tags]);
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }
?>