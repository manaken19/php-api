<?php

require './../app/core/ClassLoader.php';

$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__).'/../app/core');
$loader->registerDir(dirname(__FILE__).'/../app/models');
$loader->register();
