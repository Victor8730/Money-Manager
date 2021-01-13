<?php

namespace App\Http\Controllers;

use App\Models\SettingsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LocalizationController extends Controller
{
    /**
     * Ajax update localization
     * If not ajax then show 404 page
     * If user login, then save info to database and session, else save only session
     * And show response success
     * If localization var is empty then show response error
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $localization = $request->route('locale');
            if(!empty($localization)) {
                if (Auth::check()) {
                    (new SettingsUser())->setLanguageUser($localization);
                }

                session()->put('locale', $localization);
                App::setlocale($localization);
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
