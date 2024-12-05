<!-- resources/views/admin/payments/index.blade.php -->
<x-app-layout>
<div class="container">
    <h1>Liste des Paiements</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Montant</th>
                <th>Numéro de carte</th>
                <th>Date d'expiration</th>
                <th>Date de paiement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user->name }}</td>
                <td>{{ $payment->amount }}</td>
                <td>****{{ substr($payment->card_number, -4) }}</td>
                <td>{{ $payment->card_expiry }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>
                    <form action="{{ route('admin.payments.refund', $payment) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rembourser</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
