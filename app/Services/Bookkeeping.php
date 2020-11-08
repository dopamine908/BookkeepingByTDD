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

    public function update($id, $title, $type, $amount)
    {
        return $this->BookkeepingRepo->update($id, $title, $type, $amount);
    }

    public function delete($id)
    {
        return $this->BookkeepingRepo->delete($id);
    }

    public function get($title, $type, $amount)
    {
        return $this->BookkeepingRepo->get($title, $type, $amount);
    }
}
