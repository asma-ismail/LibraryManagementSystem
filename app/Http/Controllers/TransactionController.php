<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->s) {
            //TODO how to search for email?
            //$trsansactions = Transaction::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);
            $transactions = Transaction::latest()->paginate(10);

        } else {
            $transactions = Transaction::latest()->paginate(10);
        }
        return view('admin.transactions', compact('transactions'));
    }
}
