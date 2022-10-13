<?php

namespace src\utils;

use PDO;
use PDOStatement;

class Conexao
{
    public function getHost(): string
    {
        return 'postgres';
    }
    public function getPort(): string
    {
        return '5432';
    }
    public function getDataBase(): string
    {
        return 'postgres';
    }
    public function getUser(): string
    {
        return 'postgres';
    }
    public function getPassWord(): string
    {
        return 'postgres';
    }

    public function getTipoBanco(): string
    {
        return 'pgsql';
    }

    private static Conexao $instance;

    private ?PDO $pdo;
    private ?PDOStatement $statement;

    private function __construct()
    {
        $this->pdo = null;
        $this->statement = null;
    }

    public static function CNX(): Conexao
    {
        if (!isset(self::$instance)) {
            self::$instance = new Conexao();
        }
        return self::$instance;
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollback()
    {
        $this->pdo->rollback();
    }

    public function prepare(string $sql)
    {
        $this->statement = $this->pdo->prepare($sql);
    }

    public function query(string $sql)
    {
        $this->statement = $this->pdo->query($sql); 
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
    public function execute()
    {
        return $this->statement->execute();
    }

    public function debugDumpParams()
    {
        $this->statement->debugDumpParams();
    }

    public function fetch($tipo)
    {
        return $this->statement->fetch($tipo);
    }

    public function fetchAll($tipo)
    {
        return $this->statement->fetchAll($tipo);
    }

    public function bindValue(int|string $param, mixed $var, int $type = PDO::PARAM_STR)
    {
        return $this->statement->bindValue($param, $var, $type);
    }


    public function connect()
    {
        if (!$this->pdo) {
            $basePostgres = "{$this->getTipoBanco()}:host={$this->getHost()};port={$this->getPort()};dbname={$this->getDataBase()};";
            $this->pdo = new PDO($basePostgres, $this->getUser(), $this->getPassWord(), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
    }

    public function disconnect()
    {
        $this->pdo = null;
        $this->statement = null;
    }
}
