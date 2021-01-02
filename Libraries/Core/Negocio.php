<?php
class Negocio
{
    public function __construct()
    {
        // echo "Desde Negocio";
        // $this->views = new Views();
        $this->loadDato();
    }
    public function loadDato()
    {
        // HomeMode.php
        $dato = explode('Negocio', get_class($this));
        $dato = $dato[0] . "Dato";
        // $dato = ucfirst(get_class($this));
        // echo $dato;
        $routClass = "Dato/" . $dato . ".php";
        if (file_exists($routClass)) {
            require_once($routClass);
            $this->dato = new $dato();
        } else {
            echo "No existe el Dato";
        }
    }
}
