<?php

require_once(dirname(__FILE__) . "/../models/item.php");
require_once(dirname(__FILE__) . "/../views/view.php");

class ItemsController
{

    protected $_item;

    public function __construct()
    {
        $this->_item = new ItemModel();
    }

    /**
     * 商品詳細API /items
     */
    public function action_detail($params)
    {
        $format = $this->getformat($params);
        $content_data = $this->_item->getContentData($params);

        $view   = new View;
        $view->render('detail', $format, $content_data);
    }

    /**
     * 商品検索API /items
     */
    public function action_search($params)
    {
        $format = $this->getformat($params);
        $content_data = $this->_item->getContentData($params);

        $view = new View;
        $view->render('search', $format, $content_data);
    }

    /**
     * error action 
     */
    public function action_error($params) {
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

    public function getformat($request_params)
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
}