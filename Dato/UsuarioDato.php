<?php

class UsuarioDato extends Mysql
{
    private $intId;
    private $strNick;
    private $strEmail;
    private $strPassword;
    private $intEstado;
    private $strRol;
    private $fecha;

    public function __construct()
    {
        parent::__construct();
    }
    public function setId(int $id)
    {
        $this->intId = $id;
    }
    public function setNick(string $nick)
    {
        $this->strNick = $nick;
    }
    public function setEmail(string $email)
    {
        $this->strEmail = $email;
    }
    public function setPassword(string $pass)
    {
        $this->strPassword = $pass;
    }
    public function setRol(string $rol)
    {
        $this->strRol = $rol;
    }
    public function all()
    {
        $sql = "SELECT * FROM usuarios";
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertUsuario()
    {
        try {
            $return = "";
            $sql = "SELECT * FROM usuarios WHERE nick = '$this->strNick' OR email = '$this->strEmail'";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $query_insert = "INSERT INTO usuarios(nick, email, pass, rol) VALUES (?,?,?,?)";
                $arrData = array($this->strNick, $this->strEmail, $this->strPassword, $this->strRol);
                $request_insert = $this->insert($query_insert, $arrData);
                $return = $request_insert;
                return $return;
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return $return = "exist";
        }
    }
    public function selectUsuario(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
    public function updateUsuario()
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE (nick = '$this->strNick' OR email = '$this->strEmail') AND id_usuario != $this->intId";
            $request = $this->select_all($sql);
            if (empty($request)) {
                $sql = "UPDATE usuarios SET nick = ?, email = ?, pass = ?, rol = ? WHERE id_usuario = $this->intId";
                $arrData = array($this->strNick, $this->strEmail, $this->strPassword, $this->strRol);
                $request = $this->update($sql, $arrData);
                return $request;
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return  $request = "exist";
        }
    }
    public function disableUsuario()
    {
        try {
            $sql = "UPDATE usuarios SET estado = ? WHERE id_usuario = $this->intId";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if ($request) {
                return $request = "ok";
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return $request = "error";
        }
    }
    public function enableUsuario()
    {
        try {
            $sql = "UPDATE usuarios SET estado = ? WHERE id_usuario = $this->intId";
            $arrData = array(1);
            $request = $this->update($sql, $arrData);
            if ($request) {
                return $request = "ok";
            } else {
                throw new Exception("error");
            }
        } catch (Exception $e) {
            return $request = "error";
        }
    }
    public function getUsuarioLogin()
    {
        $sql = "SELECT id_usuario, estado FROM usuarios 
                WHERE email = '$this->strEmail' and pass = '$this->strPassword'";
        $request = $this->select($sql);
        return $request;
    }
    public function sessionLogin()
    {
        $sql = "SELECT usuarios.nick, usuarios.email, usuarios.estado, usuarios.rol, usuarios.fecha FROM usuarios
                WHERE id_usuario = $this->intId";
        $request = $this->select($sql);
        return $request;
    }
}
