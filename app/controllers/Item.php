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
     * 商品検索API /item
     */
    public function index()
    {
        $output_format = $this->param('GET', 'format'); 
        $search_conditions = $this->param('GET', 'id');
        $contents = $this->_item($search_params);
        $this->view->render('detail', $output_format, $contents);
    }
    
}