<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;





class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = $user->payments->map(function ($payment) {
            return [
                'amount' => $payment->amount,
                'card_number' => substr($payment->card_number, 0, 4) . '****' . substr($payment->card_number, -4),
                'expiration_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $payment->expiration_date)->format('m/Y'),
                'refunded' => $payment->refunded,
            ];
        });

        return view('payments.index', compact('payments'));
    }
    public function allPayments()
    {

        $payments = Payment::all()->map(function ($payment) {
            return [
                'transaction_id' => $payment->transaction_id,
                'user' => $payment->user,
                'amount' => $payment->amount,
                'card_number' => '****' . substr($payment->card_number, -4),
                'expiration_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $payment->expiration_date)->format('m/Y'),
                'refunded' => $payment->refunded,
            ];
        });

        return view('payments.all', compact('payments'));
    }
    public function refund(Request $request, $transactionId)
    {

        $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();

        // Logique de remboursement (API d'un prestataire, ex : Stripe ou PayPal)

            $payment->refunded = true;
            $payment->save();
            return redirect()->back()->with('success', 'Remboursement effectué.');

    }
    public function create()
    {
        return view('payments.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'card_number' => 'required|string|size:16',
            'expiration_date' => 'required|date_format:m/y',
            'cvc' => 'required|string|size:3',
        ], [
            'amount.required' => 'Le montant est obligatoire.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être supérieur à 0.',
            'card_number.required' => 'Le numéro de carte est obligatoire.',
            'card_number.string' => 'Le numéro de carte doit être une chaîne de caractères.',
            'card_number.size' => 'Le numéro de carte doit contenir 16 chiffres.',
            'expiration_date.required' => 'La date d\'expiration est obligatoire.',
            'expiration_date.date_format' => 'La date d\'expiration doit être au format mm/aa.',
            'cvc.required' => 'Le code CVC est obligatoire.',
            'cvc.string' => 'Le code CVC doit être une chaîne de caractères.',
            'cvc.size' => 'Le code CVC doit contenir 3 chiffres.',
        ]);

        // Simuler l'enregistrement (attention aux données sensibles)
        $transactionId = '2024-' . (Payment::max('id') + 1);

        Payment::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'card_number' => substr($validated['card_number'], 0, 4) . '********' . substr($validated['card_number'], -4),
            'expiration_date' => \Carbon\Carbon::createFromFormat('m/y', $validated['expiration_date']),
            'cvv' => $validated['cvc'],
            'transaction_id' => $transactionId,
        ]);

        return redirect()->route('payments.index')->with('success', 'Paiement enregistré avec succès.');
    }
}
