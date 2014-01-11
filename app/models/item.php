<?php

require_once (dirname(__FILE__) . "/../core/db.php");

class ItemModel
{
	//パラメーター定義
    private $default_params = array(
        'format'         => 'json',
        'category_id'    => '',
        'price_min'      => '',
        'price_max'      => '',
        'sort'           => '',
        'count_per_page' => '',
        'page_number'    => ''
    );

    public function getContentData($request_params)
    {

        $db     = new Database;

        $params = $this->setParams($request_params);

        $sql    = $this->getSqlQuery($params);

        $items = $db->fetchAll($sql, $placeholders);

        return $items;

    }

    private function setParams($request_params)
    { 
        $params = $this->default_params;

        foreach ($request_params as $key => $value) {
            switch ($key) {
                case 'format' :
                case 'category_id' :
                case 'price_min':
                case 'price_max':
                case 'sort':
                case 'count_per_page':
                case 'page_number':
                    $params[$key] = $value;
                    break;
                default :
                    return false;
                    break;
            }
        }

        return $params;
    }

    private function getSqlQuery($params)
    {
        $sort   = (isset($request_params['sort']))? $request_params['sort']:'';

        switch ($sort) {
            case 'asc':
                $sql = 'SELECT * FROM items ORDER BY product_id ASC';
                break;
            case 'desc':
                $sql = 'SELECT * FROM items ORDER BY product_id DESC';
                break;
            case 'price_asc':
                $sql = 'SELECT * FROM items ORDER BY price ASC';
                break;
            case 'price_desc':
                $sql = 'SELECT * FROM items ORDER BY price DESC';
                break;
            default:
                $sql = 'SELECT * FROM items';
                break;
        }

        $sql = "SELECT * FROM items {$where_str} {$order_str} {$limit_str} {$offset_str}";


        return $sql;
    }

}