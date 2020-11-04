<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Repositories\Bookkeeping as BookkeepingRepo;
use App\Services\Bookkeeping as BookkeepingService;
use Illuminate\Http\Request;

class BookkeepingController extends Controller
{
    private $BookkeepingService;
    private $BookkeepingRepo;

    public function __construct(BookkeepingService $BookkeepingService, BookkeepingRepo $BookkeepingRepo)
    {
        $this->BookkeepingService = $BookkeepingService;
        $this->BookkeepingRepo = $BookkeepingRepo;
    }

    public function create(Create $request)
    {
        $this->BookkeepingService->create($request->title, $request->type, $request->amount);
        return response()->json(['status' => 'success'], 201);
    }

    public function update(Request $request, $id)
    {
        $this->BookkeepingRepo->update($id, $request->title, $request->type, $request->amount);
        return response()->json(['status' => 'success'], 201);
    }
}
