<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Liste de tous les paiements</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-b">id de transaction</th>
                        <th class="py-2 px-4 border-b">Utilisateur</th>
                        <th class="py-2 px-4 border-b">Montant</th>
                        <th class="py-2 px-4 border-b">Numéro de carte</th>
                        <th class="py-2 px-4 border-b">Date d'expiration</th>
                        <th class="py-2 px-4 border-b">ajouter un remboursement (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $payment['transaction_id'] }}</td>
                            <td class="py-2 px-4 border-b">{{ $payment['user']->nom }} {{ $payment['user']->prenom }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                @if ($payment['refunded'] == true)
                                    <span class="line-through">{{ number_format($payment['amount'], 2) }} €</span>
                                    <br>
                                    <span class="text-green-500">{{ number_format($payment['refunded_amount'], 2) }} €
                                        Remboursé</span>
                                        <br>
                                        <span>
                                            {{ number_format($payment['amount'] - $payment['refunded_amount'], 2) }} €
                                            </span>
                                @else
                                    {{ number_format($payment['amount'], 2) }} €
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b whitespace-nowrap">**** {{ $payment['card_number'] }}</td>
                            <td class="py-2 px-4 border-b">{{ $payment['expiration_date'] }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($payment['refunded'] == true)
                                    <span class="text-green-500">
                                        {{ number_format($payment['refunded_amount'], 2) }} €
                                        Remboursé</span>
                                @endif
                                    <form action="{{ route('payments.refund', $payment['transaction_id']) }}" class="flex gap-1"
                                        method="POST">
                                        @csrf
                                        <input type="number" name="amount_refund" value="{{ old('amount_refund') }}" class="border border-gray-300 rounded px-3 py-2" placeholder="Montant à rembourser" required
                                        >
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            Rembourser
                                        </button>
                                        @if ($errors->has('amount_refund'))
                                            <span class="text-red-500 text-sm">{{ $errors->first('amount_refund') }}</span>
                                        @endif
                                    </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">Aucun paiement trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
