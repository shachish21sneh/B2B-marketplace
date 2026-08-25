@extends('layouts.app')

@section('title', 'Verified Manufacturers & Suppliers in ' . $city . ' - NexTrade')
@section('meta_description', 'Find verified industrial suppliers, manufacturers, exporters and wholesale dealers located in ' . $city . '.')

@section('content')

    <div class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-brand-400">Industrial City Hub</span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading text-white mt-1">
                Verified Suppliers in {{ $city }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-2">Connect with leading factories, traders, and manufacturing plants located in {{ $city }}.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($suppliers as $supplier)
                <x-supplier_card :supplier="$supplier" />
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800">No registered suppliers in {{ $city }} yet</h3>
                    <p class="text-xs text-slate-500 mt-1">Are you a manufacturer or supplier in {{ $city }}? Register your company today!</p>
                    <a href="{{ route('supplier.register') }}" class="mt-4 inline-block px-5 py-2.5 bg-brand-600 text-white font-bold text-xs rounded-xl">Register as Supplier</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $suppliers->links() }}
        </div>
    </div>

@endsection
