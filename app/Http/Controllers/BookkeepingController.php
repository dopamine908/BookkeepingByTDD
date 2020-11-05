<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Http\Requests\Bookkeeping\Update;
use App\Models\Bookkeeping as BookkeepingModel;
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

    public function delete(Request $request, $id)
    {
        BookkeepingModel::destroy($id);
        return response()->json(['status' => 'success'], 201);
    }
}
