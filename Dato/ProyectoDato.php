<?php

class ProyectoDato extends Mysql
{
    private $intId;
    private $strNombre;
    private $strDescripcion;
    private $strRepositorio;
    private $intEstado;
    private $strTags;
    private $intUsuarioId;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function setId(int $id)
    {
        $this->intId = $id;
    }
    public function setNombre(string $nombre)
    {
        $this->strNombre = $nombre;
    }
    public function setDescripcion(string $descripcion)
    {
        $this->strDescripcion = $descripcion;
    }
    public function setRepositorio(string $repositorio)
    {
        $this->strRepositorio = $repositorio;
    }
    public function setTags(string $tags)
    {
        $this->strTags = $tags;
    }
    public function setUsuarioId(int $id)
    {
        $this->intUsuarioId = $id;
    }
    public function all()
    {
        $sql = "SELECT proyectos.*, usuarios.nick FROM proyectos, usuarios WHERE proyectos.usuario_id = usuarios.id_usuario";
        $request = $this->select_all($sql);
        return $request;
    }
    public function allByUser()
    {
        $this->intUsuarioId = $_SESSION['idUser'];
        $sql = "SELECT proyectos.*, usuarios.nick FROM proyectos, usuarios WHERE proyectos.usuario_id = usuarios.id_usuario AND usuarios.id_usuario = $this->intUsuarioId";
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertProyecto()
    {
        try {
            $sql = "SELECT * FROM proyectos WHERE repositorio = '$this->strRepositorio'";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query_insert = "INSERT INTO proyectos(nombre, descripcion, repositorio, tags, usuario_id) VALUES (?,?,?,?,?)";
                $arrData = array($this->strNombre, $this->strDescripcion, $this->strRepositorio, $this->strTags, $this->intUsuarioId);
                $request_insert = $this->insert($query_insert, $arrData);
                return $request_insert;
            } else {
                throw new Exception("exist");
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function selectProyecto()
    {
        $sql = "SELECT *  FROM proyectos WHERE id_proyecto = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
    public function updateProyecto()
    {
        try {
            $sql = "SELECT * FROM proyectos WHERE repositorio = '$this->strRepositorio' AND id_proyecto != $this->intId";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $sql = "UPDATE proyectos SET nombre = ?, descripcion = ?, repositorio = ?, tags = ? WHERE id_proyecto = $this->intId";
                $arrData = array($this->strNombre, $this->strDescripcion, $this->strRepositorio, $this->strTags);
                $request = $this->update($sql, $arrData);
                return $request;
            } else {
                throw new Exception("exist");
            }
        } catch (Exception $e) {
            return  $request = $e->getMessage();
        }
    }
    public function disableProyecto()
    {
        try {
            $sql = "UPDATE proyectos SET estado = ? WHERE id_proyecto = $this->intId";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if ($request) {
                return $request = "ok";
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return $request = "error";
        }
    }
    public function enableProyecto()
    {
        try {
            $sql = "UPDATE proyectos SET estado = ? WHERE id_proyecto = $this->intId";
            $arrData = array(1);
            $request = $this->update($sql, $arrData);
            if ($request) {
                return $request = "ok";
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return $request = "error";
        }
    }
    // home
    public function getActiveProyectos()
    {
        try {
            $sql = "SELECT * FROM proyectos WHERE estado = 1";
            $request = $this->select_all($sql);
            for ($i = 0; $i < count($request); $i++) {
                $id = $request[$i]['id_proyecto'];
                $sql_lenguajes = "SELECT lenguajes.*  FROM proyectos, lenguajes, proyecto_lenguaje WHERE proyectos.id_proyecto = $id AND proyecto_lenguaje.proyecto_id = proyectos.id_proyecto AND proyecto_lenguaje.lenguaje_id = lenguajes.id_lenguaje";
                $request_lenguajes = $this->select_all($sql_lenguajes);
                $request[$i]["lenguajes"] = $request_lenguajes;
            }
            // dep($request);
            return $request;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getProyecto()
    {
        try {
            $sql = "SELECT *  FROM proyectos WHERE id_proyecto = '$this->intId'";
            $request = $this->select($sql);
            $sql = "SELECT lenguajes.*  FROM proyectos, lenguajes, proyecto_lenguaje WHERE id_proyecto = '$this->intId' 
                    AND proyecto_lenguaje.proyecto_id = proyectos.id_proyecto AND proyecto_lenguaje.lenguaje_id = lenguajes.id_lenguaje";
            $request_lenguajes = $this->select_all($sql);
            $request["lenguajes"] = $request_lenguajes;
            $sql = "SELECT c.*, u.nick, a.fecha
                FROM proyectos p, acciones a, comentarios c, usuarios u 
                WHERE p.id_proyecto = '$this->intId' AND a.proyecto_id = p.id_proyecto 
                AND a.usuario_id = u.id_usuario AND a.id_accion = c.accion_id AND a.estado = true";
            $request_comentarios = $this->select_all($sql);
            $request["comentarios"] = $request_comentarios;
            $sql = "SELECT count(f.accion_id) as cantidad
                FROM proyectos p, acciones a, favoritos f, usuarios u 
                WHERE p.id_proyecto = '$this->intId' AND a.proyecto_id = p.id_proyecto AND a.usuario_id = u.id_usuario 
                AND a.id_accion = f.accion_id AND a.estado = true";
            $request_corazones = $this->select($sql);
            $request["favoritos"] = $request_corazones;
            if (empty($_SESSION['login'])) {
                $request['favorito'] = false;
            } else {
                $idUsuario = $_SESSION['idUser'];
                $sql = "SELECT f.accion_id
                FROM proyectos p, acciones a, favoritos f, usuarios u 
                WHERE p.id_proyecto = '$this->intId' AND a.proyecto_id = p.id_proyecto AND a.usuario_id = u.id_usuario 
                    AND a.id_accion = f.accion_id AND a.estado = true AND u.id_usuario = $idUsuario";
                $request_favorito = $this->select($sql);
                if (intval($request_favorito['accion_id']) > 0) {
                    $request['favorito'] = true;
                } else {
                    $request['favorito'] = false;
                }
            }
            // dep($request);
            return $request;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
