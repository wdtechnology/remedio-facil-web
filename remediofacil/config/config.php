<?php
session_start();
require 'environment.php';

$config = array();

if(ENVIRONMENT == 'development') {
    define("BASE_URL", 'http://localhost/source/remediofacil/');
    $config['dbname'] = 'remedio_facil';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE_URL", 'http://localhost/source/remediofacil/');
    $config['dbname'] = 'remedio_facil';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}

global $db;

try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
    die;
    exit;
}