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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_FILES['imagen']["name"] != ''){
                $file_name = $_FILES['imagen']['name'];
                $file_name = str_replace(' ', '', $file_name);
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
                $extensions = array("jpeg","jpg","png","svg");

                if(in_array($file_ext,$extensions)){
                    $path = '/templates/images/' . $file_name;
                    move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT']. $path);
                    $imgId = $bd->addImagen($path,$file_name,"","");
                    $bd->addImagenAEvento($imgId['max'],$idEv);
                    header("Location: evento.php?ev=".$idEv);
                }
                else{
                    $errores['imagen'] = "Invalid file extension";
                    echo $twig->render('/html/addImgEvento.html.twig',['errores' => $errores]);
                    exit();
                }
            }
            else{
                $errores['imagen'] = "Please select an image to upload";
                echo $twig->render('/html/addImgEvento.html.twig',['errores' => $errores]);
                exit();
            }
        }

        echo $twig->render('/html/addImgEvento.html.twig',["idEv" => $idEv]);
    }
    else{
        echo $twig->render('/html/error.html.twig',['error' => "403 FORBIDDEN"]);
    }
?>