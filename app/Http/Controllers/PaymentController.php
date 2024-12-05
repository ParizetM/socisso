<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Auth::user()->payments;
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'card_number' => 'required|string',
            'card_expiry' => 'required|string',
        ]);

        Auth::user()->payments()->create($request->all());
        return redirect()->route('payments.index');
    }
    public function adminIndex()
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }
}
