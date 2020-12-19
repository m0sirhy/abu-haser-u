<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Outlay;
use App\OutlayCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutlayCategoryController extends Controller
{
    //
    //
    public function index(Request $request)
    {

        $dates = Outlay::select(
            DB::raw('created_at as c'),

            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
        )->groupBy('year','month')->get();



        $categories = OutlayCategory::get();
       

        $categories = OutlayCategory::when($request->search, function ($q) use ($request) {
        })->when($request->date, function ($q) use ($request) {
          /*  whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
*/
            return $q->whereYear('created_at',  $request->date)
            ->whereMonth('created_at',  $request->month);
        })->latest()->paginate(50);
        return view('dashboard.outlay_categories.index', compact('categories', 'dates'));
    } //end of index

    public function create()
    {
        return view('dashboard.outlay_categories.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [];


        $request->validate($rules);

        OutlayCategory::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.outlay_categories.index');
    } //end of store

    public function edit(OutlayCategory $OutlayCategory)
    {

        return view('dashboard.outlay_categories.edit', compact('OutlayCategory'));
    } //end of edit

    public function update(Request $request, OutlayCategory $OutlayCategory)
    {
        $rules = [];

        $request->validate($rules);

        $OutlayCategory->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.outlay_categories.index');
    } //end of update

    public function destroy(OutlayCategory $OutlayCategory)
    {
        $OutlayCategory->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.outlay_categories.index');
    } //end of destroy
}
