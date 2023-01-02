<?php

namespace App\Providers;

use App\Models\BlackmarketLog;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        $blackmarketsales = BlackmarketLog::where('status', 0)->get();
        if (count($blackmarketsales) > 0) {
            foreach ($blackmarketsales as $key => $value) {
                Log::info($value);
                $user = User::find($value->user_id);
                $end_time = Carbon::parse($value->completed_at)->format("Y-m-d H:i:s");
                if (Carbon::now() > $end_time) {
                    $user->update(['ngn_wallet' => $user->ngn_wallet + $value->amount_exchanged]);
                    $value->update(['status' => 1]);
                }
            }
        }
    }
}
