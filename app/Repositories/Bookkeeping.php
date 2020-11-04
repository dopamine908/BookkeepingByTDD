<?php


namespace App\Repositories;


use App\Models\Bookkeeping as BookkeepingModel;

class Bookkeeping
{
    private $BookkeepingModel;

    public function __construct(BookkeepingModel $BookkeepingModel)
    {
        $this->BookkeepingModel = $BookkeepingModel;
    }

    public function create($title, $type, $amount): bool
    {
        $Bookkeeping = new BookkeepingModel();
        $Bookkeeping->title = $title;
        $Bookkeeping->type = $type;
        $Bookkeeping->amount = $amount;
        return $Bookkeeping->save();
    }

    public function update($id, $title, $type, $amount): bool
    {
        $Bookkeeping = $this->BookkeepingModel->find($id);
        $Bookkeeping->title = $title;
        $Bookkeeping->type = $type;
        $Bookkeeping->amount = $amount;
        return $Bookkeeping->save();
    }
}
