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

    public function getAllEventos(){
        $res = $this->$con->query("SELECT DB_idEv,titulo FROM Evento");
        $events = $res->fetch_all(MYSQLI_ASSOC);
        return $events;
    }

    public function addEvento($evento){
        $stmt = $this->$con->prepare("INSERT INTO Evento(titulo,href,organizador,fecha,descripcion,imagenPortada) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$evento['titulo'],$evento['href'],$evento['organizador'],$evento['fecha'],$evento['descripcion'],$evento['imagenPortada']);
        $stmt->execute();
        $res = $this->$con->query("SELECT MAX(DB_idEv)max FROM Evento");
        $id = $res->fetch_assoc();
        return $id;
    }

    public function addImagenAEvento($img,$ev){
        $stmt = $this->$con->prepare("INSERT INTO ImagenEvento VALUES (?,?)");
        $stmt->bind_param("ii",$ev,$img);
        $stmt->execute();
    }

    public function getAllComentarios(){
        $res = $this->$con->query("SELECT C.DB_idCo, C.uname, C.fecha, C.cuerpo, E.titulo, E.DB_idEv FROM Comentario C JOIN Evento E ON C.DB_idEv = E.DB_idEv ORDER BY E.DB_idEv ASC, C.fecha ASC;");
        $comentarios = $res->fetch_all(MYSQLI_ASSOC);
        return $comentarios;
    }

    public function getComentariosEvento($idEv){
        $stmt = $this->$con->prepare("SELECT DB_idCo,uname,fecha,cuerpo FROM Comentario WHERE DB_idEv = ? ORDER BY fecha ASC");
        $stmt->bind_param("i",$idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        $comentarios = $res->fetch_all(MYSQLI_ASSOC);
        return $comentarios;
    }

    public function getComentario($idCo){
        $stmt = $this->$con->prepare("SELECT DB_idCo,uname,fecha,cuerpo FROM Comentario WHERE DB_idCo = ?");
        $stmt->bind_param("i",$idCo);
        $stmt->execute();
        $res = $stmt->get_result();
        $comentario = $res->fetch_assoc();
        return $comentario;
    }

    public function updateComentario($idCo, $cuerpo){
        $stmt = $this->$con->prepare("UPDATE Comentario SET cuerpo = ? WHERE DB_idCo = ?");
        $stmt->bind_param("si",$cuerpo,$idCo);
        $stmt->execute();
    }

    public function getImagenesPortada(){
        $res = $this->$con->query("SELECT Imagen.id,Imagen.href,Imagen.src,Imagen.alt FROM Imagen JOIN Evento ON DB_idIm = imagenPortada ORDER BY DB_idEv ASC;");
        $imagenes = $res->fetch_all(MYSQLI_ASSOC);
        return $imagenes;
    }

    public function addImagen($src,$alt,$href,$id){
        $stmt = $this->$con->prepare("INSERT INTO Imagen(src,alt,href,id) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$src,$alt,$href,$id);
        $stmt->execute();
        $res = $this->$con->query("SELECT MAX(DB_idIm)max FROM Imagen");
        $id = $res->fetch_assoc();
        return $id;
    }

    public function updateHrefImagen($href,$id){
        $stmt = $this->$con->prepare("UPDATE Imagen SET href = ? WHERE DB_idIm = ?");
        $stmt->bind_param("si",$href,$id);
        $stmt->execute();
    }

    public function getAllUsuarios(){
        $res = $this->$con->query("SELECT uname,nivel,intocable FROM Usuario ORDER BY uname ASC;");
        $usuarios = $res->fetch_all(MYSQLI_ASSOC);
        return $usuarios;
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

    public function updateRol($uname,$lvl){
        $stmt = $this->$con->prepare("UPDATE Usuario SET nivel = ? WHERE uname = ?");
        $stmt->bind_param("is", $lvl, $uname);
        $stmt->execute();
    }

    public function deleteComentario($id){
        $stmt = $this->$con->prepare("DELETE FROM Comentario WHERE DB_idCo = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }

}


?>