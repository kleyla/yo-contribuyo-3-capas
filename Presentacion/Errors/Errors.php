<?php

class Errors extends Presentacion
{
    public function __construct()
    {
        // echo "Parent error";
        parent::__construct();
    }

    public function notFound()
    {
        // echo "error";
        $this->getView("Errors/errores");
    }
}

$notFound = new Errors();
$notFound->notFound();
