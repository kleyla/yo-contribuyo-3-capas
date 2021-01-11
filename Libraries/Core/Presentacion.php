<?php
class Presentacion
{
    public function __construct()
    {
        // $this->views = new Views();
        $this->loadNegocio();
    }
    public function loadNegocio()
    {
        // HomeMode.php
        $vista = get_class($this);
        if ($vista != "Errors" && $vista != "Home" && $vista != "Dashboard" && $vista != "Register" && $vista != "Login") {
            // echo $vista;
            $negocio = $vista . "Negocio";
            // $negocio = ucfirst(get_class($this));
            // echo $negocio;
            $routClass = "Negocio/" . $negocio . ".php";
            // echo $routClass;
            if (file_exists($routClass)) {
                require_once($routClass);
                $this->negocio = new $negocio();
                // echo "Negocio";
            } else {
                echo "No existe el negocio";
            }
        }
    }
    public function getView($view, $data = "")
    {
        $view = VIEWS  . $view . ".php";
        // echo $view;
        require_once($view);
    }
}
