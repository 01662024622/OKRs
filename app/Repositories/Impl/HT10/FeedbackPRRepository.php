<?php
namespace App\Repositories\Impl\HT10;


use App\Model\HT10\FeedbackPR;
use App\Repositories\AbstractRepository;

class FeedbackPRRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new FeedbackPR());
    }
}
