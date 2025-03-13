<?php
namespace App\Models;

use App\Model;

class Category extends Model
{
    protected $tableName = 'categories';
    public function findOnSearch($search)
    {
        return $this->connection->createQueryBuilder()
        ->select('*')
        ->from('categories', 'c')
        ->where('c.name LIKE :search')
        ->setParameter('search', "%$search%")
        ->fetchAllAssociative();
    }
}