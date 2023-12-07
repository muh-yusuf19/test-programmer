<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StockController extends Controller
{
    public function index()
    {
        $stock = DB::table('tbl_stock')->get();

        return Inertia::render('Stock/Index', [
            'stock' => $stock
        ]);
    }
}
