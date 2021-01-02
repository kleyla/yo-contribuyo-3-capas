<?php

class Views
{
    public function getView($presentacion, $view, $data = "")
    {
        $presentacion = get_class($presentacion);
        // echo $presentacion;
        $view = VIEWS . $presentacion . "/" . $view . ".php";

        // echo $view;
        require_once($view);
    }
}
