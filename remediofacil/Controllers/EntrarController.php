<?php
namespace Controllers;

use Core\Controller;

class EntrarController extends Controller
{
    public function index()
    {
        header("Location: http://localhost/source/meu.remediofacil/");
        exit;
    }
}