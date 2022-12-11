<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banks = Bank::all();
        return view('admin.banks.index', compact('banks'));
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
        $request->validate([
            'name' => ['required', 'string'],
            'is_active' => ['required', 'boolean']
        ]);
        try {
            $data = $request->except('_token');
            Bank::create($data);
            Session::flash('success', 'Bank added.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error! Bank addition failed.');
        }
        return redirect()->route('admin.banks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
        return view('admin.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
        $request->validate([
            'name' => ['required', 'string'],
            'is_active' => ['required', 'boolean']
        ]);
        try {
            $bank->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);
            Session::flash('success', 'Bank updated.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error! Bank update failed.');
        }
        return redirect()->route('admin.banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
        try {
            $bank->delete();
            return back()->with('deleted', 'Bank deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Error! Bank delete failed');
        }
    }
}
