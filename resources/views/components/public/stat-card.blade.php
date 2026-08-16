@props([
    'title',
    'amount',
    'subtext' => null,
    'badgeText' => null,
    'badgeType' => 'default', // 'success', 'danger', 'info', 'warning', 'navy'
    'progress' => null, // percentage 0-100 if progress bar
    'color' => 'blue', // 'green', 'red', 'navy', 'blue'
    'icon' => null
])

@php
    $colorMap = [
        'green' => [
            'border' => 'border-emerald-200',
            'top_bar' => 'bg-emerald-600',
            'text_accent' => 'text-emerald-700',
            'bg_badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            'icon_bg' => 'bg-emerald-100 text-emerald-700',
        ],
        'red' => [
            'border' => 'border-rose-200',
            'top_bar' => 'bg-rose-600',
            'text_accent' => 'text-rose-700',
            'bg_badge' => 'bg-rose-50 text-rose-800 border-rose-200',
            'icon_bg' => 'bg-rose-100 text-rose-700',
        ],
        'navy' => [
            'border' => 'border-navy-200',
            'top_bar' => 'bg-navy-900',
            'text_accent' => 'text-navy-900',
            'bg_badge' => 'bg-slate-100 text-slate-800 border-slate-200',
            'icon_bg' => 'bg-navy-100 text-navy-900',
        ],
        'blue' => [
            'border' => 'border-blue-200',
            'top_bar' => 'bg-blue-600',
            'text_accent' => 'text-blue-700',
            'bg_badge' => 'bg-blue-50 text-blue-800 border-blue-200',
            'icon_bg' => 'bg-blue-100 text-blue-700',
        ],
    ];

    $styles = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="bg-white rounded-xl border border-slate-200/90 shadow-xs hover:shadow-md transition-all duration-200 relative overflow-hidden flex flex-col justify-between p-5 sm:p-6 group">
    <!-- Top colored accent indicator line -->
    <div class="absolute top-0 left-0 right-0 h-1.5 {{ $styles['top_bar'] }}"></div>

    <div>
        <!-- Top header row inside card -->
        <div class="flex items-center justify-between gap-3 mb-2">
            <span class="text-xs sm:text-sm font-bold text-slate-600 uppercase tracking-wider">
                {{ $title }}
            </span>
            @if($badgeText)
                <span class="inline-flex items-center text-xs font-semibold px-2.5 py-0.5 rounded-full border {{ $styles['bg_badge'] }}">
                    {{ $badgeText }}
                </span>
            @endif
        </div>

        <!-- Dominant Financial Amount -->
        <div class="mt-2 mb-2">
            <div class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-none font-sans">
                {{ $amount }}
            </div>
        </div>
    </div>

    <!-- Progress Bar (Optional, e.g. for Target Card) -->
    @if(!is_null($progress))
        <div class="mt-3 mb-2">
            <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1.5">
                <span>{{ __('project_progress') }}</span>
                <span class="{{ $styles['text_accent'] }} font-bold">{{ $progress }}%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden border border-slate-200/60">
                <div 
                    class="h-full rounded-full transition-all duration-500 {{ $styles['top_bar'] }}" 
                    style="width: {{ min(100, max(0, $progress)) }}%"
                ></div>
            </div>
        </div>
    @endif

    <!-- Subtext note below amount -->
    @if($subtext)
        <div class="mt-2 pt-2 border-t border-slate-100 flex items-center gap-1.5 text-xs text-slate-600 font-medium">
            {{ $subtext }}
        </div>
    @endif
</div>
