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
        //Viewに渡す変数を設定
        $content_data = $this->_item->getContentData($params);

        $view   = new View;
        $view->render('detail.' . $format, $content_data);
    }

    /**
     * 商品検索API /items
     */
    public function action_search($params)
    {
        //Viewに渡す変数を設定
        $content_data = $this->_item->getContentData($params);

        $view = new View;
        $format = (isset($params['format']))? $params['format']:'json';
        $view->render('search.' . $format, $content_data);
    }

    /**
     * error action 
     */
    public function action_error($params) {

        $error_code    = $params['status']['code'];
        $error_message = $params['status']['message'];

        switch($error_code){
            case '400':
                header("HTTP/1.1 400 Bad Request");
                break;
            case '404':
                header("HTTP/1.1 404 Not Found");
                break;
            case '400':
                header("HTTP/1.1 406 Not Acceptable");
                break;
            case '500':
                header("HTTP/1.1 500 Internal Servr Error");
                break;
        }

        require '../app/views/items/error.json.php';
    }
}