<?php

namespace App\Http\Controllers;

use App\Repositories\Bookkeeping as BookkeepingRepo;
use Illuminate\Http\Request;

class BookkeepingController extends Controller
{
    private $BookkeepingRepo;

    public function __construct(BookkeepingRepo $BookkeepingRepo)
    {
        $this->BookkeepingRepo = $BookkeepingRepo;
    }

    public function create(Request $request)
    {
        $this->BookkeepingRepo->create($request->title, $request->type, $request->amount);
        return response()->json(['status' => 'success'], 201);
    }
}
