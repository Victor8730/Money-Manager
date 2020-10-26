<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the income.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $incomeType = IncomeType::all('name', 'id')->keyBy('id')->toArray();
        $income = Income::latest()->where('user_id', Auth::id())->paginate(10);

        return view('income.index', compact('income', 'incomeType'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new income.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $incomeType = IncomeType::all('name', 'id');

        if ($request->ajax()) {
            return view('income.form', compact('incomeType'));
        } else {
            return view('income.create', compact('incomeType'));
        }
    }

    /**
     * Store a newly created income in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        Income::create([
            'type' => $request['type'],
            'amount' => $request['amount'],
            'date' => $request['date'],
            'desc' => $request['desc'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('income.index')
            ->with('success', 'Income created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Income $income
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Income $income)
    {
        $incomeType = IncomeType::all('name', 'id')->keyBy('id')->toArray();

        return view('income.show', compact('income', 'incomeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Income $income
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Income $income)
    {
        $incomeType = IncomeType::all('name', 'id');

        return view('income.edit', compact('income', 'incomeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Income $income
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);
        $income->update($request->all());

        return redirect()->route('income.index')->with('success', 'Income updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Income $income
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()->route('income.index')->with('success', 'Income deleted successfully');
    }
}
