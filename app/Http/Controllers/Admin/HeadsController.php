<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\departments;
use App\Models\employees;
use App\Models\heads;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads= heads::select('id','name')->get();
        return view('admin.heads.index',compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = departments::select(['id','name'])->get();
        return view('admin.heads.create',compact('departments'));
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
            'name' => 'required ',
            'email' => 'required| email |unique:heads',
            'password' => 'required|min:6| confirmed',
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        heads::create($data);
        session()->flash('success', 'the students has been added');
        return redirect()->route('heads.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function edit(heads $heads,$id)
    {
        $heads= employees::find($id);
        return view('admin.heads.show',compact('heads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, heads $heads,$id)
    {
        $data= $request->validate([
            'name' => 'required',
            'email' => ['required','email', Rule::unique('heads')->ignore($id)],
        ]); 
        if($request->password){
            $data +=$request->validate([
                'password' => 'required|min:6| confirmed',
            ]);
            $data= $request->except('password');
            $data['password']= bcrypt($request->password);
        }
        heads::find($id)->update($data);
        session()->flash('success',__('this_employee_has_been_edited'));
        return redirect()->route('heads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\heads  $heads
     * @return \Illuminate\Http\Response
     */
    public function destroy(heads $heads,$id)
    {
        heads::destroy($id);
        session()->flash('success',__('panel.departments.this_department_has_been_deleted'));
        return redirect()->route('heads.index');
    }
}
