<?php

require COREPATH . 'ClassLoader.php';

$loader = new ClassLoader(array(
    'Core'  => COREPATH,
    'Model' => APPPATH . 'models',
));

$loader->register();
