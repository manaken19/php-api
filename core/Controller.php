<?php

namespace Core;

/**
 * Controller Class.
 *
 * @author Yosuke Ohshima
 */
class Controller
{

    protected $_item;

    public function __construct()
    {
        $this->_item     = new ItemModel();
        $this->_category = new CategoryModel();
    }

    /**
     * 商品詳細API /item
     */
    public function detail($params, $id = 1)
    {
        $format   = $this->format($params);
        $contents = $this->_item->ItemDetail($id);
        $view     = new View;
        $view->render('detail', $format, $contents);
    }

    /**
     * 商品検索API /items
     */
    public function search()
    {
        $format   = $this->format($params);
        $contents = $this->_item->Items($params);
        $view     = new View;
        $view->render('search', $format, $contents);
    }

    /**
     * カテゴリ一覧表示API /items
     */
    public function categories($params)
    {
        $format   = $this->format($params);
        $contents = $this->_item->Categories($params);
        $view     = new View;
        $view->render('search', $format, $contents);
    }

    public function categoriy_items($params, $category_id)
    {
        $format   = $this->format($params);
        $contents = $this->_category->Categories($category_id);
        $view     = new View;
        $view->render('search', $format, $contents);
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
}