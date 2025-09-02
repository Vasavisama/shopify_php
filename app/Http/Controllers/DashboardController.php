<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Theme;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stores = Store::with('theme')->latest()->get();
        $productsCount = Product::count();
        $themesCount = Theme::count();

        return view('admin.dashboard', compact('stores', 'productsCount', 'themesCount'));
    }

    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        $stores = Store::all();

        return view('dashboard.user', compact('stores'));
    }
}
