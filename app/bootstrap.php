<?php

require COREPATH.'ClassLoader.php';

$loader = new ClassLoader();
$loader->registerDir(COREPATH);
$loader->registerDir(APPPATH.'models');
$loader->registerDir(APPPATH.'controllers');
$loader->registerDir(APPPATH.'views');
$loader->register();
