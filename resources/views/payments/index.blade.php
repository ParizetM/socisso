<x-app-layout>
    @can('admin')
        @php
            header('Location: /admin/payments');
        @endphp
    @endcan
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm sm:rounded-lg border border-[#F44171]">
                <div class="p-6">
                    <!-- En-tête -->
                    <div class="mb-8 flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-semibold text-[#F44171]">Mes Paiements</h1>
                            <p class="text-gray-600 mt-2">Vue d'ensemble de vos paiements et remboursements</p>
                        </div>
                        <a href="{{ route('payments.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#F44171] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#F44171]/90 focus:bg-[#F44171]/90 active:bg-[#F44171]/80 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
                            Créer un paiement
                        </a>
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
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-[#F44171]/10">
                                    @forelse ($payments as $payment)
                                        <tr class="hover:bg-[#FFF9F9] transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                                {{ $payment['transaction_id'] }}
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
                                                                    Remboursé le {{ \Carbon\Carbon::parse($payment['refunded_at'])->format('d/m/Y') }}
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
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="bg-[#F44171]/10 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                                        <span class="text-[#F44171] text-sm font-medium">
                                                            {{ substr($payment['titulaire_prenom'], 0, 1) }}{{ substr($payment['titulaire_nom'], 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $payment['titulaire_nom'] }} {{ $payment['titulaire_prenom'] }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-mono">
                                                    {{ $payment['card_number'] }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $payment['expiration_date'] }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
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
