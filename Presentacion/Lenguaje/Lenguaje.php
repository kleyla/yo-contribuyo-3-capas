<?php

class Lenguaje extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }

    public function lenguajes()
    {
        if ($_SESSION['userData']['rol'] == "Administrador") {
            // echo "mensaje desde el controlador";
            $data["page_id"] = 1;
            $data["page_tag"] = "Lenguajes";
            $data["page_title"] = "Lenguajes - Yo contribuyo";
            $data["page_name"] = "lenguajes";
            $data["nav_lenguajes"] = "active";
            $data["script"] = "Lenguaje/lenguajes.js";
            $this->getView("Lenguaje/lenguajes", $data);
        } else {
            header('Location: ' . base_url() . 'dashboard');
        }
    }
    public function getLenguajes()
    {
        $arrData = $this->negocio->getLenguajes();
        // FORMATO JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function setLenguaje()
    {
        $intIdLenguaje = intval($_POST['idLenguaje']);
        $strNombre = strClean($_POST["txtNombre"]);
        $strLink = strClean($_POST["txtLink"]);

        $arrResponse = $this->negocio->setLenguaje($intIdLenguaje, $strNombre, $strLink);
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getLenguaje(int $id)
    {
        $intIdLenguaje = intval(strClean($id));
        if ($intIdLenguaje > 0) {
            $arrResponse = $this->negocio->getLenguaje($intIdLenguaje);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function deleteLenguaje()
    {
        if ($_POST) {
            $intId = intval($_POST["idlenguaje"]);
            $arrResponse = $this->negocio->deleteLenguaje($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function habilitarLenguaje()
    {
        if ($_POST) {
            $intId = intval($_POST["idlenguaje"]);
            $arrResponse = $this->negocio->habilitarLenguaje($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
