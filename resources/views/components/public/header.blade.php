@props([
    'locale' => 'hi',
    'financialYear',
    'allFinancialYears' => []
])

<header 
    x-data="{ mobileMenuOpen: false, scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200/80' : 'bg-white border-b border-slate-200'"
    class="sticky top-0 z-50 transition-all duration-200"
>
    <!-- Top Utility & Disclaimer Ribbon (Institutional) -->
    <div class="bg-navy-950 text-slate-300 text-xs py-1.5 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 font-medium text-[11px] border border-amber-500/30">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('demo_data_badge') }}
                </span>
                <span class="hidden md:inline text-slate-400 text-[11px]">
                    {{ __('demo_disclaimer') }}
                </span>
            </div>

            <!-- Financial Year Dropdown & Language Switcher (Compact Top) -->
            <div class="flex items-center gap-3 ml-auto">
                <!-- Financial Year Switcher (Desktop only in top bar, accessible on mobile in menu) -->
                <div class="hidden sm:flex items-center gap-1.5 text-slate-300">
                    <span class="text-[11px] text-slate-400">{{ __('year_selector_label') }}</span>
                    <div class="flex items-center bg-slate-800/80 rounded border border-slate-700 p-0.5 text-xs">
                        @foreach($allFinancialYears as $fy)
                            <a 
                                href="?year={{ $fy->name }}" 
                                class="px-2 py-0.5 rounded transition-colors {{ $financialYear->name === $fy->name ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}"
                                title="Financial Year {{ $fy->name }}"
                            >
                                {{ $fy->label[$locale] ?? $fy->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Language Switcher -->
                <div class="flex items-center bg-slate-800/80 rounded border border-slate-700 p-0.5 text-xs">
                    <a 
                        href="{{ route('locale.switch', ['locale' => 'hi', 'return_url' => request()->fullUrl()]) }}"
                        class="px-2.5 py-0.5 rounded transition-all {{ $locale === 'hi' ? 'bg-amber-600 text-white font-bold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}"
                        aria-label="Switch to Hindi"
                    >
                        हिन्दी
                    </a>
                    <span class="text-slate-600 px-0.5">|</span>
                    <a 
                        href="{{ route('locale.switch', ['locale' => 'en', 'return_url' => request()->fullUrl()]) }}"
                        class="px-2.5 py-0.5 rounded transition-all {{ $locale === 'en' ? 'bg-blue-600 text-white font-bold shadow-xs' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}"
                        aria-label="Switch to English"
                    >
                        English
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-18">
            <!-- Brand Logo & Identity -->
            <a href="#home" class="flex items-center gap-2.5 sm:gap-3.5 group focus:outline-hidden focus:ring-2 focus:ring-blue-600 rounded-lg p-1 min-w-0 pr-2">
                <div class="w-9 h-9 sm:w-11 sm:h-11 shrink-0 rounded-lg bg-navy-900 text-white flex items-center justify-center font-bold text-lg shadow-sm border border-navy-800 group-hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="font-extrabold text-slate-900 text-sm sm:text-lg leading-tight tracking-tight group-hover:text-blue-700 transition-colors truncate">
                        {{ __('app_name') }}
                    </div>
                    <div class="text-[11px] sm:text-xs text-slate-500 font-medium flex items-center gap-1 sm:gap-1.5 mt-0.5 truncate">
                        <span>{{ __('location') }}</span>
                        <span class="inline-block w-1 h-1 rounded-full bg-slate-300"></span>
                        <span class="text-blue-600 font-semibold truncate">{{ __('app_tagline') }}</span>
                    </div>
                </div>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="#home" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_home') }}
                </a>
                <a href="#overview" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_financials') }}
                </a>
                <a href="#income" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_income') }}
                </a>
                <a href="#expenses" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_expenses') }}
                </a>
                <a href="#projects" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_projects') }}
                </a>
                <a href="#monthly" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_monthly') }}
                </a>
                <a href="#ledger" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_ledger') }}
                </a>
                <a href="#about" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_about') }}
                </a>
                <a href="#contact" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50 rounded-md transition-colors">
                    {{ __('nav_contact') }}
                </a>
            </nav>

            <!-- Action CTA Button -->
            <div class="hidden lg:flex items-center gap-3">
                <a 
                    href="#reports" 
                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-navy-900 hover:bg-blue-700 rounded-md shadow-xs transition-all focus:outline-hidden focus:ring-2 focus:ring-navy-900 focus:ring-offset-2"
                >
                    <svg class="w-4 h-4 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('nav_cta_report') }}
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden items-center gap-2">
                <a 
                    href="#reports" 
                    class="p-2 text-xs font-semibold text-navy-900 bg-slate-100 hover:bg-slate-200 rounded-md"
                    title="{{ __('nav_cta_report') }}"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </a>
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button" 
                    class="p-2.5 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-hidden focus:ring-2 focus:ring-blue-600"
                    aria-label="Toggle navigation menu"
                    :aria-expanded="mobileMenuOpen"
                >
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Slide-out Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-cloak 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-1 shadow-lg"
    >
        <!-- Mobile Language & Year Selection Row -->
        <div class="pb-3 mb-3 border-b border-slate-100 flex flex-col gap-2.5">
            <div class="flex items-center justify-between text-xs">
                <span class="font-medium text-slate-500">{{ __('switch_language') }}:</span>
                <div class="flex items-center bg-slate-100 rounded-md p-1 border border-slate-200">
                    <a 
                        href="{{ route('locale.switch', ['locale' => 'hi', 'return_url' => request()->fullUrl()]) }}"
                        class="px-3 py-1 rounded text-xs font-semibold {{ $locale === 'hi' ? 'bg-amber-600 text-white shadow-xs' : 'text-slate-700' }}"
                    >
                        हिन्दी
                    </a>
                    <a 
                        href="{{ route('locale.switch', ['locale' => 'en', 'return_url' => request()->fullUrl()]) }}"
                        class="px-3 py-1 rounded text-xs font-semibold {{ $locale === 'en' ? 'bg-blue-600 text-white shadow-xs' : 'text-slate-700' }}"
                    >
                        English
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <span class="font-medium text-slate-500">{{ __('year_selector_label') }}</span>
                <div class="flex items-center gap-1">
                    @foreach($allFinancialYears as $fy)
                        <a 
                            href="?year={{ $fy->name }}" 
                            class="px-2 py-1 rounded text-xs {{ $financialYear->name === $fy->name ? 'bg-navy-900 text-white font-bold' : 'bg-slate-100 text-slate-700' }}"
                        >
                            {{ $fy->label[$locale] ?? $fy->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <a @click="mobileMenuOpen = false" href="#home" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_home') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#overview" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_financials') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#income" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_income') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#expenses" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_expenses') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#projects" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_projects') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#monthly" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_monthly') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#ledger" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_ledger') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#history" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_history') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#reports" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_reports') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#about" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_about') }}
        </a>
        <a @click="mobileMenuOpen = false" href="#contact" class="block px-3 py-2.5 rounded-md text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-700">
            {{ __('nav_contact') }}
        </a>
    </div>
</header>
