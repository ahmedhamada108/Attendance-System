<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\departments;
use App\Models\heads;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= departments::with('head:id,name as head_name')->select('id','name','head_id')->get();
        return view('Admin.departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads= heads::select('id','name')->get();
        return view('Admin.departments.create',compact('heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'head_id'=>'required',
        ]);
        departments::create($data);
        session()->flash('success',__('panel.departments.the_department_has_been_added'));
        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit(departments $departments,$id)
    {
        $departments= departments::find($id);
        $heads= heads::select('id','name')->get();
        // return $departments;
        return view('Admin.departments.show',compact(['departments','heads']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, departments $departments, $id)
    {
        $data= $request->validate([
            'name'=> 'required',
            'head_id'=> 'required',
        ]);
        departments::find($id)->update($data);
        session()->flash('success',__('panel.departments.this_department_has_been_edited'));
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(departments $departments,$id)
    {
        departments::destroy($id);
        session()->flash('success',__('panel.departments.this_department_has_been_deleted'));
        return redirect()->route('departments.index');
    }
}
