<?php
namespace App\Models;

use App\Model;

class User extends Model
{
    protected $tableName = 'users';
    public function findByEmail($email) {
        return $this->connection->createQueryBuilder()
        ->select('*')
        ->from('users', 'u')
        ->where('u.email = :email')
        ->setParameter('email', $email)
        ->fetchAssociative();
    }
    public function findOnSearch($search)
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from('users', 'u')
            ->where('u.name LIKE :search')
            ->setParameter('search', "%$search%")
            ->fetchAllAssociative();
    }
}