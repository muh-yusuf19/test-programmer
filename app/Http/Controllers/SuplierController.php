<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use App\Http\Requests\StoreSuplierRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        return Inertia::render('Suplier/Index', [
            'suplier' => Suplier::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Suplier/Create');
    }

    public function store(StoreSuplierRequest $request)
    {
        Suplier::create($request->validated());

        return to_route('suplier.index');
    }

    public function edit(Suplier $suplier)
    {
        return Inertia::render('Suplier/Edit', [
            'suplier' => $suplier
        ]);
    }

    public function update(StoreSuplierRequest $request, Suplier $suplier)
    {
        $suplier->update($request->validated());

        return to_route('suplier.index');
    }

    public function delete(Suplier $suplier)
    {
        $suplier->delete();

        return to_route('suplier.index');
    }
}
