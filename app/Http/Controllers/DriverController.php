<?php

namespace App\Http\Controllers;

use App\Models\Supir;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DataTables;
class DriverController extends Controller
{
  public function search(Request $request)
    {
        $query = $request->q;
        $supirs = Supir::where('namasupir', 'like', '%' . $query . '%')->get();

        return response()->json($supirs);
    }

}
