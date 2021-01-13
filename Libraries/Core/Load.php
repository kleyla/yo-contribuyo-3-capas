<?php

function reload($presentacion, $method, $params)
{
    $presentacion = ucwords($presentacion);
    $presentacionFile = "Presentacion/" . $presentacion . "/" . $presentacion . ".php";
    // echo $presentacionFile;
    if (file_exists($presentacionFile)) {
        require_once($presentacionFile);
        // echo $presentacion;
        $presentacion = new $presentacion();
        // echo $method;
        if (method_exists($presentacion, $method)) {
            // echo "Existe";
            $presentacion->{$method}($params);
        } else {
            echo "No existe el metodo";
            require_once("Presentacion/Errors/Errors.php");
        }
    } else {
        echo "No existe negocio";
        require_once("Presentacion/Errors/Errors.php");
    }
}

reload($presentacion, $method, $params);
