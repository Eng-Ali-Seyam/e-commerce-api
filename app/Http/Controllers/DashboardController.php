<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.home');
    }
    public function admin()
    {

        $users = User::all();

        return view('dashboard.users',compact('users'));
    }
    public function all_products()
    {
        return view('dashboard.all_products');
    }
    public function add_product()
    {

        $categories = Category::all();
        return view('dashboard.add_products',compact('categories'));
    }

    public function categories()
    {

        return view('dashboard.categories.categories');
    }
}
