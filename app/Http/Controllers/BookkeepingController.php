<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
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

    public function update(Request $request, $id)
    {
        $Bookkeeping = BookkeepingModel::find($id);
        $Bookkeeping->title = $request->title;
        $Bookkeeping->type = $request->type;
        $Bookkeeping->amount = $request->amount;
        $Bookkeeping->save();
        return response()->json(['status' => 'success'], 201);
    }
}
