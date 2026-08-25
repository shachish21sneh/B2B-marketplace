@props(['level' => 'None', 'size' => 'sm'])

@php
    $classes = match($level) {
        'Premium' => 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-sm shadow-amber-500/20',
        'KYC' => 'bg-indigo-600 text-white shadow-sm shadow-indigo-500/20',
        'GST' => 'bg-emerald-600 text-white shadow-sm shadow-emerald-500/20',
        'Business' => 'bg-blue-600 text-white',
        'Email', 'Mobile' => 'bg-slate-600 text-white',
        default => 'bg-slate-200 text-slate-700',
    };

    $icon = match($level) {
        'Premium' => 'fa-crown',
        'KYC' => 'fa-shield-halved',
        'GST' => 'fa-certificate',
        'Business' => 'fa-building-circle-check',
        'Email' => 'fa-envelope-circle-check',
        'Mobile' => 'fa-phone-volume',
        default => 'fa-circle-check',
    };
@endphp

@if($level && $level !== 'None')
    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wide uppercase {{ $classes }}">
        <i class="fa-solid {{ $icon }} text-[9px]"></i>
        <span>{{ $level }} Verified</span>
    </span>
@endif
