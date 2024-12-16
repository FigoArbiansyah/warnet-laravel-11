<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $computerCount = DB::table('computers')->count();
        $userCount = DB::table('users')->where('role', 'user')->count();

        return view('pages.dashboard.admin', compact(
            'computerCount', 'userCount',
        ));
    }
}
