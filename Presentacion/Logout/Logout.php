<?php

class Logout extends Presentacion
{
    public function __construct()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ' . base_url() . 'login');
        // parent::__construct();
    }
}
