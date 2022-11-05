<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Package;
use Illuminate\Support\Str;

// use App\Models\Movie;
// use App\Models\User;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $package = Package::find($request->package_id);
        $customer = auth()->user();
        if (empty($package))
            return redirect()->back()->with('error', 'Package not found');

        $transaction = Transaction::create([
            'package_id' => $package->id,
            'user_id' => $customer->id,
            'amount' => $package->price,
            'transaction_code' => strtoupper(Str::random(10)),
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = (bool) env('MIDTRANS_IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = (bool) env('MIDTRANS_IS_3DS');
        
        $params = [
            'transaction_details' => array(
                'order_id' => $transaction->transaction_code,
                'gross_amount' => $transaction->amount,
            ),
            'customer_details' => array(
                'first_name' => $customer->name,
                'last_name' => '',
                'email' => $customer->email,
            ),
        ];

        $createMidtransTransaction = \Midtrans\Snap::createTransaction($params);

        // get redirect url
        $midtransRedirectUrl = $createMidtransTransaction->redirect_url;

        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        return redirect($midtransRedirectUrl);
        
    }
}
