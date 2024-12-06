<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm sm:rounded-lg border border-[#F44171]">
                <div class="p-6">
                    <div class="flex flex-col space-y-4">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-semibold text-[#F44171]">Mes Paiements</h1>
                            <a href="{{ route('payments.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                Créer un paiement
                            </a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full bg-white border border-[#F44171]/20 rounded-lg">
                                <thead>
                                    <tr class="bg-[#FFF9F9] text-gray-700">
                                        <th class="py-3 px-4 border-b border-[#F44171]/20 text-left">ID de transaction</th>
                                        <th class="py-3 px-4 border-b border-[#F44171]/20 text-left">Montant</th>
                                        <th class="py-3 px-4 border-b border-[#F44171]/20 text-left">Numéro de carte</th>
                                        <th class="py-3 px-4 border-b border-[#F44171]/20 text-left">Date d'expiration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $payment)
                                        <tr class="hover:bg-[#FFF9F9] transition-colors duration-150">
                                            <td class="py-3 px-4 border-b border-[#F44171]/20">
                                                {{ $payment['transaction_id'] }}
                                            </td>
                                            <td class="py-3 px-4 border-b border-[#F44171]/20">
                                                @if ($payment['refunded'] == true)
                                                    <div class="space-y-1">
                                                        <span class="line-through text-gray-500">
                                                            {{ number_format($payment['amount'], 2) }} €
                                                        </span>
                                                        <span class="block text-[#F44171]">
                                                            {{ number_format($payment['refunded_amount'], 2) }} € Remboursé le
                                                            {{ \Carbon\Carbon::parse($payment['refunded_at'])->format('d/m/Y') }}
                                                        </span>
                                                        <span class="block font-medium">
                                                            Reste : {{ number_format($payment['amount'] - $payment['refunded_amount'], 2) }} €
                                                        </span>
                                                    </div>
                                                @else
                                                    <span class="font-medium">{{ number_format($payment['amount'], 2) }} €</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 border-b border-[#F44171]/20">
                                                <span class="font-mono">{{ $payment['card_number'] }}</span>
                                            </td>
                                            <td class="py-3 px-4 border-b border-[#F44171]/20">
                                                {{ $payment['expiration_date'] }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-8 px-4 text-center text-gray-500 border-b border-[#F44171]/20">
                                                Aucun paiement trouvé.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
