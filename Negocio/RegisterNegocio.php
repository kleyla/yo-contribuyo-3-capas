<?php

class RegisterNegocio
{
    private $usuario;

    public function __construct()
    {
        require_once("Dato/UsuarioDato.php");
        $this->usuario = new UsuarioDato();
    }

    public function registerUser(string $strEmail, string $strNick, string $strPass)
    {
        $this->usuario->setEmail($strEmail);
        $this->usuario->setNick($strNick);
        $this->usuario->setPassword($strPass);
        $this->usuario->setRol("Contribuidor");
        $requestUser = $this->usuario->insertUsuario();
        // dep($requestUser);
        if ($requestUser === "exist") {
            $arrResponse = array('status' => false, 'msg' => "El email o nick ya existen");
        } else if ($requestUser > 0) {
            $_SESSION['idUser'] = $requestUser;
            $_SESSION['login'] = true;
            $this->usuario->setId($_SESSION['idUser']);
            $arrData = $this->usuario->sessionLogin();
            $_SESSION['userData'] = $arrData;
            $arrResponse = array('status' => true, 'msg' => "ok");
        } else {
            $arrResponse = array('status' => false, 'msg' => $requestUser);
        }
        return $arrResponse;
    }
}
