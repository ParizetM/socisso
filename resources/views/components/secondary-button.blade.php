<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-[#F44171]/20 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-[#FFF9F9] focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
