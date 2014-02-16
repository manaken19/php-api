<?php

namespace Model;

/**
 * Item Model.
 *
 * @author Yosuke Ohshima
 */
class Items extends \Core\Model
{

    public function Items($request_params)
    {
        $content_data = array();
        $params = array();

        foreach ($request_params as $key => $value) {
            switch ($key) {
                case 'category' :
                case 'price_min':
                case 'price_max':
                case 'sort':
                case 'count_per_page':
                case 'page_number':
                case 'q':
                    $params[$key] = $value;
                    break;
                default :
                    break;
            }
        }

        $content_data  = $this->getData($params);

        $response_array['result'] = array(
            'requested' => array(
                    'parameter' => $request_params,
                    'timestamp' => time()
            ),
            'item_count' => count($content_data),
            'items' => $content_data
        );
        $content_data = json_encode($response_array);

        return $content_data;

    }

    public function ItemDetail($id)
    {
        $db    = new Database;

        $where_str = "WHERE id = :id";
        $placeholders = array();
        $placeholders[':id'] = $id;
        $sql  = "SELECT * FROM item {$where_str}";
        $content_data = $db->fetchAll($sql, $placeholders);

        $parent_category_id = $content_data[0]['category_id'];
        $where_str = "WHERE parent_id = :parent_id";
        $sql  = "SELECT * FROM categories {$where_str}";
        $placeholders = array();
        $placeholders[':parent_id'] = $parent_category_id;
        $child_category_id = $db->fetchAll($sql, $placeholders);

        $response_array['result'] = array(
            'requested' => array(
                    'parameter' => $id,
                    'timestamp' => time()
            ),
            'item_count' => count($content_data),
            'items' => $content_data,
            'category_info' => array(
                'parent_category_id'  => $parent_category_id,
                'child_category_id' => $child_category_id
            )
        );
        $content_data = json_encode($response_array);

        return $content_data;

    }

    public function Categories()
    {
        $placeholders = array();
        $db           = new Database;
        $sql          = "select * from categories";
        $content_data = $db->fetchAll($sql, $placeholders);

        $response_array['result'] = array(
            'requested' => array(
                    'parameter' => null,
                    'timestamp' => time()
            ),
            'item_count' => count($content_data),
            'items'      => $content_data
        );
        $content_data = json_encode($response_array);

        return $content_data;

    }

    private function getData($params)
    {

        $placeholders = array();

        $where_array = '';
        $where_str   = ''; //WHERE 部分
        $order_str   = ''; //ORDER BY 部分
        $limit_str   = ''; //LIMT 部分
        $offset_str  = ''; //OFFSET 部分
        $like_str    = '';


        //WHERE文の指定
        $where_flg = false;
        if (!empty($params['category'])) {
            $where_array[] = 'category = :category';
            $placeholders[':category'] = $params['category'];
            $where_flg = true;
        }
        if (!empty($params['price_min'])) {
            $where_array[] = 'price >= :price_min';
            $placeholders[':price_min'] = $params['price_min'];
            $where_flg = true;
        }
        if (!empty($params['price_max'])) {
            $where_array[] = 'price <= :price_max';
            $placeholders[':price_max'] = $params['price_max'];
            $where_flg = true;
        }

        if ($where_flg === true) { 
            $where_str = implode(' AND ', $where_array);
        } else {
            $where_str = '';
        }
        if (! count($where_array)) {
            $where_str = " WHERE " . $where_str;
        }

        //ORDER BY 部分の指定
        if (! empty($params['sort'])) {
            switch ($params['sort']) {
                case 'id_asc' :
                    $order_str = "ORDER BY id ASC";
                    break;
                case 'id_desc' :
                    $order_str = "ORDER BY id DESC";
                    break;
                case 'price_asc' :
                    $order_str = "ORDER BY price ASC";
                    break;
                case 'price_desc' :
                    $order_str = "ORDER BY price DESC";
                    break;
            }
        }

        if (! empty($params['count_per_page']) && !empty($params['page_number'])) {

            $limit_str = "LIMIT :limit_count";
            $placeholders[':limit_count'] = $params['count_per_page'];

            $offset_str = "OFFSET :offset_count";
            $placeholders[':offset_count'] = $params['count_per_page'] * ($params['page_number'] - 1);
        } else {

            $limit_str = "LIMIT :limit_count";
            $placeholders[':limit_count'] = 100;

        }

        if (! empty($params['q'])) {
            $like_str = "WHERE title LIKE :query";
            $placeholders[':query'] = "%".$params['q']."%";
        }

        $sql  = "SELECT * FROM item {$where_str} {$like_str} {$order_str} {$limit_str} {$offset_str}";

        $db    = new Database;

        $items = $db->fetchAll($sql, $placeholders);

        return $items;
    }

}
