<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#F44171] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#F44171]/90 focus:bg-[#F44171]/90 active:bg-[#F44171]/80 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
