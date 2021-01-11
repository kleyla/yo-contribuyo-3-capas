<?php

class DenunciaDato extends Mysql
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
            $sql = "SELECT * FROM denuncias WHERE articulo_id = '$this->intArticuloId' AND usuario_id = '$this->intUsuarioId'";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query_insert = "INSERT INTO denuncias(articulo_id, usuario_id, razones) VALUES (?,?,?)";
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
    public function getDenunciasByArticulo()
    {
        try {
            $sql = "SELECT d.*, u.nick FROM denuncias d, usuarios u 
                WHERE d.articulo_id = '$this->intArticuloId' AND d.usuario_id = u.id_usuario AND d.estado = 1";
            $arrData = $this->select_all($sql);
            for ($i = 0; $i < count($arrData); $i++) {
                $arrData[$i]["estado"] = '<span class="badge badge-success">Activo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-danger btn-sm" onclick="btnDeleteDenuncia(' . $arrData[$i]['usuario_id'] . ')" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            }
            return $arrData;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function disableDenuncia()
    {
        try {
            $sql = "UPDATE denuncias SET estado = ? 
                WHERE articulo_id = '$this->intArticuloId' AND usuario_id = '$this->intUsuarioId'";
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
