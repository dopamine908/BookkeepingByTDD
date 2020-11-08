<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Http\Requests\Bookkeeping\Delete;
use App\Http\Requests\Bookkeeping\Update;
use App\Http\Resources\BookkeepingResourceCollection;
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
        $result = $this->BookkeepingRepo->get($request->title, $request->type, $request->amount);
        return new BookkeepingResourceCollection($result);
    }
}
