<?php
    include("BD.php");

    session_start();
    $user;
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        
        if($user['nivel'] >= 4){
            $bd = new BD();
            $uname = $_GET['uname'];
            $lvl = $_GET['lvl'];
            $bd->updateRol($uname,$lvl);

            header("Location: listaUsuarios.php");
            exit();
        }
        else{
            echo "<h1>403 FORBIDDEN</h1>";
            exit();
        }
    }
    else{
        echo "<h1>403 FORBIDDEN</h1>";
        exit();
    }
?>
