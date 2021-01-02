<?php

class Proyectos extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }

    public function proyectos()
    {
        // echo "mensaje desde el controlador";
        $data["page_id"] = 1;
        $data["page_tag"] = "Proyectos";
        $data["page_title"] = "Proyectos - Yo contribuyo";
        $data["page_name"] = "proyectos";
        $data["nav_proyectos"] = "active";
        $data["script"] = "js/functions_proyectos.js";
        $this->views->getView($this, "proyectos", $data);
    }
    public function getProyectos()
    {
        $arrData = $this->negocio->getProyectos();
        // dep($arrData);
        // FORMATO JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function form($id = 0)
    {
        $data["page_id"] = 1;
        $data["page_tag"] = "Proyectos";
        $data["page_title"] = "Proyectos - Formulario";
        $data["page_name"] = "proyectos";
        $data["script"] = "js/functions_proyectos_nuevo.js";
        $lenguajes = $this->negocio->getActiveLenguajes();
        $data["lenguajes"] = $lenguajes;
        $data["id_proyecto"] = $id;
        // dep($lenguajes);
        $this->views->getView($this, "form", $data);
    }
    public function setProyecto()
    {
        $intIdProyecto = intval($_POST['idProyecto']);
        $strNombre = strClean($_POST["txtNombre"]);
        $strDescripcion = strClean($_POST["txtDescripcion"]);
        $strRepositorio = strClean($_POST["txtRepositorio"]);
        $strTags = strClean($_POST["txtTags"]);
        $arrayLenguajes = $_POST["lenguajes"];

        $arrResponse = $this->negocio->setProyecto($intIdProyecto, $strNombre, $strDescripcion, $strRepositorio, $arrayLenguajes, $strTags);
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getProyecto(int $id)
    {
        $intId = intval(strClean($id));
        if ($intId > 0) {
            $arrResponse = $this->negocio->getProyecto($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function deleteProyecto()
    {
        if ($_POST) {
            $intId = intval($_POST["idProyecto"]);
            $arrResponse = $this->negocio->deleteProyecto($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function habilitarProyecto()
    {
        if ($_POST) {
            $intId = intval($_POST["idProyecto"]);
            $arrResponse = $this->negocio->habilitarProyecto($intId);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
