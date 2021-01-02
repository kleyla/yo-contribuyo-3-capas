<?php

class DenunciasDato extends Mysql
{
    private $intId;
    private $strRazones;
    private $intUsuarioId;
    private $intArticuloId;

    public function __construct()
    {
        parent::__construct();
        // echo "mensaje desde el modelo home!";
    }
    public function insertDenuncia(int $idArticulo, string $razones)
    {
        try {
            $idUsuario = intval($_SESSION['idUser']);
            $this->intUsuarioId = $idUsuario;
            $this->intArticuloId = $idArticulo;
            $this->strRazones = $razones;
            $sql = "SELECT * FROM detalle_denuncia WHERE articulo_id = $idArticulo AND usuario_id = $idUsuario";
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
