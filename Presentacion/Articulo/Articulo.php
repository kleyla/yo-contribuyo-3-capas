<?php

class Articulo extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }

    public function articulo()
    {
        // echo "mensaje desde el controlador";
        $data["page_id"] = 1;
        $data["page_tag"] = "Articulos";
        $data["page_title"] = "Articulos - Yo contribuyo";
        $data["page_name"] = "articulos";
        $data["nav_articulos"] = "active";
        $data["script"] = "articulo.js";
        $this->views->getView($this, "articulos", $data);
    }
    public function getArticulos()
    {
        $arrData = $this->negocio->getArticulos();
        // dep($arrData);
        // FORMATO JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function form($id = 0)
    {
        $data["page_id"] = 1;
        $data["page_tag"] = "Articulos";
        $data["page_title"] = "Articulos - Formulario";
        $data["page_name"] = "articulos";
        $data["script"] = "articulo_nuevo.js";
        $data["id_articulo"] = $id;
        // dep($lenguajes);
        $this->views->getView($this, "form", $data);
    }
    public function setArticulo()
    {
        $intIdArticulo = intval($_POST['idArticulo']);
        $strTitulo = strClean($_POST["txtTitulo"]);
        $strContenido = $_POST["txtContenido"];
        $intStatus = strClean($_POST["listStatus"]);

        $arrResponse = $this->negocio->setArticulo($intIdArticulo, $strTitulo, $strContenido, $intStatus);
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getArticulo(int $id)
    {
        $intId = intval(strClean($id));
        if ($intId > 0) {
            $arrResponse = $this->negocio->getArticulo($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function deleteArticulo()
    {
        if ($_POST) {
            $intId = intval($_POST["idArticulo"]);
            $arrResponse = $this->negocio->deleteArticulo($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function habilitarArticulo()
    {
        if ($_POST) {
            $intId = intval($_POST["idArticulo"]);
            $arrResponse = $this->negocio->habilitarArticulo($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
