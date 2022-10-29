<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with([
            'package', 'user' // berasal dari method di model transaction
        ])->get();
        return view('admin.transactions.index', compact('transactions'));
    }
}
