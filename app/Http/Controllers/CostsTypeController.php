<?php

namespace App\Http\Controllers;

use App\Models\CostsType;
use Illuminate\Http\Request;

class CostsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costsType = CostsType::latest()->paginate(5);

        return view('costs-type.index', compact('costsType'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costs-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        CostsType::create($request->all());

        return redirect()->route('costs-type.index')
            ->with('success', 'Costs type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CostsType  $costsType
     * @return \Illuminate\Http\Response
     */
    public function show(CostsType $costsType)
    {
        return view('costs-type.show', compact('costsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CostsType  $costsType
     * @return \Illuminate\Http\Response
     */
    public function edit(CostsType $costsType)
    {
        return view('costs-type.edit', compact('costsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CostsType  $costsType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostsType $costsType)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        $costsType->update($request->all());

        return redirect()->route('costs-type.index')
            ->with('success', 'Costs type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CostsType $costsType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CostsType $costsType)
    {
        try {
            $costsType->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('costs-type.index')
            ->with('success', 'Costs type deleted successfully');
    }
}
