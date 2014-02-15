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
        $this->_item     = new \Model\Item();
        $this->_category = new \Model\Category();
        $this->request = $request;
    }

    /**
     * error action 
     */
    public function error($params) {
        echo "error!!!";exit;

        $error_code    = $params['status']['code'];
        $error_message = $params['status']['message'];

        switch($error_code){
            case '400':
                header("HTTP/1.1 400 Bad Request");
                break;
            case '404':
                header("HTTP/1.1 404 Not Found");
                break;
            case '406':
                header("HTTP/1.1 406 Not Acceptable");
                break;
            case '500':
                header("HTTP/1.1 500 Internal Servr Error");
                break;
        }
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

    public function param($param, $default = null)
    {
        return $this->request->param($param, $default);
    }

    /**
     * This method returns all of the named parameters.
     *
     * @return  array
     */
    public function params()
    {
        return $this->request->params();
    }
}