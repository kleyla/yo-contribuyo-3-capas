<?php

class FavoritoNegocio extends Negocio
{
    public $accion;

    public function __construct()
    {
        parent::__construct();
        require_once("Dato/AccionDato.php");
        $this->accion = new AccionDato();
    }
    public function getFavoritos()
    {
        $arrData = $this->dato->all();
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]["opciones"] = '<div class="text-center">
                        <a class="btn btn-secondary btn-sm" href="' . base_url() . 'home/verProyecto/' . $arrData[$i]['id_proyecto'] . '" target="_blank" title="Ver" ><i class="fa fa-eye"></i></a>
                    </div>';
        }
        return $arrData;
    }
    public function setFavoritos(int $intIdProyecto, int $intFavorito)
    {
        try {
            if ($intFavorito == 1) {
                $this->accion->setUsuarioId($_SESSION['idUser']);
                $this->accion->setProyectoId($intIdProyecto);
                $accionId = $this->accion->insertAccion();
                $this->dato->setAccionId($accionId);
                $request = $this->dato->insertFavorito();
            } else {
                $accion_id = $this->dato->existeFavorito($intIdProyecto);
                if ($accion_id > 0) {
                    // FAVORITO
                    $this->dato->setAccionId($accion_id);
                    $request_delete = $this->dato->deleteFavorito();
                    // ACCION
                    $this->accion->setId($accion_id);
                    $request_delete = $this->accion->deleteAccion();
                    $request = $accion_id;
                } else {
                    $request = 0;
                }
            }
            // dep($request);
            if (intval($request) > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "No es posible almacenar datos");
            }
            return $arrResponse;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
