<?php


namespace App\Services\Impl\HT10;


use App\Repositories\Impl\HT10\ReviewRepository;
use App\Services\HT10\ReviewService;

class ReviewServiceImpl implements ReviewService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ReviewRepository();
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {
        return null;
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

}
