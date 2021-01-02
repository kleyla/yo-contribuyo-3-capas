<?php

class HomeNegocio extends Negocio
{
    public function __construct()
    {
        parent::__construct();
    }

    public function proyectos()
    {
        return $this->dato->getActiveProyects();
    }

    public function articulos()
    {
        return $this->dato->getActiveArticulos();
    }
    public function getArticulo($id)
    {
        return $this->dato->getArticulo($id);
    }
    public function getProyecto($id)
    {
        return $this->dato->getProyecto($id);
    }
}
