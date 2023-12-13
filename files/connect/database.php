<?php
session_start();
class database
{
    private $dbname;
    private $dbuser;
    private $dbpass;
    protected $conn;

    public function __construct($dbname1, $dbuser1, $dbpass1)
    {
        $this->dbname = $dbname1;
        $this->dbuser = $dbuser1;
        $this->dbpass = $dbpass1;
        $this->conn = new PDO("mysql:host=localhost;dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
    }
}


class action extends database
{
    public function inud($query, $row = []) //insert-update-delete
    {
        $result = $this->conn->prepare($query);
        foreach ($row as $key => $value) {
            $result->bindValue($key + 1, $value);
        }
        $result->execute();
    }

    public function select($query, $row = [], $fetch = "fetch") //select
    {
        $result = $this->conn->prepare($query);
        foreach ($row as $key => $value) {
            $result->bindValue($key + 1, $value);
        }
        $result->execute();
        if ($fetch == "fetch") {
            return $row = $result->fetch(PDO::FETCH_OBJ);
        } else {
            return $row = $result->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function timetofarsi($time)
    {
        $t = explode("-", $time);
        return gregorian_to_jalali($t[0], $t[1], $t[2], "/");
    }

    public function catidtocatname($catid)
    {
        $query = "SELECT * FROM cat WHERE id=?";
        $row = [$catid];
        $select = $this->select($query, $row);
        return $select->catname;
    }
}
