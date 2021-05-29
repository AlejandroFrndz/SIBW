<?php
    header('Content-Type: application/json');

    include("BD.php");

    session_start();

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        
        if($user['nivel'] >= 3){
            $manager = true;
        }
    }
    else{
        $manager = false;
    }

    $bd = new BD();
    $str = $_GET["str"];
    $data = $bd->buscarEventos($str,$manager);

    echo(json_encode($data));
?>