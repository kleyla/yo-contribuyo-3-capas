<?php

class AccionNegocio extends Negocio
{
    public function __construct()
    {
        parent::__construct();
    }
    public function setComentario()
    {
        $strComentario = strClean($_POST["txtComentario"]);
        $request = $this->model->insertComentario($strComentario);
    }
}
