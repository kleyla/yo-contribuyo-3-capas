<?php
class Controllers
{
    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }
    public function loadModel()
    {
        // HomeMode.php
        $model = get_class($this)."Model";
        // $model = ucfirst(get_class($this));
        // echo $model;
        $routClass = "Models/" . $model . ".php";
        if (file_exists($routClass)) {
            require_once($routClass);
            $this->model = new $model();
        }else{
            // echo "No existe el modelo";
        }
    }
}
