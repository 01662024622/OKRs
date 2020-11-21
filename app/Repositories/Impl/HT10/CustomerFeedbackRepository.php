<?php


namespace App\Repositories\Impl\HT10;


use App\Model\HT10\CustomerFeedback;
use App\Repositories\AbstractRepository;

class CustomerFeedbackRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new CustomerFeedback());
    }
}
