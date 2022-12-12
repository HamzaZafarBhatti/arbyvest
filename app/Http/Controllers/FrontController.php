<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('front.index');
    }
    public function about()
    {
        return view('front.about');
    }
    public function services()
    {
        return view('front.services');
    }
    public function projects()
    {
        return view('front.projects');
    }
    public function features()
    {
        return view('front.features');
    }
    public function team()
    {
        return view('front.team');
    }
    public function testimonial()
    {
        return view('front.testimonial');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function terms()
    {
        return view('front.terms');
    }
    public function support()
    {
        return view('front.support');
    }

    public function market_rates()
    {
        $market_prices = MarketPrice::whereIsActive(1)->get();
        return view('front.market_rates', compact('market_prices'));
    }
}
