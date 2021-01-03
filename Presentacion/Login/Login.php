<?php
class Login extends Presentacion
{

    public function __construct()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header('Location: ' . base_url() . 'dashboard');
        }
        // echo "Presentacion login";
        parent::__construct();
    }
    public function login()
    {
        // echo "Presentacion Login";
        $data["page_tag"] = "Login - Yo Contribuyo";
        $data["page_title"] = "Login";
        $data["page_name"] = "login";
        $data["script"] = "login.js";
        $this->views->getView($this, "login", $data);
    }
    public function loginUser()
    {
        // dep($_POST);
        if ($_POST) {
            if (empty($_POST["txtEmail"]) || empty($_POST["txtPass"])) {
                $arrResponse = array('status' => false, 'msg' => "Error de datos");
            } else {
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $strPass = hash("SHA256", $_POST['txtPass']);
                $arrResponse = $this->negocio->loginUser($strEmail, $strPass);
            }
            // dep($arrResponse);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
