<?php

namespace core\db;

use core\interfaces\IDb;

class Db implements IDb
{
    protected $host;
    protected $user;
    protected $password;
    protected $dbName;

    private $_connection;

    public function __construct(string $host, string $user, string $password, string $dbName)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function getConnection(): \PDO {
        try{
            $this->_connection = $this->_connection ? $this->_connection :
                new \PDO(sprintf('mysql:host=%s;dbname=%s', $this->host, $this->dbName), $this->user, $this->password);
            $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

            return $this->_connection;
        }catch(\PDOException $e){
            exit('Ошибка подключения к БД');
        }
    }
}