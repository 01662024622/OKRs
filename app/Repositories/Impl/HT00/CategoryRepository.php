<?php


namespace App\Repositories\Impl\HT00;


use App\Model\HT00\Category;
use App\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new Category());
    }
}
