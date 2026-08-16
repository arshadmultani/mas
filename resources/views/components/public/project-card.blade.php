@props([
    'project',
    'locale' => 'hi'
])

@php
    $name = is_array($project['name']) ? ($project['name'][$locale] ?? reset($project['name'])) : $project['name'];
    $description = is_array($project['description']) ? ($project['description'][$locale] ?? reset($project['description'])) : $project['description'];
    
    $statusMap = [
        'ongoing' => [
            'label' => __('status_ongoing'),
            'badge' => 'bg-blue-50 text-blue-700 border-blue-200',
            'dot' => 'bg-blue-600',
        ],
        'near_completion' => [
            'label' => __('status_near_completion'),
            'badge' => 'bg-amber-50 text-amber-700 border-amber-200',
            'dot' => 'bg-amber-500',
        ],
        'completed' => [
            'label' => __('status_completed'),
            'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'dot' => 'bg-emerald-600',
        ],
        'planned' => [
            'label' => __('status_planned'),
            'badge' => 'bg-slate-100 text-slate-700 border-slate-200',
            'dot' => 'bg-slate-500',
        ],
    ];

    $statusInfo = $statusMap[$project['status']] ?? $statusMap['ongoing'];
@endphp

<div class="bg-white rounded-xl border border-slate-200/90 shadow-xs hover:shadow-md transition-all duration-200 p-5 sm:p-6 flex flex-col justify-between group">
    <div>
        <!-- Top status badge & beneficiaries -->
        <div class="flex items-center justify-between gap-2 mb-3">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusInfo['badge'] }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $statusInfo['dot'] }}"></span>
                {{ $statusInfo['label'] }}
            </span>

            @if(!empty($project['beneficiaries_count']))
                <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ $project['beneficiaries_count'] }}+ {{ __('project_beneficiaries') }}
                </span>
            @endif
        </div>

        <!-- Project Title -->
        <h3 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-blue-700 transition-colors">
            {{ $name }}
        </h3>

        <!-- Project Description -->
        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2 line-clamp-3">
            {{ $description }}
        </p>
    </div>

    <!-- Financial Matrix for this Project -->
    <div class="mt-5 pt-4 border-t border-slate-100 space-y-3">
        <!-- Progress Bar -->
        <div>
            <div class="flex items-center justify-between text-xs mb-1.5 font-medium">
                <span class="text-slate-500">{{ __('project_progress') }}</span>
                <span class="font-bold text-blue-700">{{ $project['progress_percentage'] }}%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden border border-slate-200/60">
                <div 
                    class="h-full rounded-full bg-blue-600 transition-all duration-500" 
                    style="width: {{ min(100, max(0, $project['progress_percentage'])) }}%"
                ></div>
            </div>
        </div>

        <!-- Numbers Grid (Budget / Spent / Remaining) -->
        <div class="grid grid-cols-3 gap-1 sm:gap-2 text-center pt-1 bg-slate-50/80 rounded-lg p-2 sm:p-2.5 border border-slate-100">
            <div class="min-w-0 px-0.5">
                <div class="text-[10px] sm:text-[11px] text-slate-500 font-medium truncate">{{ __('project_budget') }}</div>
                <div class="text-[11px] sm:text-xs md:text-sm font-extrabold text-slate-900 mt-0.5 tracking-tight font-sans truncate">{{ format_inr($project['budget']) }}</div>
            </div>
            <div class="border-x border-slate-200 min-w-0 px-0.5">
                <div class="text-[10px] sm:text-[11px] text-slate-500 font-medium truncate">{{ __('project_spent') }}</div>
                <div class="text-[11px] sm:text-xs md:text-sm font-extrabold text-rose-600 mt-0.5 tracking-tight font-sans truncate">{{ format_inr($project['spent']) }}</div>
            </div>
            <div class="min-w-0 px-0.5">
                <div class="text-[10px] sm:text-[11px] text-slate-500 font-medium truncate">{{ __('project_remaining') }}</div>
                <div class="text-[11px] sm:text-xs md:text-sm font-extrabold text-emerald-700 mt-0.5 tracking-tight font-sans truncate">{{ format_inr($project['remaining']) }}</div>
            </div>
        </div>
    </div>
</div>
