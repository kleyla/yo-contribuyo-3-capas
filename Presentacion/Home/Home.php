<?php

class Home extends Presentacion
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home($params)
    {
        // echo "mensaje desde la presentacion";
        session_start();
        $data["tag_name"] = "Home";
        $data["page_title"] = "Pagina principal";
        $data["page_name"] = "home";
        $arrData = $this->negocio->proyectos();
        $data["proyectos"] = $arrData;
        $arrData = $this->negocio->articulos();
        $data["articulos"] = $arrData;
        // dep($data);
        $this->views->getView($this, "home", $data);
    }
   
    public function proyectos()
    {
        session_start();
        $data["tag_name"] = "Proyectos";
        $data["page_title"] = "Ver Proyectos";
        $data["page_name"] = "proyectos";
        $arrData = $this->negocio->proyectos();
        $data["proyectos"] = $arrData;
        // dep($data);
        $this->views->getView($this, "verProyectos", $data);
    }

    public function articulos()
    {
        session_start();
        // echo "mensaje desde el controlador";
        $data["tag_name"] = "Articulos";
        $data["page_title"] = "Ver Articulos";
        $data["page_name"] = "articulos";
        $arrData = $this->negocio->articulos();
        $data["articulos"] = $arrData;
        $this->views->getView($this, "verArticulos", $data);
    }
    public function verArticulo($id)
    {
        if (intval($id) > 0) {
            session_start();
            $data["tag_name"] = "Articulo";
            $data["page_title"] = "Ver Articulo";
            $data["page_name"] = "articulo";
            $data['script'] = 'denuncia.js';
            $arrData = $this->negocio->getArticulo($id);
            $data["articulo"] = $arrData;
            $this->views->getView($this, "verArticulo", $data);
        }
    }
    public function verProyecto($id)
    {
        if (intval($id) > 0) {
            session_start();
            $data["tag_name"] = "Proyecto";
            $data["page_title"] = "Ver Proyecto";
            $data["page_name"] = "proyectos";
            $data['script'] = 'acciones.js';
            $arrData = $this->negocio->getProyecto($id);
            $data["proyecto"] = $arrData;
            // dep($data);
            $this->views->getView($this, "verProyecto", $data);
        }
    }
    public function exa()
    {
        $this->negocio->exa();
    }
}
