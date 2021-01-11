<?php

class Dashboard extends Presentacion
{

    function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . 'login');
        }
    }
    public function dashboard()
    {
        $data["page_id"] = 2;
        $data["page_tag"] = "Dashboard";
        $data["page_title"] = "Dashboard - Tienda";
        $data["page_name"] = "dashboard";
        $data["nav_dash"] = "active";
        $this->getView("Dashboard/dashboards", $data);
    }
}
