@props(['title', 'description'])

<div class="bg-white p-6 rounded-lg shadow border border-[#F44171]/20 hover:border-[#F44171] transition-colors duration-150">
    <h2 class="text-2xl font-semibold text-[#F44171] mb-4">{{ $title }}</h2>
    <p class="text-gray-600">{{ $description }}</p>
</div>
