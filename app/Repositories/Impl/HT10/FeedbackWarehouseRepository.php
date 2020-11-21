<?php


namespace App\Repositories\Impl\HT10;


use App\Model\HT10\FeedbackWarehouse;
use App\Repositories\AbstractRepository;

class FeedbackWarehouseRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new FeedbackWarehouse());
    }
}
