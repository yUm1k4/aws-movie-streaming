<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class DashboardController extends Controller
{
    public function index()
    {
        // get movie where featured and order by
        $movies = Movie::where('featured', 1)->orderBy('featured', 'desc')->orderBy('created_at', 'desc')->get();
        // $movies = Movie::orderBy('featured', 'desc')->orderBy('created_at', 'desc')->get();

        return view('member.dashboard', compact('movies'));
    }
}
