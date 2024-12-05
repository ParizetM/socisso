@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#F44171]/20 focus:border-[#F44171] focus:ring-[#F44171] rounded-md shadow-sm']) }}>
