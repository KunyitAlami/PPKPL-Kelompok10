<?php

namespace App\Http\Controllers;

use App\Models\SoilTest;
use App\Models\SoilLocation;
use App\Actions\StoreSoilLocationAction;
use App\Http\Requests\StoreLocationRequest;
use App\Models\SoilLocationModel;
use App\Models\SoilTestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SoilLocationController extends Controller
{
    public function create(SoilTestModel $soilTest): View
    {
        return view('locations.create', compact('soilTest'));
    }

    public function store(StoreLocationRequest $request, SoilTestModel $soilTest, StoreSoilLocationAction $action): RedirectResponse
    {
        $location = $action->execute($soilTest, $request->validated());

        return redirect()->route('locations.show', $location->id)
            ->with('success', 'Koordinat lokasi berhasil disimpan.');
    }

    public function show(SoilLocationModel $location): View
    {
        return view('locations.show', compact('location'));
    }
}