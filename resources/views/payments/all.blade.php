<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Liste de tous les paiements</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-b">Utilisateur</th>
                        <th class="py-2 px-4 border-b">Montant</th>
                        <th class="py-2 px-4 border-b">Numéro de carte</th>
                        <th class="py-2 px-4 border-b">Date d'expiration</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $payment['user']->nom }} {{ $payment['user']->prenom }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                @if ($payment['refunded'] == true)
                                    <span class="line-through">{{ number_format($payment['amount'], 2) }} €</span>
                                @else
                                    {{ number_format($payment['amount'], 2) }} €
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">**** {{ $payment['card_number'] }}</td>
                            <td class="py-2 px-4 border-b">{{ $payment['expiration_date'] }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($payment['refunded'] == true)
                                    <span class="text-green-500">Remboursé</span>
                                @else
                                    <form action="{{ route('payments.refund', $payment['transaction_id']) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            Rembourser
                                        </button>
                                    </form>
                                @endif
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
