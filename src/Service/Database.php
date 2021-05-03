<?php
namespace App\Service;

class Database
{
    protected ?\PDO $pdo = null;

    private string $defaultDb = __DIR__ . '/../../db/sqlite.db';

    public function connect(\PDO $pdo = null): \PDO
    {
        if (is_null($pdo) && is_null($this->pdo)) {
            $this->pdo = new \PDO('sqlite:' . $this->defaultDb);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } else {
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }
}