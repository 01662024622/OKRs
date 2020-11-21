<?php
namespace App\Repositories\Impl\HT10;
use App\Model\HT10\Feedback;
use App\Repositories\AbstractRepository;

class FeedbackRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new Feedback());
    }
}
