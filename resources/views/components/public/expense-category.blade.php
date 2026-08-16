@props([
    'name',
    'amount',
    'percentage',
    'rawAmount' => 0
])

<div class="p-4 rounded-lg bg-slate-50/70 border border-slate-200/80 hover:bg-rose-50/30 hover:border-rose-200 transition-colors">
    <div class="flex items-center justify-between gap-2 mb-1.5">
        <span class="font-bold text-slate-800 text-sm sm:text-base">
            {{ $name }}
        </span>
        <span class="font-extrabold text-slate-900 text-base sm:text-lg">
            {{ $amount }}
        </span>
    </div>
    <div class="flex items-center gap-3">
        <div class="grow bg-slate-200/80 rounded-full h-2 overflow-hidden">
            <div 
                class="bg-rose-600 h-full rounded-full transition-all duration-500" 
                style="width: {{ min(100, max(0, $percentage)) }}%"
            ></div>
        </div>
        <span class="text-xs font-semibold text-rose-700 shrink-0 w-12 text-right">
            {{ $percentage }}%
        </span>
    </div>
</div>
