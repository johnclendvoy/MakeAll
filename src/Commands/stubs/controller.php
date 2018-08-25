<?php

namespace App\Http\Controllers;

use App\ObjectName;
use Illuminate\Http\Request;
use Illuminate\Http\RequestsObjectNameFormRequest;

class ObjectNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $object_names = ObjectName::all();
        return view('object-names.index', compact('object_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $object_name = new ObjectName;
        return view('object-names.create', compact('object_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjectNameFormRequest $request)
    {
        $object_name = ObjectName::create($request->all());
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
        $object_name = ObjectName::findOrFail($id);
        return view('object-names.show', compact('object_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object_name = ObjectName::findOrFail($id);
        return view('object-names.create', compact('object_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObjectNameFormRequest $request, $id)
    {
        $object_name = ObjectName::findOrFail($id);
        $object_name->update($request->all());
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
        $object_name = ObjectName::findOrFail($id);
        $object_name->delete();
        return back();
    }
}
