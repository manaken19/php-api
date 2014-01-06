<?php

//require_once (dirname(__FILE__) . "/../config/db.php");

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
        try {
            $pdo = new PDO('mysql:dbname=ohshimaapi;host=127.0.0.1');
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
        $stmt = $pdo->query('SELECT * FROM items');
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }
}