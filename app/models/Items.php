<?php

namespace Model;

/**
 * Item Model.
 *
 * @author Yosuke Ohshima
 */
class Items extends \Core\Model
{
    public function search($params)
    {
        $placeholders = array();
        $sql = "SELECT * FROM item WHERE :where ORDER BY :order LIMIT :limit OFFSET :offset";

        $where_params = array(
            ":min_price"   => "price >= :min_price",
            ":max_price"   => "price <= :max_price",
            ":category_id" => "category_id = :category_id",
            ":keyword"     => "MATCH(title) AGAINST(:keyword)",
        );

        foreach($params as $key => $value){
            if(empty($value)){
                continue;
            }
            switch($key){
                case "min_price":
                    $placeholders[":min_price"] = $value;
                    break;
                case "max_price":
                    $placeholders[":max_price"] = $value;
                    break;
                case "page":
                    $offset = ($params["page"] - 1) * $params["limit"];
                    $placeholders[":offset"] = $offset;
                    break;
                case "limit":
                    $placeholders[":limit"] = $value;
                    break;
                case "sort":
                    switch($value){
                        case "+price":
                            $sql = str_replace(":order", "price ASC", $sql);
                            break;
                        case "-price":
                            $sql = str_replace(":order", "price DESC", $sql);
                            break;
                        case "+id":
                            $sql = str_replace(":order", "id ASC", $sql);
                            break;
                        case "+id":
                            $sql = str_replace(":order", "id DESC", $sql);
                            break;
                    }
                    break;
                case "category_id":
                    $placeholders[":category_id"] = $value;
                    break;
                case "keyword":
                    $placeholders[":keyword"] = $value;
                    break;
                default:
                    break;
            }
        }

        if(empty($placeholders[":order"])){
            $sql = str_replace("ORDER BY :order", "", $sql);
        }

        if(empty($placeholders[":limit"])){
            $sql = str_replace("LIMIT :limit", "", $sql);
        }

        $sql = str_replace("WHERE :where", $this->_db->createWhereStr($where_params, $placeholders), $sql);

        $result = $this->_db->fetchAll($sql, $placeholders);
        var_dump($result);exit;

        return $result;
    }
}
