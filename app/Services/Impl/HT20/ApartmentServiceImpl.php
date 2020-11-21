<?php
namespace App\Services\Impl\HT20;


use App\Repositories\Impl\HT20\ApartmentRepository;
use App\Services\HT20\ApartmentService;

class ApartmentServiceImpl implements ApartmentService {
    protected $repository;
    public function __construct()
    {
        $this->repository = new ApartmentRepository();
    }

    public function all() {
     return $this->repository->all();
    }

    public function create(array $data){
        return $this->repository->create($data);
    }

    public function update(array $data, $id){
        return null;
    }

    public function delete($id){
        $this->repository->delete($id);
    }

    public function show($id){
        return $this->repository->show($id);
    }
}

