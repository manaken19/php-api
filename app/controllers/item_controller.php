<?php

require_once(dirname(__FILE__) . "/../models/item.php");
require_once(dirname(__FILE__) . "/../views/view.php");

class ItemController
{

    protected $_item;

    public function __construct()
    {
        $this->_item = new ItemModel();
    }

    /**
     * 商品詳細API /items
     */
    public function item_detail($params)
    {
        //Viewに渡す変数を設定
        $content_data = $this->_item->setContentData($request_params);

        $view = new View;
        $format = (isset($params['format']))? $params['format']:'json';
        $view->render('detail.' . $format, $content_data);
    }

    /**
     * 商品検索API /items
     */
    public function item_search($params)
    {

        //Viewに渡す変数を設定
        $content_data = $this->_item->setContentData($params);

        $view = new View;
        $format = (isset($params['format']))? $params['format']:'json';
        $view->render('search.' . $format, $content_data);
    }

    /**
     * 404 page 
     */
    public function not_found($params)
    {
        $view = new View;
        $view->render('404');
    }
}