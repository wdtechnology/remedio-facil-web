<?php
require 'config/config.php';
require 'config/suporte.php';
require 'routers.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();
