<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    include("BD.php");

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errores;

        if(empty($_POST['uname'])){
            $errores['uname'] = "We need your username to log you in!";
        }

        if(empty($_POST['pass'])){
            $errores['pass'] = "Please type in your password";
        }

        if(!$errores){
            $uname = $_POST['uname'];
            $db = new BD();
            $res = $db->checkLogIn($uname,$_POST['pass']);

            if($res['error'] == "uname"){
                $errores['uname'] = "This user doesn't exists in our system";
            }
            else if($res['error'] == "pass"){
                $errores['pass'] = "Incorrect password";
            }
            else{
                session_start();
                $_SESSION['user']['uname'] = $res['uname'];
                $_SESSION['user']['nivel'] = $res['nivel'];
                header("Location: index.php");
                exit();
            }
        }

        echo $twig->render('/html/login.html.twig',['errores' => $errores]);

    }
    else{
        echo $twig->render('/html/login.html.twig',[]);
    }
    
?>