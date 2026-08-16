@props([
    'locale' => 'hi',
    'lastUpdatedFormatted' => ''
])

<footer class="bg-navy-950 text-slate-300 border-t border-navy-900 pb-20 md:pb-12 pt-12 sm:pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 sm:gap-10 pb-12 border-b border-slate-800">
            <!-- Col 1: Identity & Purpose -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-white text-lg leading-tight tracking-tight">
                            {{ __('app_name') }}
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-0.5">
                            {{ __('app_tagline') }}
                        </div>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-lg">
                    {{ __('about_section_text') }}
                </p>

                <!-- Disclaimer Banner -->
                <div class="p-3 bg-slate-900/90 rounded-lg border border-slate-800 text-xs text-amber-300 flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-amber-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <span class="font-bold">{{ __('demo_data_badge') }}:</span> {{ __('demo_footer_note') }}
                    </div>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-xs font-bold text-slate-100 uppercase tracking-wider mb-4">
                    {{ __('nav_financials') }}
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li>
                        <a href="#overview" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('overview_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#income" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('income_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#expenses" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('expense_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#projects" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('projects_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#monthly" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('monthly_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#ledger" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('ledger_section_title') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Information & Reports -->
            <div>
                <h4 class="text-xs font-bold text-slate-100 uppercase tracking-wider mb-4">
                    {{ __('nav_reports') }} & {{ __('nav_about') }}
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li>
                        <a href="#history" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('history_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#reports" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('reports_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#transparency" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('transparency_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('about_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#faq" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('faq_section_title') }}
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="text-slate-400 hover:text-white transition-colors">
                            {{ __('contact_section_title') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright & Last Updated Line -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="text-center sm:text-left">
                &copy; {{ date('Y') }} {{ __('app_name') }}. {{ __('location') }}.
            </div>
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1 text-slate-400">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('last_updated') }}: <strong class="text-slate-300 font-semibold">{{ $lastUpdatedFormatted }}</strong>
                </span>
                <a href="#home" class="text-slate-400 hover:text-white underline transition-colors">
                    {{ __('back_to_top') }} ↑
                </a>
            </div>
        </div>
    </div>
</footer>
