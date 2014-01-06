<?php

require_once (dirname(__FILE__) . "/../config/db.php");

class ItemModel
{
	//パラメーター定義
    protected $params = array(
                'format'         => 'json',
                'category_id'    => '',
                'price_min'      => '',
                'price_max'      => '',
                'sort'           => '',
                'count_per_page' => '',
                'page_number'    => ''
                );

    public function setContentData($request_params)
    {

        $dbconfig = new DbConfig;
        $dns = $dbconfig->config();
        try {
            //$pdo = new PDO('mysql:dbname=ohshimaapi;host=127.0.0.1');
            $pdo = new PDO($dns['dns']);
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }

        $sort = (isset($request_params['sort']))? $request_params['sort']:'';

        switch ($sort) {
            case 'asc':
                $stmt = $pdo->query('SELECT * FROM items ORDER BY product_id ASC');
                break;
            case 'desc':
                $stmt = $pdo->query('SELECT * FROM items ORDER BY product_id DESC');
                break;
            case 'price_asc':
                $stmt = $pdo->query('SELECT * FROM items ORDER BY price ASC');
                break;
            case 'price_desc':
                $stmt = $pdo->query('SELECT * FROM items ORDER BY price DESC');
                break;
            default:
                $stmt = $pdo->query('SELECT * FROM items');
                break;
        }
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $items;
    }
}
