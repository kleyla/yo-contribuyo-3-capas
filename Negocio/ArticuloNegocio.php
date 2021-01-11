<?php

class ArticuloNegocio extends Negocio
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getArticulos()
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
                        <a class="btn btn-secondary btn-sm" href="' . base_url() . 'home/verArticulo/' . $arrData[$i]['id_articulo'] . '" target="_blank" title="Ver" ><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-sm" href="' . base_url() . 'articulo/form/' . $arrData[$i]['id_articulo'] . '" rl="" title="Editar" ><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-info btn-sm" href="' . base_url() . 'denuncia/verDenuncias/' . $arrData[$i]['id_articulo'] . '" title="Ver denuncias" ><i class="fa fa-comment"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="deleteArticulo(' . $arrData[$i]['id_articulo'] . ')" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            } else if ($arrData[$i]["estado"] == 2) {
                $arrData[$i]["estado"] = '<span class="badge badge-info">Borrador</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <a class="btn btn-secondary btn-sm" href="' . base_url() . 'home/verArticulo/' . $arrData[$i]['id_articulo'] . '" target="_blank" title="Ver" ><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-sm" href="' . base_url() . 'articulo/form/' . $arrData[$i]['id_articulo'] . '" rl="" title="Editar" ><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-info btn-sm" href="' . base_url() . 'denuncia/verDenuncias/' . $arrData[$i]['id_articulo'] . '" title="Ver denuncias" ><i class="fa fa-comment"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="deleteArticulo(' . $arrData[$i]['id_articulo'] . ')" title="Eliminar" ><i class="fa fa-trash"></i></button>
                    </div>';
            } else {
                $arrData[$i]["estado"] = '<span class="badge badge-danger">Inactivo</span>';
                $arrData[$i]["opciones"] = '<div class="text-center">
                        <button class="btn btn-secondary btn-sm btnShowArticulo" rl="' . $arrData[$i]['id_articulo'] . '" title="Permisos" ><i class="fa fa-eye"></i></button>
                        <a class="btn btn-primary btn-sm" href="' . base_url() . 'articulo/form/' . $arrData[$i]['id_articulo'] . '" rl="" title="Editar" ><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-info btn-sm" href="' . base_url() . 'denuncia/verDenuncias/' . $arrData[$i]['id_articulo'] . '" target="_blank" title="Ver denuncias" ><i class="fa fa-comment"></i></a>
                        <button class="btn btn-warning btn-sm" onclick="enableArticulo(' . $arrData[$i]['id_articulo'] . ')" title="Habilitar" ><i class="fa fa-unlock"></i></button>
                    </div>';
            }
        }
        // dep($arrData);
        return $arrData;
    }
    public function setArticulo(int $intIdArticulo, string $strTitulo, string $strContenido, int $intStatus)
    {
        $this->dato->setTitulo($strTitulo);
        $this->dato->setContenido($strContenido);
        $this->dato->setUsuarioId($_SESSION['idUser']);
        $this->dato->setEstado($intStatus);

        if ($intIdArticulo == 0) {
            // Crear
            $request_articulos = $this->dato->insertArticulo();
            $option = 1;
            // echo json_encode($request_articulos);
        } else {
            // Update
            $this->dato->setId($intIdArticulo);
            $request_articulos = $this->dato->updateArticulo();
            $option = 2;
        }
        // dep($_POST);
        if ($request_articulos === "exist") {
            $arrResponse = array('status' => false, 'msg' => "Atencion! El Articulo existe");
        } else if (intval($request_articulos) > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => true, 'msg' => "Datos actualizados correctamente");
            }
        } else {
            // $arrResponse = array('status' => false, 'msg' => "No es posible almacenar datos");
            $arrResponse = array('status' => false, 'msg' => $request_articulos);
        }
        return $arrResponse;
    }
    public function getArticulo(int $id)
    {
        $this->dato->setId($id);
        $arrData = $this->dato->selectArticulo();
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => "Datos no encontrados.");
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        return $arrResponse;
    }
    public function deleteArticulo(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->disableArticulo();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha eliminado el Articulo");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar el Articulo.");
        }
        return $arrResponse;
    }
    public function habilitarArticulo(int $id)
    {
        $this->dato->setId($id);
        $requestDelete = $this->dato->enableArticulo();
        if ($requestDelete === "ok") {
            $arrResponse = array('status' => true, 'msg' => "Se ha habilitado el Articulo");
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al habilitado el Articulo.");
        }
        return $arrResponse;
    }
    public function getArticulosHome()
    {
        return $this->dato->getActiveArticulos();
    }
    public function getArticuloHome(int $id)
    {
        $this->dato->setId($id);
        return $this->dato->getArticulo();
    }
}
