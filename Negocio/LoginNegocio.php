<?php

class LoginNegocio
{
    private $usuario;

    public function __construct()
    {
        require_once("Dato/UsuarioDato.php");
        $this->usuario = new UsuarioDato();
    }
    public function loginUser($strEmail, $strPass)
    {
        $this->usuario->setEmail($strEmail);
        $this->usuario->setPassword($strPass);
        $requestUser = $this->usuario->getUsuarioLogin();
        if (empty($requestUser)) {
            $arrResponse = array('status' => false, 'msg' => "El usuario o la contrasena es incorrecto");
        } else {
            $arrData = $requestUser;
            if ($arrData['estado'] == 1) {
                $_SESSION['idUser'] = $arrData['id_usuario'];
                $_SESSION['login'] = true;
                $this->usuario->setId($_SESSION['idUser']);
                $arrData = $this->usuario->sessionLogin();
                $_SESSION['userData'] = $arrData;
                $arrResponse = array('status' => true, 'msg' => "ok");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Usuario inactivo");
            }
        }
        return $arrResponse;
    }
}
