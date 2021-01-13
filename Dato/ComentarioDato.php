<?php

class ComentarioDato extends Conexion
{
    private $intAccionId;
    private $strContenido;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function setAccionId(int $id)
    {
        $this->intAccionId = $id;
    }
    public function setContenido(string $contenido)
    {
        $this->strContenido = $contenido;
    }
    public function insertComentario()
    {
        try {
            $query_insert = "INSERT INTO comentarios(contenido, accion_id) VALUES (?,?)";
            $arrData = array($this->strContenido, $this->intAccionId);
            $request_comentario = $this->insert($query_insert, $arrData);
            return $this->intAccionId;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
