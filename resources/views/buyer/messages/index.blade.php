@extends('layouts.dashboard')

@section('title', 'Buyer Messages & Live Chat - Ozura')
@section('page_title', 'Messages & Live Chat')
@section('page_subtitle', 'Instant WhatsApp-style messaging with verified suppliers.')

@section('content')

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col md:flex-row h-[75vh]">
        
        <!-- Left Panel: Contacts List (35% width) -->
        <div class="w-full md:w-80 lg:w-96 border-r border-slate-200 flex flex-col bg-slate-50/50 flex-shrink-0">
            
            <div class="p-4 border-b border-slate-200 bg-white">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    <input type="text" id="contactSearch" placeholder="Search suppliers or chats..." class="w-full pl-9 pr-4 py-2 bg-slate-100 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                </div>
            </div>

            <!-- Contacts Scrollable List -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-100" id="contactsContainer">
                @forelse($contacts as $c)
                    @php
                        $isActive = $activeContact && $activeContact->id == $c->id;
                    @endphp
                    <a href="{{ route('buyer.messages', ['user' => $c->id]) }}" class="flex items-center gap-3 p-4 hover:bg-slate-100 transition relative {{ $isActive ? 'bg-brand-50/80 border-l-4 border-brand-600' : '' }}">
                        
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-brand-600 to-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm flex-shrink-0 relative">
                            {{ strtoupper(substr($c->supplier ? $c->supplier->company_name : $c->name, 0, 1)) }}
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white"></span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <h4 class="text-xs font-bold text-slate-900 truncate">
                                    {{ $c->supplier ? $c->supplier->company_name : $c->name }}
                                </h4>
                                @if($c->last_message)
                                    <span class="text-[9px] text-slate-400 flex-shrink-0">
                                        {{ $c->last_message->created_at->format('h:i A') }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between gap-2 mt-1">
                                <p class="text-[11px] text-slate-500 truncate">
                                    {{ $c->last_message ? $c->last_message->message : 'Start conversation...' }}
                                </p>
                                @if($c->unread_count > 0)
                                    <span class="w-4 h-4 rounded-full bg-brand-600 text-white text-[9px] font-bold flex items-center justify-center flex-shrink-0">
                                        {{ $c->unread_count }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">
                        No conversations yet. Inquire about a product or accept a quotation to start chatting!
                    </div>
                @endforelse
            </div>

        </div>

        <!-- Right Panel: Active Chat Thread (65% width) -->
        <div class="flex-1 flex flex-col bg-slate-50/30">
            
            @if($activeContact)
                <!-- Active Chat Header -->
                <div class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between z-10 shadow-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 text-white font-bold flex items-center justify-center text-sm">
                            {{ strtoupper(substr($activeContact->supplier ? $activeContact->supplier->company_name : $activeContact->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 font-heading leading-tight">
                                {{ $activeContact->supplier ? $activeContact->supplier->company_name : $activeContact->name }}
                            </h3>
                            <div class="flex items-center gap-2 text-[10px] text-emerald-600 font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Online • Verified Supplier</span>
                            </div>
                        </div>
                    </div>

                    @if($activeContact->supplier)
                        <a href="{{ route('suppliers.show', $activeContact->supplier->slug) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[11px] transition">
                            View Storefront
                        </a>
                    @endif
                </div>

                <!-- Messages Thread Scrollable Area -->
                <div class="flex-1 p-6 overflow-y-auto space-y-3" id="messagesContainer" style="background-image: radial-gradient(#e2e8f0 1px, transparent 1px); background-size: 20px 20px;">
                    @forelse($messages as $msg)
                        <x-message_bubble :msg="$msg" :currentUserId="Auth::id()" />
                    @empty
                        <div class="h-full flex items-center justify-center text-xs text-slate-400">
                            Say hello to initiate your commercial discussion!
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input Bar -->
                <div class="p-4 bg-white border-t border-slate-200">
                    <form id="chatSendForm" action="{{ route('buyer.messages.send') }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiverId" value="{{ $activeContact->id }}">
                        
                        <div class="flex-1 relative">
                            <input 
                                type="text" 
                                name="message" 
                                id="chatInputMessage"
                                required 
                                autocomplete="off"
                                placeholder="Type your message, query or price inquiry here..." 
                                class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none"
                            >
                        </div>

                        <button type="submit" class="w-12 h-12 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white flex items-center justify-center shadow-lg shadow-brand-500/25 transition transform active:scale-95 flex-shrink-0">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    </form>
                </div>

            @else
                <!-- Empty State When No Chat is selected -->
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-slate-400">
                    <div class="w-20 h-20 rounded-full bg-slate-100 text-slate-300 flex items-center justify-center text-3xl mb-4">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Select a Supplier Conversation</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm">Choose from the supplier list on the left to start negotiating prices and logistics.</p>
                </div>
            @endif

        </div>

    </div>

    @push('scripts')
    <script>
        const msgContainer = document.getElementById('messagesContainer');
        if (msgContainer) {
            msgContainer.scrollTop = msgContainer.scrollHeight;
        }

        // AJAX Send message & live append without full page reload
        const chatForm = document.getElementById('chatSendForm');
        if (chatForm) {
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const input = document.getElementById('chatInputMessage');
                const text = input.value.trim();
                const receiverId = document.getElementById('receiverId').value;
                if (!text) return;

                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch("{{ route('buyer.messages.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        receiver_id: receiverId,
                        message: text
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        msgContainer.insertAdjacentHTML('beforeend', data.html);
                        input.value = '';
                        msgContainer.scrollTop = msgContainer.scrollHeight;
                    }
                });
            });
        }
    </script>
    @endpush

@endsection
