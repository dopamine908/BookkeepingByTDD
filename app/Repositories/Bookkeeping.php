<?php


namespace App\Repositories;


use App\Exceptions\BookkeepingResourceNotFoundException;
use App\Models\Bookkeeping as BookkeepingModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

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

    public function update($id, $title, $type, $amount)
    {
        try {
            $Bookkeeping = $this->BookkeepingModel->findOrFail($id);
            $Bookkeeping->title = $title;
            $Bookkeeping->type = $type;
            $Bookkeeping->amount = $amount;
            return $Bookkeeping->save();
        } catch (ModelNotFoundException $exception) {
            throw new BookkeepingResourceNotFoundException();
        }
    }

    public function delete($id)
    {
        try {
            $Bookkeeping = $this->BookkeepingModel->findOrFail($id);
            return $Bookkeeping->delete();
        } catch (ModelNotFoundException $exception) {
            throw new BookkeepingResourceNotFoundException();
        }
    }

    public function get($title, $type, $amount): Collection
    {
        $search = $this->BookkeepingModel;

        if ( ! is_null($title)) {
            $search = $search->where('title', 'like', '%' . $title . '%');
        }

        if ( ! is_null($type)) {
            $search = $search->where('type', '=', $type);
        }

        if ( ! is_null($amount)) {
            $search = $search->where('amount', '=', $amount);
        }

        return $search->get();
    }
}
