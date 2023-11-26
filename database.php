<?php
class ConnectionMNGR
{
    private $dbConn;

    public function connect()
    {
        $this->dbConn = new mysqli("localhost", "root", "", "reminder");

        if ($this->dbConn->connect_error) {
            die('MySQL connection failed: ' . $this->dbConn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->dbConn;
    }
}

class SQL
{
    private $dbConn;

    public function __construct($dbConn)
    {
        $this->dbConn = $dbConn;
    }

    public function dbQuery($sql)
    {
        $result = $this->dbConn->query($sql) or die($this->dbConn->error);

        return $result;
    }

    public function dbFetchAssoc($result)
    {
        return $result->fetch_assoc();
    }

    public function dbFreeResult($result)
    {
        $result->free_result();
    }

    public function dbNumRows($result)
    {
        return $result->num_rows;
    }
}
?>
