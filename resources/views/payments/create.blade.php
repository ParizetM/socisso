<x-app-layout>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Effectuer un Paiement</h1>
    <form action="{{ route('payments.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-bold mb-2">Montant (€)</label>
            <input type="number" name="amount" id="amount" step="0.01" required class="w-full border border-gray-300 rounded px-3 py-2" placeholder="0.00" value="{{ old('amount') }}">
            @error('amount')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="card_number" class="block text-gray-700 font-bold mb-2">Numéro de carte</label>
            <input type="text" name="card_number" id="card_number" maxlength="19" required class="w-full border border-gray-300 rounded px-3 py-2" placeholder="xxxx xxxx xxxx xxxx" value="{{ old('card_number') }}">
            @error('card_number')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <script>
            document.getElementById('card_number').addEventListener('input', function (e) {
                let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formattedValue += ' ';
                    }
                    formattedValue += value[i];
                }
                e.target.value = formattedValue;
            });
        </script>
        <div class="mb-4">
            <label for="expiration_date" class="block text-gray-700 font-bold mb-2">Date d'expiration (MM/AA)</label>
            <input type="text" name="expiration_date" id="expiration_date" placeholder="MM/AA" required class="w-full border border-gray-300 rounded px-3 py-2" maxlength="5" value="{{ old('expiration_date') }}">
            @error('expiration_date')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <script>
            document.getElementById('expiration_date').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
            });

            document.getElementById('expiration_date').addEventListener('blur', function (e) {
            let value = e.target.value;
            let [month, year] = value.split('/');
            if (month && year) {
                let inputDate = new Date(`20${year}`, month - 1);
                let currentDate = new Date();
                if (inputDate < currentDate) {
                alert('La date d\'expiration ne peut pas être inférieure à la date actuelle.');
                e.target.value = '';
                }
            }
            });
        </script>
        <div class="mb-4">
            <label for="cvc" class="block text-gray-700 font-bold mb-2">Code CVC</label>
            <input type="text" name="cvc" id="cvc" maxlength="3" required class="w-full border border-gray-300 rounded px-3 py-2" placeholder="123" value="{{ old('cvc') }}">
            @error('cvc')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
            <div class="mb-4">
                <label for="captcha" class="block text-gray-700 font-bold mb-2">Captcha</label>
                <div>
                <img src="{{ Captcha::src('mini') }}" alt="captcha" class="mb-2">
                <input type="text" name="captcha" id="captcha" required class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Entrez le captcha">
                </div>
                @error('captcha')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Payer</button>
    </form>
</div>
</x-app-layout>

