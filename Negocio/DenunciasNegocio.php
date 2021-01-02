<?php

class DenunciasNegocio extends Controllers
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
                $request = $this->model->insertDenuncia($intIdArticulo, $strRazones);
                // dep($request);
                if ($request == 0) {
                    $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
                } elseif ($request === 'existe') {
                    $arrResponse = array('status' => false, 'msg' => "Ya realizo la denuncia");
                } else {
                    $arrResponse = array('status' => false, 'msg' => $request);
                }
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
}
