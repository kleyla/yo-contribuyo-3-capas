<?php
class Conexion
{
    private $conexion;
    private $strquery;
    private $arraValues;

    function __construct()
    {
        $this->conect();
    }

    public function conect()
    {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";.DB_CHARSET.";
        try {
            $this->conexion = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "conexion exitosa";
        } catch (PDOException $e) {
            $this->conexion = "Error de conexion";
            echo "Error: " . $e->getMessage();
        }
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
