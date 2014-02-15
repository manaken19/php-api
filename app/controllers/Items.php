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

}