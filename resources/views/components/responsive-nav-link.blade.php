@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#F44171] text-start text-base font-medium text-[#F44171] bg-[#FFF9F9] focus:outline-none focus:text-[#F44171] focus:bg-[#FFF9F9] focus:border-[#F44171] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-[#F44171] hover:bg-[#FFF9F9] hover:border-[#F44171]/20 focus:outline-none focus:text-[#F44171] focus:bg-[#FFF9F9] focus:border-[#F44171]/20 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
