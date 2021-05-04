<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    function checkEmail($email){
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false);
    }

    include("BD.php");
    $bd = new BD();
    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $required = array('pass', 'email', 'fname','sname','city','gender','country','bday');

        $errores;

        foreach($required as $field){
            if(empty($_POST[$field])){
                $errores[$field] = "This field cannot be empty";
            }
        }

        if(!empty($_POST['email'])){
            if(!checkEmail($_POST['email'])){
                $errores['email'] = "Invalid email";
            }
        }

        if($errores){
            $fullUser = $bd->getUsuario($user['uname']);
            echo $twig->render('/html/perfil.html.twig',['errores' => $errores, 'user' => $fullUser]);

            exit();
        }

        $usuario['uname'] = $user['uname'];
        $pass = $_POST['pass'];
        $usuario['pass'] = password_hash($pass, PASSWORD_DEFAULT);
        $usuario['email'] = $_POST['email'];
        $usuario['fname'] = $_POST['fname'];
        $usuario['sname'] = $_POST['sname'];
        $usuario['city'] = $_POST['city'];
        $usuario['gender'] = $_POST['gender'];
        $usuario['country'] = $_POST['country'];
        $usuario['bday'] = $_POST['bday'];

        $bd->updateUsuario($usuario);

        header("Location: perfil.php");

        exit();
    }


    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        $fullUser = $bd->getUsuario($user['uname']);

        echo $twig->render('/html/perfil.html.twig',['user' => $fullUser]);

        exit();
    }
    
    echo $twig->render('/html/notFound.html.twig',[]);

?>