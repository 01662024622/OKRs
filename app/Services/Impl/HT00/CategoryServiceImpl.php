<?php


namespace App\Services\Impl\HT00;


use App\Repositories\HT00\CategoryRepository;
use App\Services\AbstractService;
use App\Services\HT00\CategoryService;

class CategoryServiceImpl extends AbstractService implements CategoryService
{

    protected $repository;
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

}
