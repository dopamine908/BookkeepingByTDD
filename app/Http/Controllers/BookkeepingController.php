<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookkeeping\Create;
use App\Http\Requests\Bookkeeping\Delete;
use App\Http\Requests\Bookkeeping\Read;
use App\Http\Requests\Bookkeeping\Update;
use App\Http\Resources\BookkeepingResourceCollection;
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
        $this->BookkeepingService->update($id, $request->title, $request->type, $request->amount);
        return response()->json(null, 204);
    }

    public function delete(Delete $request, $id)
    {
        $this->BookkeepingService->delete($id);
        return response()->json(null, 204);
    }

    public function read(Read $request)
    {
        $result = $this->BookkeepingService->get($request->title, $request->type, $request->amount);
        return new BookkeepingResourceCollection($result);
    }
}
