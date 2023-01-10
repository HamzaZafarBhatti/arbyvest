<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentPage  $contentPage
     * @return \Illuminate\Http\Response
     */
    public function show(ContentPage $contentPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentPage  $contentPage
     * @return \Illuminate\Http\Response
     */
    public function edit($page)
    {
        //
        // return $page;
        $content_page = ContentPage::where('key', $page)->first();
        $title = 'Content Page';
        return view('admin.web-control.edit', compact('content_page', 'title', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentPage  $contentPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page)
    {
        //
        // return $page;
        $content_page = ContentPage::updateOrCreate(
            ['key' => $page],
            ['value' => $request->value, 'label' => strtoupper(str_replace('_', ' ', $page))]
        );
        return redirect()->route('admin.content_pages.edit', ['page' => $page])->with('success', 'Content Page updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentPage  $contentPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentPage $contentPage)
    {
        //
    }
}
