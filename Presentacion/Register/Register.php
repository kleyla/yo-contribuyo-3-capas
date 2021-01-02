<?php

class Register extends Presentacion
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header('Location: ' . base_url() . 'dashboard');
        }
        parent::__construct();
    }

    public function register()
    {
        // echo "mensaje desde el controlador";
        $data["page_tag"] = "Registro - Yo Contribuyo";
        $data["page_title"] = "Registro";
        $data["page_name"] = "registro";
        $data["script"] = "js/functions_register.js";
        $this->views->getView($this, "register", $data);
    }
    public function registerUser()
    {
        // dep($_POST);
        if ($_POST) {
            if (empty($_POST["txtEmail"]) || empty($_POST["txtPass"]) || empty($_POST['txtNick'])) {
                $arrResponse = array('status' => false, 'msg' => "Error de datos");
            } else {
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $strNick = strClean($_POST['txtNick']);
                $strPass = hash("SHA256", $_POST['txtPass']); 
                $arrResponse = $this->negocio->registerUser($strEmail, $strNick, $strPass);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
