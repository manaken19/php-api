<?php
require_once(dirname(__FILE__) . "/../config/db.php");

/**
 * Database object creation helper methods.
 */
class Database
{

	private $dbh;

	private function connect()
	{

		$config = new Database_Setting;
		$db_config = $config->db_config();
		
		try {
            $this->dbh = new PDO($db_config["dns"], $db_config["user"], $db_config["pass"]);
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

        $stmt->execute();

        return $stmt;

    }

    private function check_datatype($value)
    {
	    switch(true){

	    	case is_bool($value) :
	    		$data_type = PDO::PARAM_BOOL;
	    		break;

	    	case is_null($value) :
	    		$data_type = PDO::PARAM_NULL;
	    		break;

	    	case is_int($value) :
	    		$data_type = PDO::PARAM_INT;
	    		break;
	    		
	    	case is_float($value) :
	    	case is_numeric($value) :
	    	case is_string($value) :
	    	default:
	    		$data_type = PDO::PARAM_STR;
	    		break;

	    }

	    return $data_type;
    }

	public function fetchAll($sql, $placeholders = array())
	{
        return $this->execute($sql, $placeholders)->fetchAll(PDO::FETCH_ASSOC);
	}

    public function __destruct()
    {
        $this->_dbh = null;
    }

}