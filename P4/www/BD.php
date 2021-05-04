<?php

class BD{
    private $con;

    public function __construct(){
        $this->$con = new mysqli("mysql","webClient","finisterre","SIBW");
        $this->$con->query("SET @@session.time_zone = 'Europe/Madrid';");
        if($this->$con->connect_errno){
            echo("Fallo al conectar: " . $con->connect_error);
        }
    }

    public function getEvento($idEv){
        $stmt = $this->$con->prepare("SELECT * FROM Evento WHERE DB_idEv = ?");
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
        $stmt = $this->$con->prepare("SELECT DB_idCo,uname,fecha,cuerpo FROM Comentario WHERE DB_idEv = ? ORDER BY fecha ASC");
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

    public function registrarUsuario($usuario){
        $stmt = $this->$con->prepare("SELECT * FROM Usuario WHERE uname = ?");
        $stmt->bind_param("s",$usuario['uname']);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows > 0){
            return false;
        }
        else{
            $stmt = $this->$con->prepare("INSERT INTO Usuario VALUES (?,?,?,?,?,?,?,?,?,1)");
            $stmt->bind_param("sssssssss",$usuario['email'],$usuario['uname'],$usuario['pass'],$usuario['fname'],$usuario['sname'],$usuario['city'],$usuario['gender'],$usuario['country'],$usuario['bday']);
            $stmt->execute();
            $stmt->close();
            return true;
        }
    }

    public function checkLogIn($uname, $pass){
        $stmt = $this->$con->prepare("SELECT uname,pass,nivel FROM Usuario WHERE uname = ?");
        $stmt->bind_param("s",$uname);
        $stmt->execute();
        $res = $stmt->get_result();
        $saved = $res->fetch_assoc();

        if($res->num_rows == 0){
            $saved['error'] = "uname";
            return $saved;
        }
        
        if(password_verify($pass,$saved['pass'])){
            $saved['error'] = "ok";
            return $saved;
        }
        else{
            $saved['error'] = "pass";
            return $saved;
        }
    }

    public function getPalabrasProhibidas(){
        $res = $this->$con->query("SELECT palabra FROM PalabraProhibida");
        $palabras = $res->fetch_all(MYSQLI_ASSOC);
        return $palabras;
    }

    public function guardarComentario($uname,$cuerpo,$idEv){
        $stmt = $this->$con->prepare("INSERT INTO Comentario(uname,fecha,cuerpo,DB_idEv) VALUES (?,now(),?,?)");
        $stmt->bind_param("ssi",$uname,$cuerpo,$idEv);
        $stmt->execute();
    }

    public function getUsuario($uname){
        $stmt = $this->$con->prepare("SELECT * FROM Usuario WHERE uname = ?");
        $stmt->bind_param("s",$uname);
        $stmt->execute();
        $res = $stmt->get_result();
        $user = $res->fetch_assoc();
        return $user;
    }

    public function updateUsuario($usuario){
        $stmt = $this->$con->prepare("UPDATE Usuario SET email = ?, pass = ?, nombre = ?, apellido = ?, direccion = ?, sexo = ?, pais = ?, fNac = ? WHERE uname = ?");
        $stmt->bind_param("sssssssss", $usuario['email'], $usuario['pass'], $usuario['fname'], $usuario['sname'], $usuario['city'], $usuario['gender'], $usuario['country'], $usuario['bday'], $usuario['uname']);
        $stmt->execute();
    }

    public function deleteComentario($id){
        $stmt = $this->$con->prepare("DELETE FROM Comentario WHERE DB_idCo = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }
}


?>