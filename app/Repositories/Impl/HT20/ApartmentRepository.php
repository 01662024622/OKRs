<?php
namespace App\Repositories\Impl\HT20;

use App\Model\HT20\Apartment;
use App\Repositories\AbstractRepository;

class ApartmentRepository extends  AbstractRepository {

  public function __construct()
  {
    parent::__construct(new Apartment());
  }

}

