<?php
namespace App\Models;

use App\Model;

class Product extends Model
{
    protected $tableName = 'products';
    public function findAll()
    {
        return $this->connection->createQueryBuilder()
            ->select('p.*, c.name AS category_name')
            ->from('products', 'p')
            ->join('p', 'categories', 'c', 'p.category_id = c.id')
            ->fetchAllAssociative();
    }
    public function findOnSearch($search)
    {
        return $this->connection->createQueryBuilder()
            ->select('p.*, c.name AS category_name')
            ->from('products', 'p')
            ->join('p', 'categories', 'c', 'p.category_id = c.id')
            ->where('p.name LIKE :search')
            ->setParameter('search', "%$search%")
            ->fetchAllAssociative();
    }
}