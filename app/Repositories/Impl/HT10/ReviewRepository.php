<?php


namespace App\Repositories\Impl\HT10;

use App\Model\HT10\Review;
use App\Repositories\AbstractRepository;

class ReviewRepository extends  AbstractRepository {

    public function __construct()
    {
        parent::__construct(new Review());
    }

}
