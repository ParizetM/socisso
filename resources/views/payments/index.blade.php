<!-- resources/views/payments/index.blade.php -->
<x-app-layout>

<div class="container">
    <h1>Mes Paiements</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Montant</th>
                <th>Numéro de carte</th>
                <th>Date d'expiration</th>
                <th>Date de paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->amount }}</td>
                <td>{{ substr($payment->card_number, 0, 4) }}****{{ substr($payment->card_number, -4) }}</td>
                <td>{{ $payment->card_expiry }}</td>
                <td>{{ $payment->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
