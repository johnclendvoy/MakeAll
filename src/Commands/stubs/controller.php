<?php

namespace App\Http\Controllers;

use App\_studly_single_;
use Illuminate\Http\Request;
use Illuminate\Http\Requests_studly_single_FormRequest;

class _studly_single_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_snake_plural_ = _studly_single_::all();
        return view('_kebab_single_.index', compact('_snake_plural_'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $_snake_single_ = new _studly_single_;
        return view('_kebab_single_.create', compact('_snake_single_'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(_studly_single_FormRequest $request)
    {
        $_snake_single_ = _studly_single_::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_snake_single_ = _studly_single_::findOrFail($id);
        return view('_kebab_single_.show', compact('_snake_single_'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $_snake_single_ = _studly_single_::findOrFail($id);
        return view('_kebab_single_.create', compact('_snake_single_'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(_studly_single_FormRequest $request, $id)
    {
        $_snake_single_ = _studly_single_::findOrFail($id);
        $_snake_single_->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_snake_single_ = _studly_single_::findOrFail($id);
        $_snake_single_->delete();
        return back();
    }
}
