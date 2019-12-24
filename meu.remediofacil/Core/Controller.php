<?php
namespace Core;

class Controller
{

    public function __construct()
    {
        global $config;
    }

    public function loadView($viewName, $viewData)
    {
        extract($viewData);
        require 'Views/'.$viewName.'.php';
    }

    public function loadViewInTemplate($viewName, $viewData)
    {
        extract($viewData);
        require 'Views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData)
    {
        extract($viewData);
        require 'Views/template.php';
    }
}