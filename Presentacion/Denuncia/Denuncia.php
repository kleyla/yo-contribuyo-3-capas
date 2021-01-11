<?php

class Denuncia extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }
    public function setDenuncia()
    {
        try {
            $intIdArticulo = intval($_POST["idArticulo"]);
            $strRazones = strClean($_POST["txtRazones"]);
            if ($intIdArticulo != '' && $strRazones != '') {
                $arrResponse = $this->negocio->setDenuncia($intIdArticulo, $strRazones);
            } else {
                $arrResponse = array('status' => false, 'msg' => "Datos incompletos!");
            }
            // dep($arrResponse);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function verDenuncias(int $idArticulo)
    {
        $data["page_id"] = 3;
        $data["page_tag"] = "Denuncias";
        $data["page_title"] = "Denuncias - Yo contribuyo";
        $data["page_name"] = "denuncias";
        $data["nav_articulos"] = "active";
        $data["script"] = "Denuncia/denuncias.js";
        $data["id_articulo"] = $idArticulo;
        $this->getView("Denuncia/verDenuncias", $data);
    }
    public function getDenuncias(int $idArticulo)
    {
        if ($idArticulo > 0) {
            $arrResponse =  $this->negocio->getDenuncias($idArticulo);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function deleteDenuncia()
    {
        if ($_POST) {
            $intIdArticulo = intval($_POST["idArticulo"]);
            $intIdUsuario = intval($_POST["idUsuario"]);
            $arrResponse = $this->negocio->deleteDenuncia($intIdArticulo, $intIdUsuario);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
