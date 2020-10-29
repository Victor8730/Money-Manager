<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $incomeType = IncomeType::latest()->where('user_id', Auth::id())->paginate(10);

        return view('income-type.index', compact('incomeType'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('income-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        IncomeType::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'user_id'=> Auth::id()
        ]);

        return redirect()->route('income-type.index')->with('success', 'Income type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\IncomeType $incomeType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(IncomeType $incomeType)
    {
        return view('income-type.show', compact('incomeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\IncomeType $incomeType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(IncomeType $incomeType)
    {
        return view('income-type.edit', compact('incomeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\IncomeType $incomeType
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, IncomeType $incomeType)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        $incomeType->update($request->all());

        return redirect()->route('income-type.index')->with('success', 'Income type updated successfully');
    }


    /**
     * Remove the income type from storage.
     * After remove send message to session
     *
     * @param IncomeType $incomeType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(IncomeType $incomeType)
    {
        return $incomeType->clean();
    }
}
