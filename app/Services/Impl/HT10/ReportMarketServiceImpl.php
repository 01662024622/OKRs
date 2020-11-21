<?php
namespace App\Services\Impl\HT10;

use App\Repositories\Impl\HT10\ReportMarketRepository;
use App\Services\HT10\ReportMarketService;
use Carbon\Carbon;

class ReportMarketServiceImpl implements ReportMarketService {
    protected $repository;
    public function __construct()
    {
        $this->repository = new ReportMarketRepository();
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
        $data = $this->repository->show($id);
        $data['date_work'] = Carbon::parse($data['date_work'])->format('d/m/Y');
        return $data;
    }
}

