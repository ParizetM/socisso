<x-app-layout>
    <div class="min-h-screen bg-[#FFF9F9] flex flex-col">
        <!-- Hero Section -->
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-[#F44171] mb-4">
                        {{ __('Bienvenue sur Socisso') }}
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ __('Les Socisso n\'importe quoi !') }}
                    </p>
                </div>

                <!-- Système de filtres -->
                <div class="flex justify-center gap-4 mb-8">
                    <button data-filter="all"
                            class="filter-btn px-6 py-2 rounded-full bg-[#F44171] text-white transition-colors duration-150 border border-[#F44171]">
                        Tous
                    </button>
                    <button data-filter="sale"
                            class="filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150 border border-[#F44171]">
                        Salés
                    </button>
                    <button data-filter="sweet"
                            class="filter-btn px-6 py-2 rounded-full bg-white text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150 border border-[#F44171]">
                        Sucrés
                    </button>
                </div>

                <!-- Main Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($products as $product)
                        <!-- Product Card -->
                        <div class="product-card bg-white p-8 rounded-lg shadow-lg border border-[#F44171]/20 hover:border-[#F44171] transition-colors duration-150"
                             data-type="{{ $product->is_sale ? 'sale' : 'sweet' }}">
                            <div class="aspect-w-16 aspect-h-9 mb-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover rounded-lg w-full h-48">
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-2xl font-semibold text-[#F44171]">
                                    {{ $product->name }}
                                </h2>
                                <span class="px-3 py-1 rounded-full text-sm {{ $product->is_sale ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $product->is_sale ? 'Salé' : 'Sucré' }}
                                </span>
                            </div>

                            <p class="text-gray-600 h-24 overflow-hidden">
                                {{ $product->description }}
                            </p>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xl font-bold text-[#F44171]">{{ number_format($product->price, 2) }} €</span>
                                <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    @if($product->stock > 0)
                                        En stock
                                    @else
                                        Rupture de stock
                                    @endif
                                </span>
                            </div>

                            @auth
                                <button onclick="window.location.href='{{ route('payments.index', ['product' => $product->id]) }}'"
                                        @if($product->stock === 0) disabled @endif
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150 {{ $product->stock === 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    {{ $product->stock > 0 ? __('Commander') : __('Indisponible') }}
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full inline-flex justify-center items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                    {{ __('Se connecter pour commander') }}
                                </a>
                            @endauth
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-600 text-lg">Aucun produit trouvé dans cette catégorie.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const productCards = document.querySelectorAll('.product-card');

            function filterProducts(filterType) {
                let visibleProducts = 0;

                productCards.forEach(card => {
                    if (filterType === 'all' || card.dataset.type === filterType) {
                        card.style.display = '';
                        visibleProducts++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                filterButtons.forEach(btn => {
                    if (btn.dataset.filter === filterType) {
                        btn.classList.remove('bg-white', 'text-gray-700');
                        btn.classList.add('bg-[#F44171]', 'text-white');
                    } else {
                        btn.classList.remove('bg-[#F44171]', 'text-white');
                        btn.classList.add('bg-white', 'text-gray-700');
                    }
                });
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const filterType = button.dataset.filter;
                    filterProducts(filterType);
                });
            });
        });
    </script>
</x-app-layout>
