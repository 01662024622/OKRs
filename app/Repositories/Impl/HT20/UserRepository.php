<?php
namespace App\Repositories\Impl\HT20;

use App\Repositories\AbstractRepository;
use App\Model\HT20\User;

class UserRepository extends AbstractRepository {

    public function __construct()
    {
        parent::__construct(new User());
    }

}

