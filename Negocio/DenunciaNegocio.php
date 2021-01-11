<?php

class DenunciaNegocio extends Negocio
{
    public function __construct()
    {
        parent::__construct();
    }
    public function setDenuncia($intIdArticulo, $strRazones)
    {
        try {
            $this->dato->setArticuloId($intIdArticulo);
            $this->dato->setUsuarioId($_SESSION['idUser']);
            $this->dato->setRazones($strRazones);
            $request = $this->dato->insertDenuncia();
            // dep($request);
            if ($request == 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } elseif ($request === 'existe') {
                $arrResponse = array('status' => false, 'msg' => "Ya realizo la denuncia");
            } else {
                $arrResponse = array('status' => false, 'msg' => $request);
            }
            return $arrResponse;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getDenuncias(int $idArticulo)
    {
        $this->dato->setArticuloId($idArticulo);
        return  $this->dato->getDenunciasByArticulo();
    }
    public function deleteDenuncia(int $intIdArticulo, int $intIdUsuario)
    {
        $this->dato->setArticuloId($intIdArticulo);
        $this->dato->setUsuarioId($intIdUsuario);
        $requestDelete = $this->dato->disableDenuncia();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha eliminado la denuncia");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar la denuncia.");
        }
        return $arrResponse;
    }
}
