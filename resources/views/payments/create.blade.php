<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm">
                <div class="p-6">
                    <!-- En-tête -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-semibold text-[#F44171]">Effectuer un Paiement</h1>
                        <p class="text-gray-600 mt-2">Remplissez les informations ci-dessous pour finaliser votre
                            paiement</p>
                    </div>

                    <div class="max-w-2xl mx-auto">
                        <!-- Carte de paiement -->
                        <div
                            class="bg-gradient-to-r from-[#F44171] to-[#F44171]/80 p-6 rounded-xl shadow-lg mb-8 text-white">
                            <div class="flex justify-between items-start mb-8">
                                <div class="space-y-1">
                                    <p class="text-sm opacity-80">Numéro de carte</p>
                                    <p class="font-mono text-xl" id="card-preview">•••• •••• •••• ••••</p>
                                </div>
                                <div class="text-3xl">💳</div>
                            </div>
                            <div class="flex justify-between items-end">
                                <div class="space-y-1">
                                    <p class="text-sm opacity-80">Titulaire</p>
                                    <p class="font-medium">XXXXX XXXXX</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm opacity-80">Expire</p>
                                    <p class="font-medium" id="expiry-preview">MM/AA</p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire -->
                        <form action="{{ route('payments.store') }}" method="POST"
                            class="bg-white rounded-xl shadow-lg p-8 space-y-6">
                            @csrf

                            <!-- Montant -->
                            <div class="space-y-2">
                                <label for="amount" class="block text-sm font-medium text-gray-700">
                                    Montant à payer
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" name="amount" id="amount" step="0.01" required
                                        class="pl-8 w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="0.00" value="{{ old('amount') }}">
                                </div>
                                @error('amount')
                                    <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="titulaire_nom" class="block text-sm font-medium text-gray-700">
                                        Nom du titulaire
                                    </label>
                                    <input type="text" name="titulaire_nom" id="titulaire_nom"
                                        required
                                        class="w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="Nom" value="{{ old('titulaire_nom') }}">
                                    @error('titulaire_nom')
                                        <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="titulaire_prenom" class="block text-sm font-medium text-gray-700">
                                        prenom du titulaire
                                    </label>
                                    <input type="text" name="titulaire_prenom" id="titulaire_prenom"  required
                                        class="w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="prénom" value="{{ old('titulaire_prenom') }}">
                                    @error('titulaire_prenom')
                                        <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- Numéro de carte -->
                            <div class="space-y-2">
                                <label for="card_number" class="block text-sm font-medium text-gray-700">
                                    Numéro de carte
                                </label>
                                <input type="text" name="card_number" id="card_number" maxlength="19" required
                                    class="w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                    placeholder="1234 5678 9012 3456" value="{{ old('card_number') }}">
                                @error('card_number')
                                    <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date d'expiration et CVC -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="expiration_date" class="block text-sm font-medium text-gray-700">
                                        Date d'expiration
                                    </label>
                                    <input type="text" name="expiration_date" id="expiration_date" maxlength="5"
                                        required
                                        class="w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="MM/AA" value="{{ old('expiration_date') }}">
                                    @error('expiration_date')
                                        <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="cvc" class="block text-sm font-medium text-gray-700">
                                        Code CVC
                                        <span class="ml-1 text-gray-400"
                                            title="Le code à 3 chiffres au dos de votre carte">ℹ️</span>
                                    </label>
                                    <input type="text" name="cvc" id="cvc" maxlength="3" required
                                        class="w-full border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="123" value="{{ old('cvc') }}">
                                    @error('cvc')
                                        <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Captcha -->
                            <div class="space-y-2">
                                <label for="captcha" class="block text-sm font-medium text-gray-700">
                                    Vérification de sécurité
                                </label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ Captcha::src('mini') }}" alt="captcha" class="rounded-lg">
                                    <input type="text" name="captcha" id="captcha" required
                                        class="flex-1 border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-lg shadow-sm"
                                        placeholder="Entrez le code ci-contre">
                                </div>
                                @error('captcha')
                                    <p class="text-sm text-[#F44171]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="flex items-center justify-end gap-4 pt-4">
                                <a href="{{ route('payments.index') }}"
                                    class="px-6 py-3 border border-[#F44171]/20 rounded-lg font-medium text-gray-700 hover:bg-[#FFF9F9] focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition-all duration-200">
                                    Annuler
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-[#F44171] rounded-lg font-medium text-white hover:bg-[#F44171]/90 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition-all duration-200">
                                    Payer maintenant
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Aperçu du nom prénom du titulaire en direct
        document.getElementById('titulaire_nom').addEventListener('input', updateCardHolder);
        document.getElementById('titulaire_prenom').addEventListener('input', updateCardHolder);

        function updateCardHolder() {
            const nom = document.getElementById('titulaire_nom').value.toUpperCase();
            const prenom = document.getElementById('titulaire_prenom').value.toUpperCase();
            let displayText = 'XXXXX XXXXX';

            if (nom || prenom) {
                displayText = '';
                if (prenom) {
                    displayText += prenom;
                }
                if (nom && prenom) {
                    displayText += ' ';
                }
                if (nom) {
                    displayText += nom;
                }
            }

            // Limiter la longueur maximale pour éviter le débordement
            if (displayText.length > 40) {
                displayText = displayText.substring(0, 40) + '...';
            }

            // Mettre à jour l'affichage sur la carte
            document.querySelector('.flex.justify-between.items-end .font-medium').textContent = displayText;
        }
        // Aperçu du numéro de carte en direct
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = '';
            let preview = '';

            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                    preview += ' ';
                }
                formattedValue += value[i];
                preview += value[i];
            }

            // Compléter avec des points
            while (preview.length < 19) {
                if (preview.length > 0 && preview.length % 5 === 0) {
                    preview += ' ';
                }
                preview += '•';
            }

            e.target.value = formattedValue;
            document.getElementById('card-preview').textContent = preview;
        });

        // Aperçu et validation de la date d'expiration
        document.getElementById('expiration_date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
            document.getElementById('expiry-preview').textContent = value || 'MM/AA';
        });

        document.getElementById('expiration_date').addEventListener('blur', function(e) {
            let value = e.target.value;
            let [month, year] = value.split('/');
            if (month && year) {
                let inputDate = new Date(`20${year}`, month - 1);
                let currentDate = new Date();
                if (inputDate < currentDate) {
                    alert('La date d\'expiration ne peut pas être inférieure à la date actuelle.');
                    e.target.value = '';
                    document.getElementById('expiry-preview').textContent = 'MM/AA';
                }
            }
        });

        // Restriction aux chiffres pour le CVC
        document.getElementById('cvc').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</x-app-layout>
