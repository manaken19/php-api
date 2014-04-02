<?php

namespace Core;

/**
 * DbManager Class.
 *
 * @author Yosuke Ohshima
 */
class DbManager
{

    private $dbh;

    private function connect()
    {

        $config = new \Core\Config();
        $db_config = $config->get('mysql');
        try {
            $this->dbh = new \PDO($db_config["dns"], $db_config["user"], $db_config["pass"]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            exit;
        }

    }

    public function execute($sql, $placeholders = array())
    {
        $this->connect();
        $stmt = $this->dbh->prepare($sql);

        foreach ($placeholders as $key => $value) {
            $data_type = $this->check_datatype($value);
            $stmt->bindValue($key, $value, $data_type);
        }

        $aaa = $stmt->execute();

        return $stmt;

    }

    private function check_datatype($value)
    {
        switch(true){
            case is_bool($value) :
                $data_type = \PDO::PARAM_BOOL;
                break;

            case is_null($value) :
                $data_type = \PDO::PARAM_NULL;
                break;

            case is_int($value) :
                $data_type = \PDO::PARAM_INT;
                break;

            case is_float($value) :
            case is_numeric($value) :
            case is_string($value) :
            default:
                $data_type = \PDO::PARAM_STR;
                break;
        }
        return $data_type;
    }

    public function fetchAll($sql, $placeholders = array())
    {
        return $this->execute($sql, $placeholders)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function __destruct()
    {
        $this->_dbh = null;
    }

        public function createWhereStr($where_params, $placeholders)
    {
        $where_clause_str = "WHERE :where";

        $where_clause = array();
        foreach($where_params as $key => $value){
            if(!empty($placeholders[$key])){
                $where_clause[] = $value;
            }
        }

        if(empty($where_clause)){
            $where_clause_str = str_replace("WHERE :where", "", $where_clause_str);
        }else{
            $where_clause_str = str_replace(":where", implode($where_clause, " AND "), $where_clause_str);
        }

        return $where_clause_str;
    }

}
