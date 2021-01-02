<?php
class Mysql extends Conexion
{
    private $conexion;
    private $strquery;
    private $arraValues;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    // insert un registro
    public function insert(string $query, array $arraValues)
    {
        $this->strquery = $query;
        $this->arraValues = $arraValues;
        $insert = $this->conexion->prepare($this->strquery);
        $resInsert = $insert->execute($this->arraValues);
        if ($resInsert) {
            $lastInsert = $this->conexion->lastInsertId();
        } else {
            $lastInsert = 0;
        }
        return $lastInsert;
    }
    // Busca un registro
    public function select(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function select_all(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }
    public function update(string $query, array $arraValues)
    {
        $this->strquery = $query;
        $this->arraValues = $arraValues;
        $update = $this->conexion->prepare($this->strquery);
        $resExecute = $update->execute($this->arraValues);
        return $resExecute;
    }
    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $del = $result->execute();
        return $del;
    }
    public function drop(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $drop = $result->execute();
        return $drop;
    }
}
