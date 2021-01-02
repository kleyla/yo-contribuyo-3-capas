<?php

class DenunciasDato extends Mysql
{
    private $strRazones;
    private $intUsuarioId;
    private $intArticuloId;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function setArticuloId(int $id)
    {
        $this->intArticuloId = $id;
    }
    public function setRazones(string $razones)
    {
        $this->strRazones = $razones;
    }
    public function setUsuarioId(int $id)
    {
        $this->intUsuarioId = $id;
    }
    public function insertDenuncia()
    {
        try {
            $sql = "SELECT * FROM detalle_denuncia WHERE articulo_id = '$this->intArticuloId' AND usuario_id = '$this->intUsuarioId'";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query_insert = "INSERT INTO detalle_denuncia(articulo_id, usuario_id, razones) VALUES (?,?,?)";
                $arrData = array($this->intArticuloId, $this->intUsuarioId, $this->strRazones);
                $request = $this->insert($query_insert, $arrData);
                return $request;
            } else {
                $request = 'existe';
                return $request;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
