<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $document_types = DocumentType::all();
        return view('admin.document_types.index', compact('document_types'));
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
            DocumentType::create($data);
            Session::flash('success', 'Document Type added.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error! Document Type addition failed.');
        }
        return redirect()->route('admin.document_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        //
        return view('admin.document_types.edit', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentType $documentType)
    {
        //
        $request->validate([
            'name' => ['required', 'string'],
            'is_active' => ['required', 'boolean']
        ]);
        try {
            $documentType->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);
            Session::flash('success', 'Document Type updated.');
        } catch (\Exception $e) {
            Session::flash('error', 'Error! Document Type update failed.');
        }
        return redirect()->route('admin.document_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        //
        try {
            $documentType->delete();
            return back()->with('deleted', 'Document Type deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Error! Document Type delete failed');
        }
    }
}
