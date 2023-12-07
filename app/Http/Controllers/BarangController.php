<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BarangController extends Controller
{
    public function index()
    {
        return Inertia::render('Barang/Index', [
            'barang' => Barang::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Barang/Create');
    }

    public function store(StoreBarangRequest $request)
    {
        Barang::create($request->validated());

        return to_route('barang.index');
    }

    public function edit(Barang $barang)
    {
        return Inertia::render('Barang/Edit', [
            'barang' => $barang
        ]);
    }

    public function update(StoreBarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());

        return to_route('barang.index');
    }

    public function delete(Barang $barang)
    {
        $barang->delete();

        return to_route('barang.index');
    }

}
