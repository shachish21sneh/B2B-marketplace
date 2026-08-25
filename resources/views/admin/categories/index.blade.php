@extends('layouts.dashboard')

@section('title', 'Categories Taxonomy Management - Super Admin')
@section('page_title', 'Industry Categories & Taxonomy')
@section('page_subtitle', 'Organize marketplace product hierarchy, icons and category banners.')

@section('content')

    <div class="space-y-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Add New Category Form (4 Cols) -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold font-heading text-slate-900 border-b border-slate-100 pb-3">
                        Add New Category
                    </h3>

                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Category Name *</label>
                            <input type="text" name="name" required placeholder="e.g. Industrial Automation & Robotics" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">FontAwesome Icon Class</label>
                            <input type="text" name="icon" placeholder="fa-solid fa-robot" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Category Image URL</label>
                            <input type="text" name="image" placeholder="https://images.unsplash.com/..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Description</label>
                            <textarea name="description" rows="2" placeholder="Brief category summary..." class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none"></textarea>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_featured" value="1" id="catFeatured" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <label for="catFeatured" class="text-xs font-semibold text-slate-700">Display on Homepage</label>
                        </div>

                        <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                            Create Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Categories List Table (8 Cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 border-b border-slate-200 uppercase tracking-wider text-[10px]">
                                    <th class="py-4 px-6 font-bold">Category</th>
                                    <th class="py-4 px-4 font-bold">Subcategories</th>
                                    <th class="py-4 px-4 font-bold">Products</th>
                                    <th class="py-4 px-4 font-bold">Featured</th>
                                    <th class="py-4 px-6 font-bold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @foreach($categories as $cat)
                                    <tr class="hover:bg-slate-50/60 transition">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-sm flex-shrink-0">
                                                    <i class="{{ $cat->icon ?: 'fa-solid fa-folder' }}"></i>
                                                </div>
                                                <div>
                                                    <a href="{{ route('category.show', $cat->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-brand-600">
                                                        {{ $cat->name }}
                                                    </a>
                                                    <span class="text-[10px] text-slate-400 block">{{ $cat->slug }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 font-semibold text-slate-600">{{ $cat->subcategories->count() }} Subcategories</td>
                                        <td class="py-4 px-4 font-bold text-slate-900">{{ $cat->products->count() }} Products</td>
                                        <td class="py-4 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $cat->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500' }}">
                                                {{ $cat->is_featured ? 'Featured' : 'Standard' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this category?');">
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
