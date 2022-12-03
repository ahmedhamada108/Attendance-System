<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\departments;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $employees= employees::select('id','name','department_id')->with('department:id,name as dept_name')->get();
        return view('admin.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = departments::select('id','name')->get();
        return view('admin.employees.create',compact('departments'));
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
            'name' => 'required |unique:employees',
            'email' => 'required| email |unique:employees',
            'password' => 'required|min:6| confirmed',
            'department_id'=>'required',
        ]);
        $data= $request->except('password');
        $data['password']= bcrypt($request->password);
        employees::create($data);
        session()->flash('success', 'the students has been added');
        return redirect()->route('employees.index');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(employees $employees,$id)
    {
        $employee= employees::find($id);
        $departments= departments::select('id','name')->get();
        // return $employee;
        return view('admin.employees.show',compact(['employee','departments']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employees,$id)
    {
        $data= $request->validate([
            'name' => ['required', Rule::unique('employees')->ignore($id)],
            'email' => ['required','email', Rule::unique('employees')->ignore($id)],
            'department_id'=>'required',
        ]); 
        if($request->password){
            $data +=$request->validate([
                'password' => 'required|min:6| confirmed',
            ]);
            $data= $request->except('password');
            $data['password']= bcrypt($request->password);
        }
        employees::find($id)->update($data);
        session()->flash('success',__('this_employee_has_been_edited'));
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(employees $employees,$id)
    {
        employees::destroy($id);
        session()->flash('success',__('panel.departments.this_department_has_been_deleted'));
        return redirect()->route('employees.index');
    }
}
