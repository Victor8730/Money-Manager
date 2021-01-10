<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            if(!empty($request->route('locale'))) {
                session()->put('locale', $request->route('locale'));
                App::setlocale($request->route('locale'));
                $success = 1;
            }else{
                $success = 0;
            }

            return response()->json(['html' => view('profile.localization', compact('success'))->render()]);
        }else{
            return abort(404);
        }
    }
}
