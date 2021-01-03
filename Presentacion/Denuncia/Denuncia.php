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
    public function exa()
    {
        echo "Denuncia";
    }
}
