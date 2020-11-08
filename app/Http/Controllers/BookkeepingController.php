<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Http\Requests\Bookkeeping\Delete;
use App\Http\Requests\Bookkeeping\Update;
use App\Http\Resources\BookkeepingResourceCollection;
use App\Models\Bookkeeping;
use App\Services\Bookkeeping as BookkeepingService;
use Illuminate\Http\Request;

class BookkeepingController extends Controller
{
    private $BookkeepingService;

    public function __construct(BookkeepingService $BookkeepingService)
    {
        $this->BookkeepingService = $BookkeepingService;
    }

    public function create(Create $request)
    {
        $this->BookkeepingService->create($request->title, $request->type, $request->amount);
        return response()->json(['status' => 'success'], 201);
    }

    public function update(Update $request, $id)
    {
        $this->BookkeepingService->update($id, $request->title, $request->type, $request->amount);
        return response()->json(['status' => 'success'], 201);
    }

    public function delete(Delete $request, $id)
    {
        $this->BookkeepingService->delete($id);
        return response()->json(['status' => 'success'], 201);
    }

    public function read(Request $request)
    {
        $BookkeepingModel = new Bookkeeping();

        if ( ! is_null($request->title)) {
            $BookkeepingModel = $BookkeepingModel->where('title', 'like', '%' . $request->title . '%');
        }

        if ( ! is_null($request->type)) {
            $BookkeepingModel = $BookkeepingModel->where('type', '=', $request->type);
        }

        if ( ! is_null($request->amount)) {
            $BookkeepingModel = $BookkeepingModel->where('amount', '=', $request->amount);
        }

        return new BookkeepingResourceCollection($BookkeepingModel->get());
    }
}
