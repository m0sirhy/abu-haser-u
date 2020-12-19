<?php

namespace App\Http\Controllers\Dashboard;

use App\ConsumptionCycle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumeController extends Controller
{
    //
    public function index(Request $request)
    {


        return view('dashboard.consumes.index');
    } //end of index

    public function empty(Request $request)
    {
        $clients = ConsumptionCycle::Where('curent', 0)->latest()->orderByDesc('address')->paginate(100);

        return view('dashboard.consumes.empty');
    } //end of empty
    public function wrong(Request $request)
    {
        return view('dashboard.consumes.wrong');
    } //end of wrong
    public function disc(Request $request)
    {
        return view('dashboard.consumes.disc');
    } //end of disc
    
}
