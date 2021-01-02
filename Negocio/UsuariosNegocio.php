<?php

class UsuariosNegocio extends Negocio
{

    function __construct()
    {
        parent::__construct();
    }
    public function getUsuarios()
    {
        $arrData = $this->dato->all();
        // dep($arrData);
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]["estado"] == 1) {
                $arrData[$i]["estado"] = '<span class="badge badge-success">Activo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-primary btn-sm btnEditUsuario" rl="' . $arrData[$i]['id_usuario'] . '" title="Editar" ><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-sm btnDelUsuario" rl="' . $arrData[$i]['id_usuario'] . '" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            } else {
                $arrData[$i]["estado"] = '<span class="badge badge-danger">Inactivo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-primary btn-sm btnEditUsuario" rl="' . $arrData[$i]['id_usuario'] . '" title="Editar" ><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-warning btn-sm btnEnableUsuario" rl="' . $arrData[$i]['id_usuario'] . '" title="Habilitar" ><i class="fa fa-unlock"></i></button>
                    </div>';
            }
        }
        return $arrData;
    }
    public function setUsuario(int $intIdUsuario, string $strNick, string $strEmail, string $strPass, string $strRol)
    {
        $strPass = hash("SHA256", $strPass);
        $this->dato->setNick($strNick);
        $this->dato->setEmail($strEmail);
        $this->dato->setPassword($strPass);
        $this->dato->setRol($strRol);

        if ($intIdUsuario == 0) {
            // Crear
            $request_usuario = $this->dato->insertUsuario();
            $option = 1;
            // echo json_encode($request_usuario);
        } else {
            // Update
            $this->dato->setId($intIdUsuario);
            $request_usuario = $this->dato->updateUsuario();
            $option = 2;
        }
        // dep($_POST);
        if ($request_usuario === "exist") {
            $arrResponse = array('status' => false, 'msg' => "Atencion! El usuario ya existe");
        } else if ($request_usuario > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => true, 'msg' => "Datos actualizados correctamente");
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => "No es posible almacenar datos");
        }
        return $arrResponse;
    }
    public function getUsuario(int $id)
    {
        $arrData = $this->dato->selectUsuario($id);
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => "Datos no encontrados.");
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        return $arrResponse;
    }
    public function deleteUsuario(int $idUsuario)
    {
        $this->dato->setId($idUsuario);
        $requestDelete = $this->dato->disableUsuario();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha eliminado el Usuario");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar el Usuario.");
        }
        return $arrResponse;
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
