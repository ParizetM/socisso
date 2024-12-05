<!-- resources/views/payments/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mes Paiements</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-b">Montant</th>
                        <th class="py-2 px-4 border-b">Numéro de carte</th>
                        <th class="py-2 px-4 border-b">Date d'expiration</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">
                                @if ($payment['refunded'] == true)
                                    <span class="line-through">{{ number_format($payment['amount'], 2) }} €</span> <span class="text-green-500">Remboursé</span>
                                @else
                                    {{ number_format($payment['amount'], 2) }} €
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $payment['card_number'] }}</td>
                            <td class="py-2 px-4 border-b">{{ $payment['expiration_date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-4 text-center text-gray-500">Aucun paiement trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('payments.create') }}" class="p-4 bg-white rounded-lg border text-[#F44171] border-[#F44171]/20 hover:bg-[#F44171] hover:text-white transition-colors duration-150 wi">
            <h3 class="text-lg font-medium text-center">Créer un paiment</h3>
        </a>
    </div>
</x-app-layout>
