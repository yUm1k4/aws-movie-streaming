<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $standardPackage = Package::where('name', 'Standard')->first();
        $goldPackage = Package::where('name', 'Gold')->first();

        return view('member.pricing', compact('standardPackage', 'goldPackage'));
    }
}
