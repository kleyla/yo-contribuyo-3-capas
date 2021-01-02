<?php

class DenunciasNegocio extends Negocio
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
}
