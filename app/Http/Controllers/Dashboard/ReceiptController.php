<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use App\Http\Controllers\Controller;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
  
    public function index(Request $request)
    {

        $receipts = Receipt::when($request->search, function ($q) use ($request) {

            return $q->where('supplier_id', 'like', '%'  . $request->search . '%');
        })->latest()->paginate(5);
        $clients=Client::get();
        $total =Receipt::sum('amount');
    
        return view('dashboard.receipts.index', compact('receipts','clients','total'));
    } //end of index

    public function create()
    {
        $clients=Client::get();
        return view('dashboard.receipts.create' ,compact('clients'));
    } //end of create

    public function store(Request $request)
    {

        $rules = [
            'clients_id'=>'required',
            'amount' => 'required|integer|min:1',
            'statment' => 'required',
        ];

        $request->validate($rules);
        $request_data = $request->all();
        $request_data+=['user_id'=>Auth::id()];


        Receipt::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.receipts.index');
    } //end of store

    public function edit(Receipt $receipt)
    {
        $clients=Client::get();

        return view('dashboard.receipts.edit', compact('payment','suppliers'));
    } //end of edit

    public function update(Request $request, Receipt $receipt)
    {
        $rules = [
            'client_id'=>'required',
            'amount' => 'required|integer|min:1',
            'statment' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();


        $receipt->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.receipts.index');
    } //end of update

    public function destroy(Receipt $receipt)
    {


        $receipt->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.receipts.index');
    } //end of destroy
}
