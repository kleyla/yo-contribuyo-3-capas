<?php

class ArticuloDato extends Conexion
{
    private $intId;
    private $strTitulo;
    private $strContenido;
    private $intEstado;
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
    public function setTitulo(string $titulo)
    {
        $this->strTitulo = $titulo;
    }
    public function setContenido(string $contenido)
    {
        $this->strContenido = $contenido;
    }
    public function setEstado(int $estado)
    {
        $this->intEstado = $estado;
    }
    public function setUsuarioId(int $id)
    {
        $this->intUsuarioId = $id;
    }
    public function all()
    {
        $sql = "SELECT articulos.*, usuarios.nick FROM articulos, usuarios WHERE articulos.usuario_id = usuarios.id_usuario";
        $request = $this->select_all($sql);
        return $request;
    }
    public function allByUser()
    {
        $this->intUsuarioId = $_SESSION['idUser'];
        $sql = "SELECT articulos.*, usuarios.nick FROM articulos, usuarios WHERE articulos.usuario_id = usuarios.id_usuario AND usuarios.id_usuario = $this->intUsuarioId";
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertArticulo()
    {
        try {
            $query_insert = "INSERT INTO articulos(titulo, contenido, usuario_id, estado) VALUES (?,?,?,?)";
            $arrData = array($this->strTitulo, $this->strContenido, $this->intUsuarioId, $this->intEstado);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
            return $return;
        } catch (Exception $e) {
            return $return = $e->getMessage();
        }
    }
    public function selectArticulo()
    {
        $sql = "SELECT *  FROM articulos WHERE id_articulo = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
    public function updateArticulo()
    {
        try {
            $sql = "UPDATE articulos SET titulo = ?, contenido = ?, estado = ? WHERE id_articulo = $this->intId";
            $arrData = array($this->strTitulo, $this->strContenido, $this->intEstado);
            $request = $this->update($sql, $arrData);
            return $request;
        } catch (Exception $e) {
            return  $request = $e->getMessage();
        }
    }
    public function disableArticulo()
    {
        try {
            $sql = "UPDATE articulos SET estado = ? WHERE id_articulo = $this->intId";
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
    public function enableArticulo()
    {
        try {
            $sql = "UPDATE articulos SET estado = ? WHERE id_articulo = $this->intId";
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
    public function getActiveArticulos()
    {
        try {
            $sql = "SELECT articulos.*, usuarios.nick FROM articulos, usuarios 
                WHERE articulos.estado = 1 
                AND articulos.usuario_id = usuarios.id_usuario";
            $request = $this->select_all($sql);
            return $request;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getArticulo()
    {
        try {
            $sql = "SELECT articulos.*, usuarios.nick FROM articulos, usuarios WHERE id_articulo = '$this->intId' 
                AND articulos.usuario_id = usuarios.id_usuario";
            $request = $this->select($sql);
            return $request;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
