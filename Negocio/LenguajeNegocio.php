<?php

class LenguajeNegocio extends Negocio
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
        parent::__construct();
    }

    public function getLenguajes()
    {
        $arrData = $this->dato->all();
        // dep($arrData);
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]["estado"] == 1) {
                $arrData[$i]["estado"] = '<span class="badge badge-success">Activo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-primary btn-sm" onclick="editLenguaje(' . $arrData[$i]['id_lenguaje'] . ')" title="Editar" ><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteLenguaje(' . $arrData[$i]['id_lenguaje'] . ')" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            } else {
                $arrData[$i]["estado"] = '<span class="badge badge-danger">Inactivo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-primary btn-sm" onclick="editLenguaje(' . $arrData[$i]['id_lenguaje'] . ')" title="Editar" ><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-warning btn-sm" onclick="enableLenguaje(' . $arrData[$i]['id_lenguaje'] . ')" title="Habilitar" ><i class="fa fa-unlock"></i></button>
                    </div>';
            }
        }
        // dep($arrData);
        return $arrData;
    }
    public function setLenguaje(int $intIdLenguaje, string $strNombre, string $strLink)
    {
        $this->dato->setNombre($strNombre);
        $this->dato->setLink($strLink);
        if ($intIdLenguaje == 0) {
            // Crear
            $request_lenguaje = $this->dato->insertLenguaje();
            $option = 1;
            // echo json_encode($request_lenguaje);
        } else {
            // Update
            $this->dato->setId($intIdLenguaje);
            $request_lenguaje = $this->dato->updateLenguaje();
            $option = 2;
        }
        // dep($_POST);
        if ($request_lenguaje === "exist") {
            $arrResponse = array('status' => false, 'msg' => "Atencion! El lenguaje ya existe");
        } else if ($request_lenguaje > 0) {
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
    public function getLenguaje(int $id)
    {
        $this->dato->setId($id);
        $arrData = $this->dato->selectLenguaje();
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => "Datos no encontrados.");
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        return $arrResponse;
    }
    public function deleteLenguaje(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->disableLenguaje();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha eliminado el Lenguaje");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar el Lenguaje.");
        }
        return $arrResponse;
    }
    public function habilitarLenguaje(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->enableLenguaje();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha habilitado el Lenguaje");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al habilitar el Lenguaje.");
        }
        return $arrResponse;
    }
    public function getActiveLenguajes()
    {
        return $this->dato->allActiveLenguajes();
    }
}
