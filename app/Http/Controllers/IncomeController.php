<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Get instance model Income
     * @var Income
     */
    private Income $income;

    /**
     * Var with income type, get instance model
     * @var IncomeType|object
     */
    private IncomeType $incomeType;

    /**
     * IncomeController constructor.
     */
    public function __construct()
    {
        $this->income = new Income;
        $this->incomeType = new IncomeType;
    }

    /**
     * Display a listing of the income.
     * Get a list of records, add data filtering, sort by latest.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $incomeType = $this->incomeType->getTypeArray();
        $income = Income::latest()->filter($request)->where('user_id', Auth::id())->paginate(10);

        return view('income.index', compact('income', 'incomeType'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * If ajax show a list of incomes by the selected date, order by type
     * else redirect to 404 page
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Exception
     */
    public function list(Request $request)
    {
        $incomeData = $this->income->getIncomesByDate(new Carbon($request->input('date')));
        $nameType = $this->incomeType->getTypeNameByIncome($incomeData);

        if ($request->ajax()) {
            return response()->json(['html' => view('income.list', compact('incomeData', 'nameType'))->render()]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new income.
     * If ajax request encode form to json format
     *
     * @param Request $request
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $incomeType = $this->incomeType->getType();

        if ($request->ajax()) {
            return response()->json(['html' => view('income.form', compact('incomeType'))->render()]);
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
            'type_id' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        Income::create([
            'type_id' => $request->input('type_id'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'desc' => $request->input('desc'),
            'user_id' => Auth::id()
        ]);

        return redirect(back()->getTargetUrl() . '#day-' . $request->input('date'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Income $income
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Income $income)
    {
        $incomeType = $this->incomeType->getTypeArray();

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
        $incomeType = $this->incomeType->getType();

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
            'type_id' => 'required',
            'date' => 'required',
        ]);
        $income->update($request->all());

        return redirect()->route('income.index')
            ->with('success', 'Income updated successfully');
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

        return redirect()->route('income.index')
            ->with('success', 'Income deleted successfully');
    }
}
