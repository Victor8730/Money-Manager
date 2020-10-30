<?php

namespace App\Http\Controllers;

use App\Models\Costs;
use App\Models\CostsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostsController extends Controller
{
    /**
     * Get instance model Costs
     * @var Costs
     */
    private Costs $costs;

    /**
     * Var with costs type, get instance model
     * @var CostsType|object
     */
    protected CostsType $costsType;

    /**
     * CostsController constructor.
     */
    public function __construct()
    {
        $this->costs = new Costs;
        $this->costsType = new CostsType;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $costsType = $this->costsType->getTypeArray();
        $costs = Costs::latest()->filter($request)->where('user_id', Auth::id())->paginate(10);

        return view('costs.index', compact('costs', 'costsType'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * If ajax show a list of costs by the selected date, order by type
     * Else redirect to 404 page
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Exception
     */
    public function list(Request $request)
    {
        $costsData = $this->costs->getCostsByDate(new Carbon($request->input('date')));
        $nameType = $this->costsType->getTypeNameByCosts($costsData);

        if ($request->ajax()) {
            return response()->json(['html' => view('costs.list', compact('costsData','nameType'))->render()]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * If ajax request encode form to json format
     *
     * @param Request $request
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $costsType = $this->costsType->getType();

        if ($request->ajax()) {
            return response()->json(['html' => view('costs.form', compact('costsType'))->render()]);
        } else {
            return view('costs.create', compact('costsType'));
        }

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
     * @param \App\Models\Costs $cost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Costs $cost)
    {
        $costsType = $this->costsType->getTypeArray();

        return view('costs.show', compact('cost', 'costsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Costs $cost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Costs $cost)
    {
        $costsType = $this->costsType->getType();

        return view('costs.edit', compact('cost', 'costsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Costs $cost
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
     * @param \App\Models\Costs $cost
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
