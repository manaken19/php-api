<?php

namespace Core;

/**
 * Base Controller Class.
 *
 * @author Yosuke Ohshima
 */
class Controller
{

    public function __construct()
    {
        $this->item     = new \Model\Item();
        $this->items    = new \Model\Items();
        $this->category = new \Model\Category();
        $this->request   = new \Core\Request();
        $this->view      = new \Core\View();
    }


    public function format($request_params)
    {
        if (! empty($request_params['format'])) {
            switch ($request_params['format']) {
                case 'xml':
                    $format = 'xml';
                    break;

                case 'json':
                default:
                    $format = 'json';
                    break;
            }
        } else {
            $format = 'json';
        }
        return $format;
    }

    public function param($method, $key)
    {
        return $this->format($key);
    }

    /**
     * This method returns all of the named parameters.
     *
     * @return  array
     */
    public function params($method, $keys)
    {
        return $this->request->params($method, $keys);
    }
}
