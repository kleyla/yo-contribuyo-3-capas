<?php

class Favorito extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }
    public function favorito()
    {
        $data["page_id"] = 1;
        $data["page_tag"] = "Favoritos";
        $data["page_title"] = "Favoritos - Yo contribuyo";
        $data["page_name"] = "favoritos";
        $data["nav_favoritos"] = "active";
        $data["script"] = "favorito.js";
        $this->views->getView($this, "favoritos", $data);
    }
    public function getFavoritos()
    {
        $arrData = $this->negocio->getFavoritos();
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function setFavoritos()
    {
        try {
            $intIdProyecto = intval($_POST["idProyecto"]);
            $intFavorito = strClean($_POST["favorito"]);
            if ($intIdProyecto != '' && $intFavorito != '') {
                $arrResponse = $this->negocio->setFavoritos($intIdProyecto, $intFavorito);
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
