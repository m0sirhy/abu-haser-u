<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Outlay;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        // $categories_count = Category::count();
        // $products_count = Product::count();
        // $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();
        // $suppliers_count = Supplier::count();

        $sales_data = Outlay::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as sum')
        )->groupBy('month')->get();
        return view('dashboard.welcome', compact('users_count','sales_data'));
    } //end of index

}//end of controller
