<?php 

class DBConnect{
    private $dsn = 'mysql:host=localhost;dbname=pms';
    private $user = 'root';
    private $pass = '';
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    public function connect(){
        try{
            $db = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch(PDOException $e){
            echo 'not connecting' . $e->getMessage();
        }


    }
}