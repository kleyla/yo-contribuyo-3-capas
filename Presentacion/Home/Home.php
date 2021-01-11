<?php

class Home extends Presentacion
{
    public function __construct()
    {
        parent::__construct();
        require_once("Negocio/ProyectoNegocio.php");
        $this->proyecto = new ProyectoNegocio();
        require_once("Negocio/ArticuloNegocio.php");
        $this->articulo = new ArticuloNegocio();
    }

    public function home($params)
    {
        // echo "mensaje desde la presentacion";
        session_start();
        $data["tag_name"] = "Home";
        $data["page_title"] = "Pagina principal";
        $data["page_name"] = "home";
        $arrData = $this->proyecto->getProyectosHome();
        $data["proyectos"] = $arrData;
        $arrData = $this->articulo->getArticulosHome();
        $data["articulos"] = $arrData;
        // dep($data);
        $this->getView("Home/homes", $data);
    }

    public function proyectos()
    {
        session_start();
        $data["tag_name"] = "Proyectos";
        $data["page_title"] = "Ver Proyectos";
        $data["page_name"] = "proyectos";
        $arrData = $this->proyecto->getProyectosHome();
        $data["proyectos"] = $arrData;
        // dep($data);
        $this->getView("Proyecto/verProyectos", $data);
    }

    public function articulos()
    {
        session_start();
        // echo "mensaje desde el controlador";
        $data["tag_name"] = "Articulos";
        $data["page_title"] = "Ver Articulos";
        $data["page_name"] = "articulos";
        $arrData = $this->articulo->getArticulosHome();
        $data["articulos"] = $arrData;
        $this->getView("Articulo/verArticulos", $data);
    }
    public function verArticulo($id)
    {
        if (intval($id) > 0) {
            session_start();
            $data["tag_name"] = "Articulo";
            $data["page_title"] = "Ver Articulo";
            $data["page_name"] = "articulo";
            $data['script'] = 'Denuncia/denuncias.js';
            $arrData = $this->articulo->getArticuloHome($id);
            $data["articulo"] = $arrData;
            $this->getView("Articulo/verArticulo", $data);
        }
    }
    public function verProyecto($id)
    {
        if (intval($id) > 0) {
            session_start();
            $data["tag_name"] = "Proyecto";
            $data["page_title"] = "Ver Proyecto";
            $data["page_name"] = "proyectos";
            $data['script'] = 'Accion/acciones.js';
            $arrData = $this->proyecto->getProyectoHome($id);
            $data["proyecto"] = $arrData;
            // dep($data);
            $this->getView("Proyecto/verProyecto", $data);
        }
    }
}
