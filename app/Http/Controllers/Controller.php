<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        $set = cache()->rememberForever('set', function () {
            return Setting::first();
        });
        View::share('set', $set);
        
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('user_proof', Auth::user()->show_popup);
            }
        });
    }
}
