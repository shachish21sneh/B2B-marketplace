@extends('layouts.dashboard')

@section('title', 'Advertisements & Hero Banners - Super Admin')
@section('page_title', 'Advertisements & Banners')
@section('page_subtitle', 'Manage sponsored hero banners, category promotions and marketing slots.')

@section('content')

    <div class="space-y-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Add New Advertisement Banner Form (4 Cols) -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Create Advertisement Slot
                    </h3>

                    <form action="{{ route('admin.advertisements.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Banner Title *</label>
                            <input type="text" name="title" required placeholder="e.g. National Machineries Expo 2026" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Placement Position *</label>
                            <select name="position" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                                <option value="hero_banner">Homepage Hero Carousel</option>
                                <option value="category_top">Category Top Leaderboard</option>
                                <option value="sidebar">Product Detail Sidebar</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Banner Image URL *</label>
                            <input type="text" name="image" required placeholder="https://images.unsplash.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Click URL</label>
                            <input type="text" name="link_url" placeholder="/products or https://..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Start Date</label>
                                <input type="date" name="start_date" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">End Date</label>
                                <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime('+30 days')) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                            Publish Advertisement
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Ads Table (8 Cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                                    <th class="py-4 px-6 font-bold">Banner</th>
                                    <th class="py-4 px-4 font-bold">Position</th>
                                    <th class="py-4 px-4 font-bold">Duration</th>
                                    <th class="py-4 px-4 font-bold">Status</th>
                                    <th class="py-4 px-6 font-bold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @foreach($advertisements as $ad)
                                    <tr class="hover:bg-slate-50/60 transition">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $ad->image }}" class="w-14 h-9 rounded-lg object-cover border border-slate-200 flex-shrink-0">
                                                <div>
                                                    <strong class="text-slate-900 block font-bold">{{ $ad->title }}</strong>
                                                    <span class="text-[10px] text-slate-400 truncate max-w-xs block">{{ $ad->link_url }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 font-bold uppercase text-[10px] text-brand-600">{{ str_replace('_', ' ', $ad->position) }}</td>
                                        <td class="py-4 px-4 text-slate-500">
                                            {{ $ad->start_date ? $ad->start_date->format('M d') : 'Now' }} - {{ $ad->end_date ? $ad->end_date->format('M d, Y') : 'Ongoing' }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $ad->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                                {{ $ad->is_active ? 'Active' : 'Paused' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('admin.advertisements.destroy', $ad->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this advertisement?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1.5 bg-slate-100 hover:bg-red-50 hover:text-red-600 rounded-xl font-bold text-xs transition">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
