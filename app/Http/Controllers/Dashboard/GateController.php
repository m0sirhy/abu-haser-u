<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ConsumptionCycleExport;
use App\Imports\ConsumptionCycleImport;
use Maatwebsite\Excel\Facades\Excel;

class GateController extends Controller
{
    //
    public function importExport()
    {
       return view('dashboard.import_export');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ConsumptionCycleExport, 'Consumption.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ConsumptionCycleImport,request()->file('file'));
        session()->flash('success', __('site.imported_successfully'));

        
        return back();
    }
}
