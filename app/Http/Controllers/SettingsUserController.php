<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\SettingsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsUserController extends Controller
{
    /**
     * Var with settings, get instance model
     * @var Settings|object
     */
    protected Settings $settings;

    /**
     * Var with settings user, get instance model
     * @var Settings|object
     */
    protected SettingsUser $settingsUser;

    /**
     * CostsController constructor.
     */
    public function __construct()
    {
        $this->settings = new Settings();
        $this->settingsUser = new SettingsUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->settings->getSettingsArray();
        $settingsUser = $this->settingsUser->getSettingsUserArray();
        $user = Auth::user();

        return view('settings.index', compact('settings', 'user', 'settingsUser'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SettingsUser $settingsUser
     * @return \Illuminate\Http\Response
     */
    public function show(SettingsUser $settingsUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SettingsUser $settingsUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingsUser $settingsUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->settingsUser->updateSettingsUser($request);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SettingsUser $settingsUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingsUser $settingsUser)
    {
        //
    }
}
