<?php

namespace App\Http\Controllers;

use App\Models\Bookkeeping;
use Illuminate\Http\Request;

class BookkeepingController extends Controller
{
    public function create(Request $request)
    {
        $Bookkeeping = new Bookkeeping();
        $Bookkeeping->title = $request->title;
        $Bookkeeping->type = $request->type;
        $Bookkeeping->amount = $request->amount;
        $Bookkeeping->save();
        return response()->json(['status' => 'success'], 201);
    }
}
