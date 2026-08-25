@extends('layouts.dashboard')

@section('title', 'Supplier Messages & Live Chat - NexTrade')
@section('page_title', 'Buyer Messages & Live Chat')
@section('page_subtitle', 'Negotiate with buyers, clarify specifications and close wholesale orders.')

@section('content')

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col md:flex-row h-[75vh]">
        
        <!-- Left Contacts List -->
        <div class="w-full md:w-80 lg:w-96 border-r border-slate-200 flex flex-col bg-slate-50/50 flex-shrink-0">
            
            <div class="p-4 border-b border-slate-200 bg-white">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search buyers..." class="w-full pl-9 pr-4 py-2 bg-slate-100 border border-slate-200 rounded-2xl text-xs focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none">
                </div>
            </div>

            <!-- Contacts List -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-100">
                @forelse($contacts as $c)
                    @php
                        $isActive = $activeContact && $activeContact->id == $c->id;
                    @endphp
                    <a href="{{ route('supplier.messages', ['user' => $c->id]) }}" class="flex items-center gap-3 p-4 hover:bg-slate-100 transition relative {{ $isActive ? 'bg-brand-50/80 border-l-4 border-brand-600' : '' }}">
                        
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-brand-600 to-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm flex-shrink-0 relative">
                            {{ strtoupper(substr($c->name, 0, 1)) }}
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white"></span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <h4 class="text-xs font-bold text-slate-900 truncate">{{ $c->name }}</h4>
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
                        No conversations yet. When buyers inquire or accept quotes, their chats will appear here.
                    </div>
                @endforelse
            </div>

        </div>

        <!-- Right Active Chat Thread -->
        <div class="flex-1 flex flex-col bg-slate-50/30">
            
            @if($activeContact)
                <!-- Header -->
                <div class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 text-white font-bold flex items-center justify-center text-sm">
                            {{ strtoupper(substr($activeContact->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 font-heading">{{ $activeContact->name }}</h3>
                            <div class="flex items-center gap-1.5 text-[10px] text-emerald-600 font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Verified Buyer • {{ $activeContact->buyer ? $activeContact->buyer->city : 'India' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 p-6 overflow-y-auto space-y-3" id="supplierMessagesContainer" style="background-image: radial-gradient(#e2e8f0 1px, transparent 1px); background-size: 20px 20px;">
                    @forelse($messages as $msg)
                        <x-message_bubble :msg="$msg" :currentUserId="Auth::id()" />
                    @empty
                        <div class="h-full flex items-center justify-center text-xs text-slate-400">
                            Start chatting with this buyer.
                        </div>
                    @endforelse
                </div>

                <!-- Input -->
                <div class="p-4 bg-white border-t border-slate-200">
                    <form id="supplierChatForm" action="{{ route('supplier.messages.send') }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="hidden" name="receiver_id" id="suppReceiverId" value="{{ $activeContact->id }}">
                        
                        <div class="flex-1 relative">
                            <input 
                                type="text" 
                                name="message" 
                                id="suppChatInput"
                                required 
                                autocomplete="off"
                                placeholder="Type your reply, commercial terms or technical details..." 
                                class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-2xl text-xs sm:text-sm focus:ring-2 focus:ring-brand-500 focus:bg-white focus:outline-none"
                            >
                        </div>

                        <button type="submit" class="w-12 h-12 rounded-2xl bg-brand-600 hover:bg-brand-700 text-white flex items-center justify-center shadow-lg shadow-brand-500/25 transition transform active:scale-95 flex-shrink-0">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </button>
                    </form>
                </div>

            @else
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-slate-400">
                    <div class="w-20 h-20 rounded-full bg-slate-100 text-slate-300 flex items-center justify-center text-3xl mb-4">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Select a Buyer Conversation</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm">Choose from the buyer list on the left to start chatting.</p>
                </div>
            @endif

        </div>

    </div>

    @push('scripts')
    <script>
        const suppMsgContainer = document.getElementById('supplierMessagesContainer');
        if (suppMsgContainer) {
            suppMsgContainer.scrollTop = suppMsgContainer.scrollHeight;
        }

        const suppForm = document.getElementById('supplierChatForm');
        if (suppForm) {
            suppForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const input = document.getElementById('suppChatInput');
                const text = input.value.trim();
                const receiverId = document.getElementById('suppReceiverId').value;
                if (!text) return;

                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch("{{ route('supplier.messages.send') }}", {
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
                        suppMsgContainer.insertAdjacentHTML('beforeend', data.html);
                        input.value = '';
                        suppMsgContainer.scrollTop = suppMsgContainer.scrollHeight;
                    }
                });
            });
        }
    </script>
    @endpush

@endsection
