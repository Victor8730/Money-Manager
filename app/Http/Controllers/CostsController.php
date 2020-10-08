<?php

namespace App\Http\Controllers;

use App\Models\Costs;
use App\Models\CostsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $costsType = CostsType::all('name', 'id')->keyBy('id')->toArray();
        $costs = Costs::latest()->where('user_id', Auth::id())->paginate(5);

        return view('costs.index', compact('costs', 'costsType'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $costsType = CostsType::all('name', 'id');

        return view('costs.create', compact('costsType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        Costs::create([
            'type' => $request['type'],
            'amount' => $request['amount'],
            'date' => $request['date'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('costs.index')
            ->with('success', 'Costs created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costs $cost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Costs $cost)
    {
        $costsType = CostsType::all('name', 'id')->keyBy('id')->toArray();

        return view('costs.show', compact('cost', 'costsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Costs $cost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Costs $cost)
    {
        $costsType = CostsType::all('name', 'id');

        return view('costs.edit', compact('cost', 'costsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Costs $cost
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Costs $cost)
    {
        $request->validate([
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);
        $cost->update($request->all());

        return redirect()->route('costs.index')
            ->with('success', 'Costs updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costs  $cost
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Costs $cost)
    {
        $cost->delete();

        return redirect()->route('costs.index')
            ->with('success', 'Cost deleted successfully');
    }
}