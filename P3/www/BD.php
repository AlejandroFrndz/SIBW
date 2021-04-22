<?php

class BD{
    private $con;

    public function __construct(){
        $this->$con = new mysqli("mysql","webClient","finisterre","SIBW");
        if($this->$con->connect_errno){
            echo("Fallo al conectar: " . $con->connect_error);
        }
    }

    public function getEvento($idEv){
        $stmt = $this->$con->prepare("SELECT * FROM Evento WHERE DB_idEV = ?");
        $stmt->bind_param("i",$idEv);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows > 0){
            $evento = $res->fetch_assoc();

            $fecha = $evento['fecha'];
            $time = strtotime($fecha);
            $formato = date("l\, F j \- g:i A \P\D\T", $time);
            $evento['fecha'] = $formato;
            return $evento;
        }
        else{
            return $evento;
        }

    }

    public function getImagenesEvento($idEv){
        $stmt = $this->$con->prepare("SELECT id,href,src,alt FROM Imagen NATURAL JOIN ImagenEvento WHERE DB_idEv = ?");
        $stmt->bind_param("i",$idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        $imagenes = $res->fetch_all(MYSQLI_ASSOC);

        return $imagenes;
    }

    public function getComentariosEvento($idEv){
        $stmt = $this->$con->prepare("SELECT autor,fecha,cuerpo FROM Comentario WHERE DB_idEv = ?");
        $stmt->bind_param("i",$idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        $comentarios = $res->fetch_all(MYSQLI_ASSOC);
        return $comentarios;
    }

    public function getImagenesPortada(){
        $res = $this->$con->query("SELECT Imagen.id,Imagen.href,Imagen.src,Imagen.alt FROM Imagen JOIN Evento ON DB_idIm = imagenPortada ORDER BY DB_idEv ASC;");
        $imagenes = $res->fetch_all(MYSQLI_ASSOC);
        return $imagenes;
    }
}


?>