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
        $content_data = array();

        if (! empty($request_params['format'])) {
            switch ($request_params['format']) {
                case 'xml':
                    $content_data['format'] = 'xml';
                    break;

                case 'json':
                default:
                    $content_data['format'] = 'json';
                    break;
            }
        }

        $content_data['format']

        $params = $this->setParams($request_params);
        $items_data  = $this->getSqlQuery($params);



        return $items;

    }

    private function setParams($request_params)
    { 
        $params = $this->default_params;
        foreach ($request_params as $key => $value) {
            switch ($key) {
                case 'category_id' :
                case 'price_min':
                case 'price_max':
                case 'sort':
                case 'count_per_page':
                case 'page_number':
                    $params[$key] = $value;
                    break;
                default :
                    break;
            }
        }

        return $params;

    }

    private function getSqlQuery($params)
    {

        $placeholders = array();

        $where_array = array('TRUE');
        $where_str   = ''; //WHERE 部分
        $order_str   = ''; //ORDER BY 部分
        $limit_str   = ''; //LIMT 部分
        $offset_str  = ''; //OFFSET 部分


        //WHERE文の指定
        if (!empty($params['category_id'])) {
            $where_array[] = 'category_id = :category_id';
            $placeholders[':category_id'] = $params['category_id'];
        }
        if (!empty($params['price_min'])) {
            $where_array[] = 'price >= :price_min';
            $placeholders[':price_min'] = $params['price_min'];
        }
        if (!empty($params['price_max'])) {
            $where_array[] = 'price <= :price_max';
            $placeholders[':price_max'] = $params['price_max'];
        }

        //$where_str = implode(' AND ', $where_array);

        //ORDER BY 部分の指定
        if (!empty($params['sort'])) {
            switch ($params['sort']) {
                case 'id_asc' :
                    $order_str = "ORDER BY product_id ASC";
                    break;
                case 'id_desc' :
                    $order_str = "ORDER BY product_id DESC";
                    break;
                case 'price_asc' :
                    $order_str = "ORDER BY price ASC";
                    break;
                case 'price_desc' :
                    $order_str = "ORDER BY price DESC";
                    break;
            }
        }

        if (!empty($params['count_per_page']) && !empty($params['page_number'])) {

            $limit_str = "LIMIT :limit_count";
            $placeholders[':limit_count'] = $params['count_per_page'];

            $offset_str = "OFFSET :offset_count";
            $placeholders[':offset_count'] = $params['count_per_page'] * ($params['page_number'] - 1);
        }
        $sql = "SELECT * FROM items {$where_str} {$order_str} {$limit_str} {$offset_str}";

        $db     = new Database;
        $items = $db->fetchAll($sql, $placeholders);

        return $items;
    }

}