<?php

class ProyectosNegocio extends Negocio
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProyectos()
    {
        if ($_SESSION['userData']['rol'] == "Administrador") {
            $arrData = $this->dato->all();
        } else {
            $arrData = $this->dato->allByUser();
        }
        // dep($arrData);
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]["estado"] == 1) {
                $arrData[$i]["estado"] = '<span class="badge badge-success">Activo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <a class="btn btn-secondary btn-sm" href="' . base_url() . 'home/verProyecto/' . $arrData[$i]['id_proyecto'] . '" target="_blank" title="Ver" ><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-sm" href="' . base_url() . 'proyectos/form/' . $arrData[$i]['id_proyecto'] . '" rl="" title="Editar" ><i class="fa fa-pencil"></i></a>
                        <button class="btn btn-danger btn-sm btnDelProyecto" rl="' . $arrData[$i]['id_proyecto'] . '" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            } else {
                $arrData[$i]["estado"] = '<span class="badge badge-danger">Inactivo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <a class="btn btn-secondary btn-sm" href="' . base_url() . 'home/verProyecto/' . $arrData[$i]['id_proyecto'] . '" target="_blank" title="Ver" ><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-sm" href="' . base_url() . 'proyectos/form/' . $arrData[$i]['id_proyecto'] . '" rl="" title="Editar" ><i class="fa fa-pencil"></i></a>
                        <button class="btn btn-warning btn-sm btnEnableProyecto" rl="' . $arrData[$i]['id_proyecto'] . '" title="Habilitar" ><i class="fa fa-unlock"></i></button>
                    </div>';
            }
        }
        return $arrData;
    }
    public function form($id = 0)
    {
        $data["page_id"] = 1;
        $data["page_tag"] = "Proyectos";
        $data["page_title"] = "Proyectos - Formulario";
        $data["page_name"] = "proyectos";
        $data["script"] = "js/functions_proyectos_nuevo.js";
        $lenguajes = $this->model->allActive();
        $data["lenguajes"] = $lenguajes;
        $data["id_proyecto"] = $id;
        // dep($lenguajes);
        $this->views->getView($this, "form", $data);
    }
    public function setProyecto(int $intIdProyecto, string $strNombre, string $strDescripcion, string $strRepositorio, array $arrayLenguajes, string $strTags)
    {
        $this->dato->setNombre($strNombre);
        $this->dato->setDescripcion($strDescripcion);
        $this->dato->setRepositorio($strRepositorio);
        $this->dato->setTags($strTags);
        $this->dato->setLenguajes($arrayLenguajes);
        $this->dato->setUsuarioId($_SESSION['idUser']);

        if ($intIdProyecto == 0) {
            // Crear
            $request_proyecto = $this->dato->insertProyecto();
            $option = 1;
            // echo json_encode($request_proyecto);
        } else {
            // Update
            $this->dato->setId($intIdProyecto);
            $request_proyecto = $this->dato->updateProyecto();
            $option = 2;
        }
        // dep($_POST);
        if ($request_proyecto === "exist") {
            $arrResponse = array('status' => false, 'msg' => "Atencion! El proyecto ya existe");
        } else if (intval($request_proyecto) > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => true, 'msg' => "Datos actualizados correctamente");
            }
        } else {
            // $arrResponse = array('status' => false, 'msg' => "No es posible almacenar datos");
            $arrResponse = array('status' => false, 'msg' => $request_proyecto);
        }

        return $arrResponse;
    }
    public function getProyecto(int $id)
    {
        $this->dato->setId($id);
        $arrData = $this->dato->selectProyecto();
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => "Datos no encontrados.");
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        return $arrResponse;
    }
    public function deleteProyecto(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->disableProyecto();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha eliminado el Proyecto");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar el Proyecto.");
        }
        return $arrResponse;
    }
    public function habilitarProyecto(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->enableProyecto();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha habilitado el Proyecto");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al habilitado el Proyecto.");
        }
        return $arrResponse;
    }
    public function getActiveLenguajes()
    {
        return $this->dato->allActiveLenguajes();
    }
}
