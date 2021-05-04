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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $required = array('uname', 'pass', 'email', 'fname','sname','city','gender','country','bday');

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
            echo $twig->render('/html/registro.html.twig',['errores' => $errores]);

            exit();
        }

        $usuario['uname'] = $_POST['uname'];
        $pass = $_POST['pass'];
        $usuario['pass'] = password_hash($pass, PASSWORD_DEFAULT);
        $usuario['email'] = $_POST['email'];
        $usuario['fname'] = $_POST['fname'];
        $usuario['sname'] = $_POST['sname'];
        $usuario['city'] = $_POST['city'];
        $usuario['gender'] = $_POST['gender'];
        $usuario['country'] = $_POST['country'];
        $usuario['bday'] = $_POST['bday'];

        $db = new BD();
        $res = $db->registrarUsuario($usuario);

        if(!$res){
            $errores['uname'] = "This username is taken";
            echo $twig->render('/html/registro.html.twig',['errores' => $errores]);
            exit();
        }

        session_start();

        $user = array('uname' => $usuario['uname'], 'nivel' => 1);

        $_SESSION['user'] = $user;
        header("Location: index.php");
    }
    else{
        echo $twig->render('/html/registro.html.twig',[]);
    }
?>