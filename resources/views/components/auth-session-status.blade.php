@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-[#F44171]']) }}>
        {{ $status }}
    </div>
@endif
