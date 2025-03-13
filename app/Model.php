<?php
namespace App;

use Doctrine\DBAL\DriverManager;

class Model
{ 
    protected $connection;
    protected $tableName; 
    public function __construct()
    {
        $connectionParams = [
            'dbname'    => $_ENV['DB_DATABASE'],
            'user'    => $_ENV['DB_USER'],
            'password'    => $_ENV['DB_PASS'],
            'host'    => $_ENV['DB_HOST'],
            'port'    => $_ENV['DB_PORT'],
            'driver'    => $_ENV['DB_DRIVER']
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }
    public function __destruct()
    {
        $this->connection->close();
    }
    public function findAll()
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')->from($this->tableName);
        return $queryBuilder->fetchAllAssociative();
    }
    public function find($id)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
        ->from($this->tableName)
        ->where('id=:id')
        ->setParameter('id',$id);
        return $queryBuilder->fetchAssociative();
    }
    public function insert(array $data)
    {
        $this->connection->insert($this->tableName,$data);
        return $this->connection->lastInsertId(); 
    }
    public function update($id, array $data)
    {
        return $this->connection->update($this->tableName,$data,['id'=>$id]);
    }
    public function delete($id)
    {
        return $this->connection->delete($this->tableName,['id'=>$id]);
    }
}