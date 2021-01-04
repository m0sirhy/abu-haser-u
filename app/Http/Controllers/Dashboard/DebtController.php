<?php

namespace App\Http\Controllers\Dashboard;

use App\Debt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $debts = Debt::when($request->search, function($q) use ($request){

            return $q->where('full_name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');

        })->latest()->paginate(50);

        return view('dashboard.debts.index', compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.debts.create');

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
      //
        $request->validate([
            'client' => 'required',
            'amount' => 'required',
        ]);

        $request_data = $request->all();

        Debt::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.debts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        return view('dashboard.debts.edit', compact('debt'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        //
        $request->validate([
            'client' => 'required',
            'amount' => 'required',
        ]);

        $request_data = $request->all();
  

        $debt->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.debts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        $debt->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.debts.index');
        
    }
}
