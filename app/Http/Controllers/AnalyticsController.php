<?php

namespace App\Http\Controllers;

use App\Models\CostsType;
use App\Models\Income;
use App\Models\Costs;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnalyticsController extends Controller
{

    /**
     * Var with costs type, get instance model
     * @var CostsType|object
     */
    private CostsType $costsType;

    /**
     * Var with income type, get instance model
     * @var IncomeType|object
     */
    private IncomeType $incomeType;

    /**
     * Var with object income
     * @var Income
     */
    private Income $income;

    /**
     * Var with object costs
     * @var Costs
     */
    private Costs $costs;

    /**
     * AnalyticsController constructor.
     */
    public function __construct()
    {
        $this->costsType = new CostsType;
        $this->incomeType = new IncomeType;
        $this->income = new Income;
        $this->costs = new Costs;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $costsType = $this->costsType->getType();
        $incomeType = $this->incomeType->getType();

        return view('analytics.index', compact('costsType','incomeType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return false|string
     */
    public function data(Request $request)
    {
        $dateStart = Carbon::create((!empty($request->input('start'))) ? $request->input('start') : date("Y-m-d"));
        $dateFinal = Carbon::create((!empty($request->input('final'))) ? $request->input('final') : date("Y-m-d"));
        $dataType = (!empty($request->input('type'))) ? $request->input('type') : 1;
        $dataVariant = (!empty($request->input('variant'))) ? $request->input('variant') : 1;
        $data = ($dataVariant==1) ? $this->income->getIncomesByDateRange($dateStart,$dateFinal,$dataType) : $this->costs->getCostsByDateRange($dateStart,$dateFinal,$dataType);

        return json_encode(['r'=>$data]);
    }
}
