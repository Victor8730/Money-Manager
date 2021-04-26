<?php

namespace App\Http\Controllers;

use App\Models\CostsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $costsType = CostsType::latest()->where('user_id', Auth::id())->paginate(10);

        return view('costs-type.index', compact('costsType'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('costs-type.create');
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

        CostsType::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'hide' => (!empty($request->input('hide'))) ? 1 : 0,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('costs-type.index')
            ->with('success', 'Costs type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CostsType $costsType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(CostsType $costsType)
    {
        return view('costs-type.show', compact('costsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CostsType $costsType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(CostsType $costsType)
    {
        return view('costs-type.edit', compact('costsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CostsType $costsType
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, CostsType $costsType)
    {


        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ]);
        $costsType->update([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'hide' => (!empty($request->input('hide'))) ? 1 : 0,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('costs-type.index')
            ->with('success', 'Costs type updated successfully');
    }


    /**
     * Remove the costs type from storage.
     * After remove send message to session
     *
     * @param CostsType $costsType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CostsType $costsType)
    {
        return $costsType->clean();
    }
}
