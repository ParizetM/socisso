<x-app-layout>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Effectuer un Paiement</h1>
    <form action="{{ route('payments.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-bold mb-2">Montant (€)</label>
            <input type="number" name="amount" id="amount" step="0.01" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label for="card_number" class="block text-gray-700 font-bold mb-2">Numéro de carte</label>
            <input type="text" name="card_number" id="card_number" maxlength="16" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label for="expiration_date" class="block text-gray-700 font-bold mb-2">Date d'expiration (MM/AA)</label>
            <input type="text" name="expiration_date" id="expiration_date" placeholder="MM/AA" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label for="cvc" class="block text-gray-700 font-bold mb-2">Code CVC</label>
            <input type="text" name="cvc" id="cvc" maxlength="3" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Payer</button>
    </form>
</div>
</x-app-layout>
