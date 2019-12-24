<?php
namespace Controllers;

use Core\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $data = array();
        $this->loadTemplate('404', $data);
    }
}