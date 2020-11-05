<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Http\Requests\Bookkeeping\Update;
use App\Models\Bookkeeping as BookkeepingModel;
use App\Services\Bookkeeping as BookkeepingService;

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
        if (is_null(BookkeepingModel::find($id))) {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => 'resource not found'
                ],
                404
            );
        } else {
            $this->BookkeepingService->update($id, $request->title, $request->type, $request->amount);
        }
        return response()->json(['status' => 'success'], 201);
    }
}
