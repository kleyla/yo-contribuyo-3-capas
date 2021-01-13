<?php

class AccionDato extends Conexion
{
    private $intId;
    private $intUsuarioId;
    private $intProyectoId;
    private $fecha;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function setId(int $id)
    {
        $this->intId = $id;
    }
    public function setUsuarioId(int $id)
    {
        $this->intUsuarioId = $id;
    }
    public function setProyectoId(int $id)
    {
        $this->intProyectoId = $id;
    }
    public function insertAccion()
    {
        try {
            $query_insert = "INSERT INTO acciones(usuario_id, proyecto_id) VALUES (?,?)";
            $arrData = array($this->intUsuarioId, $this->intProyectoId);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteAccion()
    {
        // ACCION
        $sqlDel = "DELETE FROM acciones WHERE id_accion = '$this->intId'";
        $request_del = $this->delete($sqlDel);
        return 1;
    }
    public function disableAccion()
    {
        try {
            $sql = "UPDATE acciones SET estado = ? WHERE id_accion = $this->intId";
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
}
