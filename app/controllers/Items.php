<?php

namespace Controller;

/**
 * Items Controller.
 *
 * @author Yosuke Ohshima
 */
class Items extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 商品検索API /items
     */
    public function items()
    {
        $cache =  new \Core\Cache();

        $default_params = array(
            "page"        => "1",      //ページ数
            "limit"       => "50",     //レスポンス件数
            "min_price"   => "",       //最低価格
            "max_price"   => "",       //最高価格
            "sort"        => "",       //ソート方式: +price/-price/+id/-id
            "category_id" => "",       //カテゴリID
            "keyword"     => "",       //検索キーワード
        );

        $format     = $this->format($_GET);
        //$search_conditions = $this->params($default_params);
        $conditions = $default_params;
        $key = implode($conditions);
        if ($cache->get($key)) {
            $contents = $cache->get($key);
        } else {
            $contents = $this->items->search($conditions);
            $cache->set($key, $contents);
        }

        $this->view->render('search', $format, $contents);
    }

    public function item()
    {
        $output_format = $this->param('GET', 'format');
        $search_conditions = $this->param('GET', 'id');
        $contents = $this->_item($search_params);
        $this->view->render('detail', $output_format, $contents);
    }

}
