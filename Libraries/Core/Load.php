<?php
$presentacion = ucwords($presentacion);
$presentacionFile = "Presentacion/" . $presentacion . "/" . $presentacion . ".php";
// echo $presentacionFile;
// echo $presentacion;
if (file_exists($presentacionFile)) {
    // echo $method;
    require_once($presentacionFile);
    $presentacion = new $presentacion();
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
