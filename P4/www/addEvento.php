<?php
    session_start();
    $user;

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if($user['nivel'] >= 3){
            require_once "/usr/local/lib/php/vendor/autoload.php";

            $loader = new \Twig\Loader\FilesystemLoader('templates');
            $twig = new \Twig\Environment($loader);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $required = array('titulo', 'href', 'organizador','descripcion');

                $errores;

                foreach($required as $field){
                    if(empty($_POST[$field])){
                        $errores[$field] = "This field cannot be empty";
                    }
                }

                if(!isset($_FILES['imagenPortada'])){
                    $errores['imagenPortada'] = "This field cannot be empty";
                }

                if(empty($_POST['date']) || empty($_POST['time'])){
                    $errores['fecha'] = "This field cannot be empty";
                }

                if($errores){
                    echo $twig->render('/html/addEvento.html.twig',['errores' => $errores]);
                    exit();
                }

                $file_name = $_FILES['imagenPortada']['name'];
                $file_name = str_replace(' ', '', $file_name);
                $file_tmp = $_FILES['imagenPortada']['tmp_name'];
                $file_ext = strtolower(end(explode('.',$_FILES['imagenPortada']['name'])));

                $extensions = array("jpeg","jpg","png","svg");

                if(!in_array($file_ext,$extensions)){
                    $errores['imagenPortada'] = "Invalid file extension";
                    echo $twig->render('/html/addEvento.html.twig',['errores' => $errores]);
                    exit();
                }
                
                $path = '/templates/images/' . $file_name;
                move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT']. $path);

                include("BD.php");
                $bd = new BD();
                $imgId = $bd->addImagen($path,$file_name,"","");
                
                $evento = array();
                $evento['titulo'] = $_POST['titulo'];
                $evento['href'] = $_POST['href'];
                $evento['organizador'] = $_POST['organizador'];
                $evento['fecha'] = $_POST['date'] . " " . $_POST['time'];
                $evento['descripcion'] = $_POST['descripcion'];
                $evento['imagenPortada'] = $imgId['max'];

                $idEvAr = $bd->addEvento($evento);
                $idEv = $idEvAr['max'];
                $href = "/evento.php?ev=".$idEv;
                
                $bd->updateHrefImagen($href, $imgId['max']);

                if(isset($_FILES['imagen'])){
                    $file_name = $_FILES['imagen']['name'];
                    $file_name = str_replace(' ', '', $file_name);
                    $file_tmp = $_FILES['imagen']['tmp_name'];
                    $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));

                    if(in_array($file_ext,$extensions)){
                        $path = '/templates/images/' . $file_name;
                        move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT']. $path);
                        $imgId = $bd->addImagen($path,$file_name,"","");
                        $bd->addImagenAEvento($imgId['max'],$idEv);
                    }
                }

                if(!empty($_POST['etiquetas'])){
                    $stringTags = $_POST['etiquetas'];
                    $tags = explode(",",$stringTags);

                    $bd->addEtiquetas($tags,$idEv);
                }

                header("Location: index.php");
                
                
                exit();
            }

            echo $twig->render('/html/addEvento.html.twig',[]);
            exit();
        }
    }

    echo "<h1>403 FORBIDDEN</h1>";
?>