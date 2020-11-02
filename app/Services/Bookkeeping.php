<?php


namespace App\Services;


use App\Repositories\Bookkeeping as BookkeepingRepo;

class Bookkeeping
{
    private $BookkeepingRepo;

    public function __construct(BookkeepingRepo $BookkeepingRepo)
    {
        $this->BookkeepingRepo = $BookkeepingRepo;
    }

    public function create($title, $type, $amount): bool
    {
        return $this->BookkeepingRepo->create($title, $type, $amount);
    }
}