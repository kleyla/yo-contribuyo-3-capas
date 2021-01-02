<?php

class ProyectosNegocio extends Negocio
{
    private $proyectoLenguaje;
    public function __construct()
    {
        parent::__construct();
        require_once("Dato/ProyectoLenguajeDato.php");
        $this->proyectoLenguaje = new ProyectoLenguajeDato();
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
    public function setProyecto(int $intIdProyecto, string $strNombre, string $strDescripcion, string $strRepositorio, array $arrayLenguajes, string $strTags)
    {
        $this->dato->setNombre($strNombre);
        $this->dato->setDescripcion($strDescripcion);
        $this->dato->setRepositorio($strRepositorio);
        $this->dato->setTags($strTags);
        $this->dato->setUsuarioId($_SESSION['idUser']);
        // $this->dato->setLenguajes($arrayLenguajes);

        if ($intIdProyecto == 0) {
            // Crear
            $request_proyecto = $this->dato->insertProyecto();
            // PROYECTO LENGUAJE
            $this->proyectoLenguaje->setProyectoId($request_proyecto);
            foreach ($arrayLenguajes as $lenguaje => $value) {
                $this->proyectoLenguaje->setLenguajeId($value);
                $request_proyecto_lenguaje = $this->proyectoLenguaje->insertProyectoLenguaje();
            }
            $option = 1;
            // echo json_encode($request_proyecto);
        } else {
            // Update
            $this->dato->setId($intIdProyecto);
            $request_proyecto = $this->dato->updateProyecto();
            $this->proyectoLenguaje->setProyectoId($intIdProyecto);
            $this->proyectoLenguaje->deleteProyectoLenguaje();
            foreach ($arrayLenguajes as $lenguaje => $value) {
                $this->proyectoLenguaje->setLenguajeId($value);
                $request_proyecto_lenguaje = $this->proyectoLenguaje->insertProyectoLenguaje();
            }
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
        $this->proyectoLenguaje->setProyectoId($id);
        $arrlenguajes = $this->proyectoLenguaje->selectLenguajes();
        $arrData["lenguajes"] = $arrlenguajes;

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
