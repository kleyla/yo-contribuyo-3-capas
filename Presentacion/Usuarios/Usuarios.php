<?php

class Usuarios extends Presentacion
{

    function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }
    public function usuarios()
    {
        if ($_SESSION['userData']['rol'] == "Administrador") {
            // echo "Usuarios";
            $data["page_id"] = 1;
            $data["page_tag"] = "Usuarios";
            $data["page_title"] = "Usuarios - Yo contribuyo";
            $data["page_name"] = "usuarios";
            $data["nav_usuarios"] = "active";
            $data["script"] = "js/functions_usuarios.js";
            $this->views->getView($this, "usuarios", $data);
        } else {
            header('Location: ' . base_url() . 'dashboard');
        }
    }
    public function getUsuarios()
    {
        $arrData = $this->negocio->getUsuarios();
        // FORMATO JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function setUsuario()
    {
        $intIdUsuario = intval($_POST['idUsuario']);
        $strNick = strClean($_POST["txtNick"]);
        $strEmail = strClean($_POST["txtEmail"]);
        $strPass = strClean($_POST["txtPass"]);
        $strRol = strClean($_POST["listaRol"]);
        $arrResponse = $this->negocio->setUsuario($intIdUsuario, $strNick, $strEmail, $strPass, $strRol);

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getUsuario(int $id)
    {
        $intIdUsuario = intval(strClean($id));
        if ($intIdUsuario > 0) {
            $arrResponse = $this->negocio->getUsuario($intIdUsuario);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function deleteUsuario()
    {
        if ($_POST) {
            $intIdUsuario = intval($_POST["idusuario"]);
            $arrResponse = $this->negocio->deleteUsuario($intIdUsuario);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function habilitarUsuario()
    {
        if ($_POST) {
            $intId = intval($_POST["idusuario"]);
            $request = $this->model->enableUsuario($intId);
            if ($request === "ok") {
                $arrResponse = array('status' => true, 'msg' => "Se ha habilitado el Usuario");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al habilitar el Usuario.");
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function perfil()
    {
        $data["page_tag"] = "Perfil";
        $data["page_title"] = "Perfil de usuario";
        $data["page_name"] = "perfil";
        $data["script"] = "js/functions_perfil.js";
        $this->views->getView($this, "perfil", $data);
    }
}
