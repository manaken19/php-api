<?php

class mysqlConnector implements BaseConnector
{

    private $_data_source;
    private $_config = array(
        "dsn"  => "mysql:dbname=phpapi;host=localhost",
        "user" => "root",
        "pass" => "",
    );
    private $_dbh;

    public function __construct($data_source)
    {
        $this->_data_source = $data_source;
        $this->_connect();
    }

    public function __destruct()
    {
        $this->_disconnect();
    }

    public function find($conditions)
    {

        $placeholders = array();
        $where_clause = array();
        foreach($conditions as $statement => $value){
            if(!empty($value)){
                $placeholders[":$key"] = $value;
                $where_clause[] = $value;
            }
        }
        if(!empty($where_clause)){
            $where_clause_str = "WHERE " . implode($where_clause, " AND ");
        }

        $sql = "SELECT * FROM $this->_data_source $where_clause_str";

        return $this->_fetchAll($sql, $placeholders);
    }

    private function _connect()
    {
        $config = $this->_config;

        try{
            $this->_dbh = new PDO($config["dsn"], $config["user"], $config["pass"]);
        }catch(PDOException $e){
            print("Connection failed:" . $e->getMessage());
            die();
        }
    }

    private function _disconnect()
    {
        $this->_dbh = null;
    }

    private function _fetchAll($sql, $placeholders = array())
    {
        $sth = $this->_dbh->prepare($sql);

        foreach($placeholders as $key => $value){

            if(is_numeric($value)){
                $type = PDO::PARAM_INT;
                $value = (int)$value;
            }else{
                $type = PDO::PARAM_STR;
            }

            $sth->bindValue($key, $value, $type);
        }

        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}