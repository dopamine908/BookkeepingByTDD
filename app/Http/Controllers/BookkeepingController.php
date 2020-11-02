<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
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
}
