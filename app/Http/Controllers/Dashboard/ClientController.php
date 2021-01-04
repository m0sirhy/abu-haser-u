<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only('create');
        $this->middleware(['permission:update_clients'])->only('edit');
        $this->middleware(['permission:delete_clients'])->only('destroy');
    
    }//end of constructor
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function($q) use ($request){

            return $q->where('full_name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');

        })->latest()->paginate(50);

        return view('dashboard.clients.index', compact('clients'));

    }//end of index

    public function create()
    {
        return view('dashboard.clients.create');

    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();

        Client::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of store

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));

    }//end of edit

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
  

        $client->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of update

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');

    }//end of destroy

}//end of controller
