<?php
namespace App\Repositories\Impl\HT10;

use App\Repositories\AbstractRepository;
use App\Model\HT10\ReportMarket;

class ReportMarketRepository extends  AbstractRepository {

    public function __construct()
    {
        parent::__construct(new ReportMarket());
    }

}

