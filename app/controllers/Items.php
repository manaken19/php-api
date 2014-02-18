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
    public function index()
    {
        $default_params = array(
            "page"        => "1",      //ページ数
            "limit"       => "50",     //レスポンス件数
            "min_price"   => "",       //最低価格
            "max_price"   => "",       //最高価格
            "sort"        => "",       //ソート方式: +price/-price/+id/-id
            "category_id" => "",       //カテゴリID
            "keyword"     => "",       //検索キーワード
        );

        $output_format     = $this->param('GET', 'format'); 
        $search_conditions = $this->params('GET', $default_params);
        $contents          = $this->items->search($search_conditions);

        $this->view->render('search', $output_format, $contents);
    }

}