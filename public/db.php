<?php

class Db
{
    private $host = 'localhost:3306';
    private $user = 'root';
    private $password = '';
    private $dbname = 'fast_food';



    public function connect()
    {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }
}
