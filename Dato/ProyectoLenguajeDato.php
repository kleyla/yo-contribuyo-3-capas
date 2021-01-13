<?php

class ProyectoLenguajeDato extends Conexion
{
    private $intProyectoId;
    private $intLenguajeId;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function setProyectoId(int $id)
    {
        $this->intProyectoId = $id;
    }
    public function setLenguajeId(int $id)
    {
        $this->intLenguajeId = $id;
    }
    public function insertProyectoLenguaje()
    {
        $query_insert = "INSERT INTO proyecto_lenguaje(proyecto_id, lenguaje_id) VALUES (?,?)";
        $arrData = array($this->intProyectoId, $this->intLenguajeId);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }
    public function selectLenguajes()
    {
        $sql = "SELECT lenguajes.*  FROM proyectos, lenguajes, proyecto_lenguaje WHERE id_proyecto = $this->intProyectoId AND proyecto_lenguaje.proyecto_id = proyectos.id_proyecto AND proyecto_lenguaje.lenguaje_id = lenguajes.id_lenguaje";
        $request_lenguajes = $this->select_all($sql);
        return $request_lenguajes;
    }
    public function deleteProyectoLenguaje()
    {
        $sqlDel = "DELETE FROM proyecto_lenguaje WHERE proyecto_id = $this->intProyectoId";
        $request_del = $this->delete($sqlDel);
    }
}
