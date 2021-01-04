<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        $Employee = Employee::get();
        return view('admin.Employee.create' , compact('Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Employee =  Employee::create([
            'full_name' => $request['company_name'],
            'gender' => $request['address'],
            'birth_date' => $request['company_phone'],
            'hire_date' => $request['company_lat'],
        ]);

        return back()->with(['type' => 'success' , 'message' => 'save Successful']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Employee::find($id);
            return redirect()->route('admin.dashboard');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Employee = Employee::find($id);
        return view('admin.Employee.edit' , compact('Employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Employee =Employee::get();
        $update = $Employee->update(array(
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'hire_date'  => $request->hire_date,
        ));

        if ($update) {
            return back()->with(['type' => 'success' , 'message' =>'updated Success']);
        }else {
            return back()->with(['type' => 'danger' , 'message' =>'updated Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
