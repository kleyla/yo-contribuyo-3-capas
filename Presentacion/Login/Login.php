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
        require_once("Negocio/UsuarioNegocio.php");
        $this->usuario = new UsuarioNegocio();
    }
    public function login()
    {
        // echo "Presentacion Login";
        $data["page_tag"] = "Login - Yo Contribuyo";
        $data["page_title"] = "Login";
        $data["page_name"] = "login";
        $data["script"] = "Login/login.js";
        $this->getView("Login/logins", $data);
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
                $arrResponse = $this->usuario->loginUser($strEmail, $strPass);
            }
            // dep($arrResponse);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
