<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm sm:rounded-lg border border-[#F44171]">
                <div class="p-6">
                    <!-- En-tête -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-semibold text-[#F44171]">Gestion des Paiements</h1>
                        <p class="text-gray-600 mt-2">Vue d'ensemble de tous les paiements et remboursements</p>
                    </div>

                    <!-- Tableau -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#F44171]/10">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[#F44171]/10">
                                <thead>
                                    <tr class="bg-[#FFF9F9]">
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            ID Transaction
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Client
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Montant
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Titulaire de la carte
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Carte
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Expiration
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-700">
                                            Remboursement
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-[#F44171]/10">
                                    @forelse ($payments as $payment)
                                        <tr class="hover:bg-[#FFF9F9] transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                                {{ $payment['transaction_id'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="bg-[#F44171]/10 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                                        <span class="text-[#F44171] text-sm font-medium">
                                                            {{ substr($payment['user']->prenom, 0, 1) }}{{ substr($payment['user']->nom, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div class="text-sm">
                                                        <div class="font-medium text-gray-900">
                                                            {{ $payment['user']->prenom }} {{ $payment['user']->nom }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm">
                                                    @if ($payment['refunded'])
                                                        <div class="space-y-1">
                                                            <span class="line-through text-gray-500">
                                                                {{ number_format($payment['amount'], 2) }} €
                                                            </span>
                                                            <div class="flex items-center">
                                                                <span class="text-[#F44171] font-medium">
                                                                    {{ number_format($payment['refunded_amount'], 2) }} €
                                                                </span>
                                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F44171]/10 text-[#F44171]">
                                                                    Remboursé
                                                                </span>
                                                            </div>
                                                            <span class="text-sm text-gray-600">
                                                                Reste: {{ number_format($payment['amount'] - $payment['refunded_amount'], 2) }} €
                                                            </span>
                                                        </div>
                                                    @else
                                                        <span class="font-medium text-gray-900">
                                                            {{ number_format($payment['amount'], 2) }} €
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3 px-4 border-b border-[#F44171]/20">
                                                {{ $payment['titulaire_nom'] }} {{ $payment['titulaire_prenom'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-mono">
                                                    **** {{ $payment['card_number'] }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $payment['expiration_date'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('payments.refund', $payment['transaction_id']) }}"
                                                      method="POST"
                                                      class="flex items-center space-x-2">
                                                    @csrf
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">€</span>
                                                        </div>
                                                        <input type="number"
                                                               name="amount_refund"
                                                               step="0.01"
                                                               value="{{ old('amount_refund') }}"
                                                               class="pl-8 block w-32 border-[#F44171]/20 focus:ring-[#F44171] focus:border-[#F44171] rounded-lg text-sm"
                                                               placeholder="0.00"
                                                               {{ $payment['refunded'] ? 'disabled' : '' }}>
                                                    </div>
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-2 border border-[#F44171] text-sm font-medium rounded-lg text-[#F44171] hover:bg-[#F44171] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F44171] transition-colors duration-150"
                                                            {{ $payment['refunded'] ? 'disabled' : '' }}>
                                                        Rembourser
                                                    </button>
                                                </form>
                                                @error('amount_refund')
                                                    <p class="mt-1 text-sm text-[#F44171]">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-4xl mb-3">💳</span>
                                                    <p class="text-lg">Aucun paiement trouvé</p>
                                                    <p class="text-sm text-gray-400">Les paiements effectués apparaîtront ici</p>
                                                </div>
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
