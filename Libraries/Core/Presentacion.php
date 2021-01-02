<?php
class Presentacion
{
    public function __construct()
    {
        $this->views = new Views();
        $this->loadNegocio();
    }
    public function loadNegocio()
    {
        // HomeMode.php
        $negocio = get_class($this) . "Negocio";
        // $negocio = ucfirst(get_class($this));
        // echo $negocio;
        $routClass = "Negocio/" . $negocio . ".php";
        if (file_exists($routClass)) {
            // echo $routClass;
            require_once($routClass);
            $this->negocio = new $negocio();
            // echo "Negocio";
        } else {
            echo "No existe el negocio";
        }
    }
}
