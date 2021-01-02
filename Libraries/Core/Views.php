<?php

class Views
{
    public function getView($presentacion, $view, $data = "")
    {
        // echo $presentacion;
        $presentacion = get_class($presentacion);

        $view = VIEWS . $presentacion . "/" . $view . ".php";

        // echo $view;
        require_once($view);
    }
}
