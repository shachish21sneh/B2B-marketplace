@props(['msg', 'currentUserId'])

@php
    $isMe = $msg->sender_id == $currentUserId;
@endphp

<div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} mb-3">
    <div class="max-w-[78%] {{ $isMe ? 'bg-brand-600 text-white rounded-t-2xl rounded-bl-2xl shadow-md shadow-brand-500/15' : 'bg-white text-slate-800 rounded-t-2xl rounded-br-2xl border border-slate-200 shadow-sm' }} p-3.5 relative">
        
        <p class="text-xs leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>

        @if($msg->attachment)
            <div class="mt-2 pt-2 border-t {{ $isMe ? 'border-white/20' : 'border-slate-100' }}">
                <a href="{{ $msg->attachment }}" target="_blank" class="flex items-center gap-2 text-xs font-semibold underline {{ $isMe ? 'text-white' : 'text-brand-600' }}">
                    <i class="fa-solid fa-paperclip"></i> Attachment
                </a>
            </div>
        @endif

        <div class="flex items-center justify-end gap-1.5 mt-1.5 text-[9px] {{ $isMe ? 'text-brand-100' : 'text-slate-400' }}">
            <span>{{ $msg->created_at ? $msg->created_at->format('h:i A') : 'Just now' }}</span>
            @if($isMe)
                @if($msg->is_read)
                    <i class="fa-solid fa-check-double text-blue-200 text-[10px]"></i>
                @else
                    <i class="fa-solid fa-check text-blue-200 text-[10px]"></i>
                @endif
            @endif
        </div>

    </div>
</div>
