<?php

class ComentarioNegocio extends Negocio
{
    public $accion;

    public function __construct()
    {
        parent::__construct();
        require_once("Dato/AccionDato.php");
        $this->accion = new AccionDato();
    }
    public function setComentario(int $intIdProyecto, string $strComentario)
    {
        try {
            // ACCION
            $this->accion->setProyectoId($intIdProyecto);
            $this->accion->setUsuarioId($_SESSION['idUser']);
            $accionId = $this->accion->insertAccion();
            // COMENTARIO
            $this->dato->setAccionId($accionId);
            $this->dato->setContenido($strComentario);
            $request = $this->dato->insertComentario();
            // dep($request);
            if ($request > 0) {
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
