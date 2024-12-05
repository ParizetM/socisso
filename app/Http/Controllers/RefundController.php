<?php
namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\Payment;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function store(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|max:' . $payment->amount,
        ]);

        $payment->refunds()->create($request->all());
        return redirect()->route('admin.payments.index');
    }
}
