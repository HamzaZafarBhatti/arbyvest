<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MarketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = MarketPrice::latest('id')->get();
        return view('admin.market_price.index', compact('records'));
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
        try {
            $data = $request->except('_token');
            MarketPrice::create($data);
            return back()->with('success', 'Market Price added!');
        } catch (\Throwable $th) {
            Log::error('Error! '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarketPrice  $marketPrice
     * @return \Illuminate\Http\Response
     */
    public function show(MarketPrice $marketPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarketPrice  $marketPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(MarketPrice $marketPrice)
    {
        //
        return view('admin.market_price.edit', compact('marketPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MarketPrice  $marketPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarketPrice $marketPrice)
    {
        //
        try {
            $data = $request->except('_token', '_method');
            $marketPrice->update($data);
            return redirect()->route('admin.market_prices.index')->with('success', 'Market Price updated!');
        } catch (\Throwable $th) {
            Log::error('Error! '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarketPrice  $marketPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarketPrice $marketPrice)
    {
        //
        try {
            $marketPrice->delete();
            return back()->with('deleted', 'Market Price deleted!');
        } catch (\Throwable $th) {
            Log::error('Error! '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
}
