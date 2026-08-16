@props(['locale' => 'hi'])

<!-- Compact Fixed Mobile Bottom Navigation -->
<div 
    x-data="{ activeSection: 'home' }"
    @scroll.window="
        const sections = ['home', 'overview', 'income', 'expenses', 'projects'];
        const scrollPos = window.pageYOffset + 200;
        for (const s of sections) {
            const el = document.getElementById(s);
            if (el && scrollPos >= el.offsetTop && scrollPos < (el.offsetTop + el.offsetHeight)) {
                activeSection = s;
                break;
            }
        }
    "
    class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 shadow-lg px-2 pb-safe"
>
    <div class="grid grid-cols-5 h-15 items-center">
        <!-- 1. Home -->
        <a 
            href="#home" 
            @click="activeSection = 'home'"
            :class="activeSection === 'home' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-900 font-medium'"
            class="flex flex-col items-center justify-center py-1 transition-colors relative"
        >
            <div :class="activeSection === 'home' ? 'scale-110' : ''" class="transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <span class="text-[10px] leading-tight mt-1 truncate max-w-full px-0.5">
                {{ __('nav_home') }}
            </span>
            <span x-show="activeSection === 'home'" class="absolute -top-0.5 w-8 h-0.5 bg-blue-600 rounded-full"></span>
        </a>

        <!-- 2. Financials -->
        <a 
            href="#overview" 
            @click="activeSection = 'overview'"
            :class="activeSection === 'overview' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-900 font-medium'"
            class="flex flex-col items-center justify-center py-1 transition-colors relative"
        >
            <div :class="activeSection === 'overview' ? 'scale-110' : ''" class="transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <span class="text-[10px] leading-tight mt-1 truncate max-w-full px-0.5">
                {{ __('nav_financials') }}
            </span>
            <span x-show="activeSection === 'overview'" class="absolute -top-0.5 w-8 h-0.5 bg-blue-600 rounded-full"></span>
        </a>

        <!-- 3. Income -->
        <a 
            href="#income" 
            @click="activeSection = 'income'"
            :class="activeSection === 'income' ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-900 font-medium'"
            class="flex flex-col items-center justify-center py-1 transition-colors relative"
        >
            <div :class="activeSection === 'income' ? 'scale-110 text-emerald-600' : ''" class="transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                </svg>
            </div>
            <span class="text-[10px] leading-tight mt-1 truncate max-w-full px-0.5">
                {{ __('nav_income') }}
            </span>
            <span x-show="activeSection === 'income'" class="absolute -top-0.5 w-8 h-0.5 bg-emerald-600 rounded-full"></span>
        </a>

        <!-- 4. Expenses -->
        <a 
            href="#expenses" 
            @click="activeSection = 'expenses'"
            :class="activeSection === 'expenses' ? 'text-rose-700 font-bold' : 'text-slate-500 hover:text-slate-900 font-medium'"
            class="flex flex-col items-center justify-center py-1 transition-colors relative"
        >
            <div :class="activeSection === 'expenses' ? 'scale-110 text-rose-600' : ''" class="transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                </svg>
            </div>
            <span class="text-[10px] leading-tight mt-1 truncate max-w-full px-0.5">
                {{ __('nav_expenses') }}
            </span>
            <span x-show="activeSection === 'expenses'" class="absolute -top-0.5 w-8 h-0.5 bg-rose-600 rounded-full"></span>
        </a>

        <!-- 5. Projects -->
        <a 
            href="#projects" 
            @click="activeSection = 'projects'"
            :class="activeSection === 'projects' ? 'text-blue-700 font-bold' : 'text-slate-500 hover:text-slate-900 font-medium'"
            class="flex flex-col items-center justify-center py-1 transition-colors relative"
        >
            <div :class="activeSection === 'projects' ? 'scale-110' : ''" class="transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-[10px] leading-tight mt-1 truncate max-w-full px-0.5">
                {{ __('nav_projects') }}
            </span>
            <span x-show="activeSection === 'projects'" class="absolute -top-0.5 w-8 h-0.5 bg-blue-600 rounded-full"></span>
        </a>
    </div>
</div>
