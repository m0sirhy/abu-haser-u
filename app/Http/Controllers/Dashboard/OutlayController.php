<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Outlay;
use App\OutlayCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutlayController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_outlays'])->only('index');
        $this->middleware(['permission:create_outlays'])->only('create');
        $this->middleware(['permission:update_outlays'])->only('edit');
        $this->middleware(['permission:delete_outlays'])->only('destroy');
    } //end of constructor


    public function index(Request $request)
    {


        $outlays = Outlay::when($request->category_id, function ($q) use ($request) {

            return $q->where('outlay_category_id', $request->category_id);
        })->when($request->date, function ($q) use ($request) {
            $explode_date = explode('-', $request->date);
            $month = $explode_date[1];
            $year = $explode_date[0];
            return $q->whereYear('created_at',  $year)
                ->whereMonth('created_at',  $month);
        })->orderBy('outlay_category_id')->paginate(50);
        $categories = OutlayCategory::get();
        $total = $outlays->sum('amount');

        return view('dashboard.outlays.index', compact('outlays', 'categories',  'total'));
    } //end of index


    public function create()
    {
        $OutlayCategories = OutlayCategory::get();

        return view('dashboard.outlays.create', compact('OutlayCategories'));
    } //end of create

    public function store(Request $request)
    {

        $rules = [
            'outlay_category_id' => 'required',
            'amount' => 'required|integer|min:1',
            'payee' => 'required',
            'statment' => 'required',
        ];

        $request->validate($rules);
        $request_data = $request->all();
        $request_data += ['user_id' => Auth::id()];


        outlay::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.outlays.index');
    } //end of store

    public function edit(outlay $outlay)
    {
        return view('dashboard.outlays.edit', compact('outlay'));
    } //end of edit

    public function update(Request $request, outlay $outlay)
    {
        $rules = [
            'amount' => 'required|integer|min:1',
            'payee' => 'required',
            'statment' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();


        $outlay->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.outlays.index');
    } //end of update

    public function destroy(outlay $outlay)
    {


        $outlay->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.outlays.index');
    } //end of destroy


    public function cat(Request $request)
    {
        $categories = OutlayCategory::with('outlays')->get();
        $dates = Outlay::select(
            DB::raw('created_at as c'),

            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
        )->groupBy('year', 'month')->get();

        return view('dashboard.outlays.category', compact('categories', 'dates'));
    }
}//end of controller
