<!DOCTYPE html>
<html lang="{{ $locale }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Dynamic Multilingual SEO Title & Meta -->
    <title>{{ $locale === 'hi' ? 'मुल्तानी अग्रहन सोसाइटी, उदयपुर | वित्तीय पारदर्शिता' : 'Multani Agrahan Society, Udaipur | Financial Transparency' }}</title>
    <meta name="description" content="{{ $locale === 'hi' ? 'मुल्तानी अग्रहन सोसाइटी, उदयपुर का सार्वजनिक वित्तीय पारदर्शिता पोर्टल - आय, खर्च, लक्ष्य, परियोजनाएं और वार्षिक रिपोर्ट।' : 'Explore the financial transparency dashboard of Multani Agrahan Society, Udaipur, including income, expenses, targets, projects and public reports.' }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $locale === 'hi' ? 'मुल्तानी अग्रहन सोसाइटी, उदयपुर | वित्तीय पारदर्शिता' : 'Multani Agrahan Society, Udaipur | Financial Transparency' }}">
    <meta property="og:description" content="{{ $locale === 'hi' ? 'सोसाइटी की वित्तीय स्थिति, आय-व्यय, परियोजनाएं और ऑडिट रिपोर्ट का सार्वजनिक अवलोकन।' : 'An open view of income, expenses, targets, and projects of Multani Agrahan Society, Udaipur.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-bg text-slate-900 antialiased selection:bg-blue-600 selection:text-white font-sans min-h-screen flex flex-col">

    <!-- Header Navigation -->
    <x-public.header 
        :locale="$locale" 
        :financial-year="$financialYear" 
        :all-financial-years="$allFinancialYears" 
    />

    <!-- Main Content Container -->
    <main class="grow space-y-16 sm:space-y-24">

        <!-- 1. HERO SECTION -->
        <section id="home" class="relative overflow-hidden bg-gradient-to-b from-white via-slate-50/50 to-surface-bg pt-10 sm:pt-16 pb-12 sm:pb-16 border-b border-slate-200/80">
            <!-- Subtle Institutional Watermark/Pattern -->
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[radial-gradient(#172554_1px,transparent_1px)] [background-size:24px_24px]"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-800 text-xs sm:text-sm font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                        {{ __('hero_badge', ['year' => $financialYear->label[$locale] ?? $financialYear->name]) }}
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        {{ __('hero_title') }}
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base lg:text-lg text-slate-600 font-normal leading-relaxed max-w-2xl mx-auto">
                        {{ __('hero_subtitle') }}
                    </p>

                    <!-- Hero Quick Indicator Bar -->
                    <div class="pt-4 pb-2">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-2xl mx-auto text-left bg-white p-3.5 sm:p-4 rounded-xl border border-slate-200 shadow-xs">
                            <!-- Indicator 1: Collected -->
                            <div class="px-3 py-2 border-b sm:border-b-0 sm:border-r border-slate-100 flex items-center justify-between sm:block">
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">
                                    {{ __('hero_stat_collected') }}
                                </span>
                                <span class="text-lg sm:text-xl font-extrabold text-emerald-700 font-sans block mt-0.5">
                                    {{ format_inr($totalIncome) }}
                                </span>
                            </div>

                            <!-- Indicator 2: Spent -->
                            <div class="px-3 py-2 border-b sm:border-b-0 sm:border-r border-slate-100 flex items-center justify-between sm:block">
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">
                                    {{ __('hero_stat_spent') }}
                                </span>
                                <span class="text-lg sm:text-xl font-extrabold text-rose-600 font-sans block mt-0.5">
                                    {{ format_inr($totalExpenses) }}
                                </span>
                            </div>

                            <!-- Indicator 3: Balance -->
                            <div class="px-3 py-2 flex items-center justify-between sm:block">
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">
                                    {{ __('hero_stat_balance') }}
                                </span>
                                <span class="text-lg sm:text-xl font-extrabold text-navy-900 font-sans block mt-0.5">
                                    {{ format_inr($balance) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Call to Action Buttons -->
                    <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
                        <a 
                            href="#overview" 
                            class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-all focus:outline-hidden focus:ring-2 focus:ring-blue-600 focus:ring-offset-2"
                        >
                            {{ __('hero_cta_primary') }} ↓
                        </a>
                        <a 
                            href="#expenses" 
                            class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-sm font-bold text-slate-700 bg-white hover:bg-slate-100 border border-slate-300 shadow-2xs transition-all focus:outline-hidden focus:ring-2 focus:ring-slate-400"
                        >
                            {{ __('hero_cta_secondary') }} →
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <!-- 2. MAIN FINANCIAL OVERVIEW -->
        <section id="overview" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <!-- Section Header -->
            <div class="mb-8 sm:mb-10 text-center sm:text-left">
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    {{ $financialYear->label[$locale] ?? $financialYear->name }}
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ __('overview_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl">
                    {{ __('overview_subtitle') }}
                </p>
            </div>

            <!-- Four Large Financial Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                <!-- Card 1: Total Income -->
                <x-public.stat-card 
                    :title="__('total_income')"
                    :amount="format_inr($totalIncome)"
                    :badge-text="$incomeGrowthPrevYear > 0 ? __('income_growth_prev_year', ['pct' => $incomeGrowthPrevYear]) : null"
                    badge-type="success"
                    color="green"
                    :subtext="__('income_growth_prev_year', ['pct' => $incomeGrowthPrevYear])"
                />

                <!-- Card 2: Total Expenses -->
                <x-public.stat-card 
                    :title="__('total_expenses')"
                    :amount="format_inr($totalExpenses)"
                    :badge-text="__('expense_of_income', ['pct' => $expenseToIncomePercentage])"
                    badge-type="danger"
                    color="red"
                    :subtext="__('expense_of_income', ['pct' => $expenseToIncomePercentage])"
                />

                <!-- Card 3: Available Balance -->
                <x-public.stat-card 
                    :title="__('available_balance')"
                    :amount="format_inr($balance)"
                    :badge-text="__('balance_of_income', ['pct' => $balanceToIncomePercentage])"
                    badge-type="navy"
                    color="navy"
                    :subtext="__('balance_of_income', ['pct' => $balanceToIncomePercentage])"
                />

                <!-- Card 4: Annual Target Progress -->
                <x-public.stat-card 
                    :title="__('fundraising_target')"
                    :amount="format_inr($target)"
                    :progress="$targetPercentage"
                    badge-type="info"
                    color="blue"
                    :subtext="__('target_achieved_desc', ['pct' => $targetPercentage])"
                />
            </div>
        </section>


        <!-- 3. TARGET PROGRESS SECTION -->
        <section id="target" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-gradient-to-br from-navy-950 via-navy-900 to-slate-900 text-white rounded-2xl p-6 sm:p-10 shadow-lg border border-navy-800 relative overflow-hidden">
                <!-- Background Accent -->
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative">
                    <!-- Left Column: Metrics & Explanation -->
                    <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-semibold border border-blue-500/30">
                            {{ __('target_section_title', ['year' => $financialYear->label[$locale] ?? $financialYear->name]) }}
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            {{ __('target_achieved_desc', ['pct' => $targetPercentage]) }}
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                            {{ __('target_remaining_message', ['amount' => format_inr($remainingTarget)]) }}
                        </p>

                        <!-- Large Horizontal Target Progress Bar -->
                        <div class="space-y-2 pt-2">
                            <div class="w-full bg-slate-800 rounded-full h-4 overflow-hidden border border-slate-700 p-0.5">
                                <div 
                                    class="h-full bg-gradient-to-r from-blue-500 to-emerald-400 rounded-full transition-all duration-700" 
                                    style="width: {{ min(100, max(0, $targetPercentage)) }}%"
                                ></div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                                <span>₹0</span>
                                <span>50%</span>
                                <span>{{ format_inr($target) }} (100%)</span>
                            </div>
                        </div>

                        <p class="text-[11px] text-slate-400 italic pt-1">
                            * {{ __('target_note') }}
                        </p>
                    </div>

                    <!-- Right Column: Key Metric Matrix Cards -->
                    <div class="lg:col-span-5 grid grid-cols-2 gap-2.5 sm:gap-4">
                        <!-- Metric 1: Target -->
                        <div class="bg-slate-800/80 backdrop-blur-xs p-3 sm:p-4 rounded-xl border border-slate-700 text-center min-w-0 flex flex-col justify-center overflow-hidden">
                            <span class="text-[11px] sm:text-xs text-slate-400 font-semibold uppercase tracking-wider block truncate">
                                {{ __('target_metric_target') }}
                            </span>
                            <span class="text-sm sm:text-lg md:text-xl lg:text-2xl font-extrabold text-white mt-1 block tracking-tight font-sans truncate">
                                {{ format_inr($target) }}
                            </span>
                        </div>

                        <!-- Metric 2: Achieved -->
                        <div class="bg-slate-800/80 backdrop-blur-xs p-3 sm:p-4 rounded-xl border border-slate-700 text-center min-w-0 flex flex-col justify-center overflow-hidden">
                            <span class="text-[11px] sm:text-xs text-emerald-400 font-semibold uppercase tracking-wider block truncate">
                                {{ __('target_metric_achieved') }}
                            </span>
                            <span class="text-sm sm:text-lg md:text-xl lg:text-2xl font-extrabold text-emerald-400 mt-1 block tracking-tight font-sans truncate">
                                {{ format_inr($totalIncome) }}
                            </span>
                        </div>

                        <!-- Metric 3: Remaining -->
                        <div class="bg-slate-800/80 backdrop-blur-xs p-3 sm:p-4 rounded-xl border border-slate-700 text-center min-w-0 flex flex-col justify-center overflow-hidden">
                            <span class="text-[11px] sm:text-xs text-amber-300 font-semibold uppercase tracking-wider block truncate">
                                {{ __('target_metric_remaining') }}
                            </span>
                            <span class="text-sm sm:text-lg md:text-xl lg:text-2xl font-extrabold text-amber-300 mt-1 block tracking-tight font-sans truncate">
                                {{ format_inr($remainingTarget) }}
                            </span>
                        </div>

                        <!-- Metric 4: Percentage -->
                        <div class="bg-slate-800/80 backdrop-blur-xs p-3 sm:p-4 rounded-xl border border-slate-700 text-center min-w-0 flex flex-col justify-center overflow-hidden">
                            <span class="text-[11px] sm:text-xs text-blue-300 font-semibold uppercase tracking-wider block truncate">
                                {{ __('target_metric_percentage') }}
                            </span>
                            <span class="text-sm sm:text-lg md:text-xl lg:text-2xl font-extrabold text-blue-300 mt-1 block tracking-tight font-sans truncate">
                                {{ $targetPercentage }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- 4. INCOME SECTION (WHERE DOES THE MONEY COME FROM?) -->
        <section id="income" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" x-data="{ incomeView: 'chart' }">
            <!-- Section Header & Toggle Switch -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 uppercase tracking-wider mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                        {{ __('total_income') }}: {{ format_inr($totalIncome) }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('income_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                        {{ __('income_section_subtitle') }}
                    </p>
                </div>

                <!-- View Toggle Buttons (Chart / Table) -->
                <div class="flex items-center bg-slate-100 p-1 rounded-lg border border-slate-200 self-start sm:self-auto text-xs font-semibold">
                    <button 
                        @click="incomeView = 'chart'"
                        :class="incomeView === 'chart' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                        class="px-3 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        {{ __('view_chart') }}
                    </button>
                    <button 
                        @click="incomeView = 'table'"
                        :class="incomeView === 'table' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                        class="px-3 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        {{ __('view_table') }}
                    </button>
                </div>
            </div>

            <!-- Content Grid: Category List + Doughnut Chart / Table -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Detailed Category Breakdown Cards -->
                <div class="lg:col-span-7 space-y-3">
                    @foreach($incomeByCategory as $cat)
                        <x-public.income-category 
                            :name="$cat['category_name'][$locale] ?? $cat['category_name']['hi'] ?? $cat['key']"
                            :amount="format_inr($cat['amount'])"
                            :percentage="$cat['percentage']"
                            :raw-amount="$cat['amount']"
                        />
                    @endforeach

                    <!-- Total Summary Row -->
                    <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-between font-bold text-emerald-950">
                        <span class="text-sm sm:text-base">{{ __('total_income') }}</span>
                        <span class="text-lg sm:text-xl font-extrabold text-emerald-700">{{ format_inr($totalIncome) }}</span>
                    </div>
                </div>

                <!-- Right: Chart and Accessible Table Alternative -->
                <div class="lg:col-span-5 bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs flex flex-col justify-between">
                    <!-- Chart View -->
                    <div x-show="incomeView === 'chart'" class="w-full h-72 sm:h-80 relative">
                        <canvas 
                            id="incomeDistributionChart"
                            data-incomes='@json($incomeByCategory)'
                        ></canvas>
                    </div>

                    <!-- Accessible Table View / Fallback -->
                    <div x-show="incomeView === 'table'" x-cloak class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50 font-bold text-slate-700">
                                    <th class="py-2.5 px-3">{{ __('category_header') }}</th>
                                    <th class="py-2.5 px-3 text-right">{{ __('amount_header') }}</th>
                                    <th class="py-2.5 px-3 text-right">{{ __('share_header') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($incomeByCategory as $cat)
                                    <tr>
                                        <td class="py-2.5 px-3 font-medium text-slate-800">
                                            {{ $cat['category_name'][$locale] ?? $cat['category_name']['hi'] ?? $cat['key'] }}
                                        </td>
                                        <td class="py-2.5 px-3 text-right font-bold text-slate-900">
                                            {{ format_inr($cat['amount']) }}
                                        </td>
                                        <td class="py-2.5 px-3 text-right font-semibold text-emerald-700">
                                            {{ $cat['percentage'] }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t-2 border-slate-300 font-extrabold bg-slate-50">
                                    <td class="py-2.5 px-3">{{ __('total_income') }}</td>
                                    <td class="py-2.5 px-3 text-right text-emerald-700">{{ format_inr($totalIncome) }}</td>
                                    <td class="py-2.5 px-3 text-right">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footnote for Accessibility -->
                    <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>{{ __('chart_fallback_title') }}</span>
                        <span class="font-semibold text-slate-700">{{ $incomeByCategory->count() }} {{ __('income_sources_heading') }}</span>
                    </div>
                </div>
            </div>
        </section>


        <!-- 5. EXPENSES SECTION (WHERE DOES THE MONEY GO?) -->
        <section id="expenses" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" x-data="{ expenseView: 'chart' }">
            <!-- Section Header & Toggle Switch -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-700 uppercase tracking-wider mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                        {{ __('total_expenses') }}: {{ format_inr($totalExpenses) }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('expense_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                        {{ __('expense_section_subtitle') }}
                    </p>
                </div>

                <!-- View Toggle Buttons -->
                <div class="flex items-center bg-slate-100 p-1 rounded-lg border border-slate-200 self-start sm:self-auto text-xs font-semibold">
                    <button 
                        @click="expenseView = 'chart'"
                        :class="expenseView === 'chart' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                        class="px-3 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        {{ __('view_chart') }}
                    </button>
                    <button 
                        @click="expenseView = 'table'"
                        :class="expenseView === 'table' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                        class="px-3 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        {{ __('view_table') }}
                    </button>
                </div>
            </div>

            <!-- Content Grid: Category List + Doughnut Chart / Table -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Detailed Category Breakdown Cards -->
                <div class="lg:col-span-7 space-y-3">
                    @foreach($expensesByCategory as $cat)
                        <x-public.expense-category 
                            :name="$cat['category_name'][$locale] ?? $cat['category_name']['hi'] ?? $cat['key']"
                            :amount="format_inr($cat['amount'])"
                            :percentage="$cat['percentage']"
                            :raw-amount="$cat['amount']"
                        />
                    @endforeach

                    <!-- Total Summary Row -->
                    <div class="p-4 rounded-lg bg-rose-50 border border-rose-200 flex items-center justify-between font-bold text-rose-950">
                        <span class="text-sm sm:text-base">{{ __('total_expenses') }}</span>
                        <span class="text-lg sm:text-xl font-extrabold text-rose-600">{{ format_inr($totalExpenses) }}</span>
                    </div>
                </div>

                <!-- Right: Chart and Accessible Table Alternative -->
                <div class="lg:col-span-5 bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs flex flex-col justify-between">
                    <!-- Chart View -->
                    <div x-show="expenseView === 'chart'" class="w-full h-72 sm:h-80 relative">
                        <canvas 
                            id="expenseDistributionChart"
                            data-expenses='@json($expensesByCategory)'
                        ></canvas>
                    </div>

                    <!-- Accessible Table View / Fallback -->
                    <div x-show="expenseView === 'table'" x-cloak class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50 font-bold text-slate-700">
                                    <th class="py-2.5 px-3">{{ __('category_header') }}</th>
                                    <th class="py-2.5 px-3 text-right">{{ __('amount_header') }}</th>
                                    <th class="py-2.5 px-3 text-right">{{ __('share_header') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($expensesByCategory as $cat)
                                    <tr>
                                        <td class="py-2.5 px-3 font-medium text-slate-800">
                                            {{ $cat['category_name'][$locale] ?? $cat['category_name']['hi'] ?? $cat['key'] }}
                                        </td>
                                        <td class="py-2.5 px-3 text-right font-bold text-slate-900">
                                            {{ format_inr($cat['amount']) }}
                                        </td>
                                        <td class="py-2.5 px-3 text-right font-semibold text-rose-600">
                                            {{ $cat['percentage'] }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t-2 border-slate-300 font-extrabold bg-slate-50">
                                    <td class="py-2.5 px-3">{{ __('total_expenses') }}</td>
                                    <td class="py-2.5 px-3 text-right text-rose-600">{{ format_inr($totalExpenses) }}</td>
                                    <td class="py-2.5 px-3 text-right">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footnote for Accessibility -->
                    <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>{{ __('chart_fallback_title') }}</span>
                        <span class="font-semibold text-slate-700">{{ $expensesByCategory->count() }} {{ __('expense_categories_heading') }}</span>
                    </div>
                </div>
            </div>
        </section>


        <!-- 6. MONTHLY FINANCIAL PERFORMANCE -->
        <section id="monthly" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" x-data="{ monthlyTab: 'chart' }">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs space-y-6">
                <!-- Section Header & Tab Controls -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            12 {{ __('monthly_table_month') }} (April–March)
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            {{ __('monthly_section_title') }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                            {{ __('monthly_section_subtitle') }}
                        </p>
                    </div>

                    <!-- View Selector Tabs -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-lg border border-slate-200 text-xs font-semibold self-start sm:self-auto">
                        <button 
                            @click="monthlyTab = 'chart'"
                            :class="monthlyTab === 'chart' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                        >
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                            {{ __('view_chart') }}
                        </button>
                        <button 
                            @click="monthlyTab = 'table'"
                            :class="monthlyTab === 'table' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-md transition-all flex items-center gap-1.5"
                        >
                            <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            {{ __('view_table') }}
                        </button>
                    </div>
                </div>

                <!-- 1. Interactive Bar Chart -->
                <div x-show="monthlyTab === 'chart'" class="w-full h-80 sm:h-96 relative">
                    <canvas 
                        id="monthlyPerformanceChart"
                        data-monthly='@json($monthlyData)'
                    ></canvas>
                </div>

                <!-- 2. Responsive 12-Month Table -->
                <div x-show="monthlyTab === 'table'" x-cloak class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse min-w-[500px]">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/80 font-bold text-slate-700">
                                <th class="py-3 px-4">{{ __('monthly_table_month') }}</th>
                                <th class="py-3 px-4 text-right">{{ __('monthly_table_income') }}</th>
                                <th class="py-3 px-4 text-right">{{ __('monthly_table_expenses') }}</th>
                                <th class="py-3 px-4 text-right">{{ __('monthly_table_net') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($monthlyData as $row)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="py-3 px-4 font-semibold text-slate-900">
                                        {{ $locale === 'hi' ? $row['name_hi'] : $row['name_en'] }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-extrabold text-emerald-700 font-sans">
                                        {{ format_inr($row['income']) }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-extrabold text-rose-600 font-sans">
                                        {{ format_inr($row['expenses']) }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-extrabold {{ $row['net'] >= 0 ? 'text-navy-900' : 'text-amber-600' }} font-sans">
                                        {{ format_inr($row['net']) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-slate-300 font-extrabold bg-slate-100 text-slate-900">
                                <td class="py-3.5 px-4 uppercase text-xs tracking-wider">
                                    {{ __('app_tagline') }} (Total)
                                </td>
                                <td class="py-3.5 px-4 text-right text-emerald-700 text-sm sm:text-base font-sans">
                                    {{ format_inr($totalIncome) }}
                                </td>
                                <td class="py-3.5 px-4 text-right text-rose-600 text-sm sm:text-base font-sans">
                                    {{ format_inr($totalExpenses) }}
                                </td>
                                <td class="py-3.5 px-4 text-right text-navy-950 text-sm sm:text-base font-sans">
                                    {{ format_inr($balance) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>


        <!-- 7. PROJECTS & INITIATIVES -->
        <section id="projects" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <!-- Section Header -->
            <div class="mb-8 sm:mb-10 text-center sm:text-left">
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    {{ $projects->count() }} {{ __('nav_projects') }}
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ __('projects_section_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl">
                    {{ __('projects_section_subtitle') }}
                </p>
            </div>

            <!-- 8 Project Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                @foreach($projects as $proj)
                    <x-public.project-card 
                        :project="$proj" 
                        :locale="$locale" 
                    />
                @endforeach
            </div>
        </section>


        <!-- 8. RECENT FINANCIAL ACTIVITY (PUBLIC LEDGER) -->
        <section id="ledger" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24" x-data="{ filterType: 'all' }">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs space-y-6">
                <!-- Section Header & Filter Controls -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-navy-800 uppercase tracking-wider mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-navy-800"></span>
                            {{ __('showing_transactions', ['count' => $transactions->count()]) }}
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            {{ __('ledger_section_title') }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                            {{ __('ledger_section_subtitle') }}
                        </p>
                    </div>

                    <!-- Type Filter Buttons -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-lg border border-slate-200 text-xs font-semibold self-start sm:self-auto">
                        <button 
                            @click="filterType = 'all'"
                            :class="filterType === 'all' ? 'bg-white text-slate-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-md transition-all"
                        >
                            {{ __('ledger_filter_all') }}
                        </button>
                        <button 
                            @click="filterType = 'income'"
                            :class="filterType === 'income' ? 'bg-emerald-600 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-md transition-all"
                        >
                            {{ __('ledger_filter_income') }}
                        </button>
                        <button 
                            @click="filterType = 'expense'"
                            :class="filterType === 'expense' ? 'bg-rose-600 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-md transition-all"
                        >
                            {{ __('ledger_filter_expenses') }}
                        </button>
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden sm:block overflow-x-auto custom-scrollbar max-h-[500px] border border-slate-100 rounded-lg">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="sticky top-0 bg-slate-50/95 backdrop-blur-xs border-b border-slate-200 z-10 font-bold text-slate-700">
                            <tr>
                                <th class="py-3 px-4">{{ __('ledger_date') }}</th>
                                <th class="py-3 px-4">{{ __('ledger_type') }}</th>
                                <th class="py-3 px-4">{{ __('ledger_description') }}</th>
                                <th class="py-3 px-4">{{ __('ledger_category') }}</th>
                                <th class="py-3 px-4 text-right">{{ __('ledger_amount') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($transactions as $txn)
                                <tr 
                                    x-show="filterType === 'all' || filterType === '{{ $txn->type }}'" 
                                    class="hover:bg-slate-50/80 transition-colors"
                                >
                                    <td class="py-2.5 px-4 font-medium text-slate-600 whitespace-nowrap">
                                        {{ format_date_localized($txn->date, $locale) }}
                                    </td>
                                    <td class="py-2.5 px-4 whitespace-nowrap">
                                        @if($txn->type === 'income')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                + {{ __('type_income') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                - {{ __('type_expense') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-4 font-medium text-slate-900">
                                        {{ $txn->trans('description', $locale) }}
                                        @if($txn->reference_no)
                                            <span class="text-[10px] text-slate-400 font-mono block">
                                                {{ $txn->reference_no }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-4 text-slate-600 whitespace-nowrap">
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px] font-medium border border-slate-200/60">
                                            {{ $txn->category_name[$locale] ?? $txn->category_name['hi'] ?? $txn->category }}
                                        </span>
                                    </td>
                                    <td class="py-2.5 px-4 text-right font-extrabold text-sm whitespace-nowrap font-sans {{ $txn->type === 'income' ? 'text-emerald-700' : 'text-rose-600' }}">
                                        {{ $txn->type === 'income' ? '+' : '-' }}{{ format_inr($txn->amount) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card Layout for Transactions (Optimized for Small Screens) -->
                <div class="sm:hidden space-y-2.5 max-h-[500px] overflow-y-auto pr-1">
                    @foreach($transactions as $txn)
                        <div 
                            x-show="filterType === 'all' || filterType === '{{ $txn->type }}'" 
                            class="p-3 rounded-lg border border-slate-200 bg-slate-50/50 space-y-1.5"
                        >
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-[11px] text-slate-500 font-medium">
                                    {{ format_date_localized($txn->date, $locale) }}
                                </span>
                                @if($txn->type === 'income')
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        {{ __('type_income') }}
                                    </span>
                                @else
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800">
                                        {{ __('type_expense') }}
                                    </span>
                                @endif
                            </div>
                            <div class="font-bold text-slate-900 text-xs">
                                {{ $txn->trans('description', $locale) }}
                            </div>
                            <div class="flex items-center justify-between pt-1 border-t border-slate-200/60">
                                <span class="text-[10px] text-slate-500 font-medium">
                                    {{ $txn->category_name[$locale] ?? $txn->category_name['hi'] ?? $txn->category }}
                                </span>
                                <span class="font-extrabold text-xs font-sans {{ $txn->type === 'income' ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $txn->type === 'income' ? '+' : '-' }}{{ format_inr($txn->amount) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- 9. HISTORICAL COMPARISON TABLE (YEAR AT A GLANCE) -->
        <section id="history" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs space-y-6">
                <!-- Section Header -->
                <div class="text-center sm:text-left">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        3 {{ __('nav_history') }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('history_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                        {{ __('history_section_subtitle') }}
                    </p>
                </div>

                <!-- Comparison Table -->
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse min-w-[550px]">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/80 font-bold text-slate-700">
                                <th class="py-3.5 px-4">{{ __('history_metric') }}</th>
                                @foreach($historicalSummary as $fy)
                                    <th class="py-3.5 px-4 text-right {{ $fy['is_current'] ? 'bg-blue-50/70 text-blue-900 font-extrabold' : '' }}">
                                        {{ $fy['label'][$locale] ?? $fy['name'] }}
                                        @if($fy['is_current'])
                                            <span class="ml-1 text-[10px] text-blue-700 font-bold">({{ __('status_ongoing') }})</span>
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <!-- Row 1: Total Income -->
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-3 px-4 font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                                    {{ __('total_income') }}
                                </td>
                                @foreach($historicalSummary as $fy)
                                    <td class="py-3 px-4 text-right font-extrabold text-emerald-700 font-sans {{ $fy['is_current'] ? 'bg-blue-50/30' : '' }}">
                                        {{ format_inr($fy['income']) }}
                                        <span class="text-[10px] text-slate-500 font-normal block">
                                            {{ format_inr_short($fy['income'], $locale) }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Row 2: Total Expenses -->
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-3 px-4 font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                                    {{ __('total_expenses') }}
                                </td>
                                @foreach($historicalSummary as $fy)
                                    <td class="py-3 px-4 text-right font-extrabold text-rose-600 font-sans {{ $fy['is_current'] ? 'bg-blue-50/30' : '' }}">
                                        {{ format_inr($fy['expenses']) }}
                                        <span class="text-[10px] text-slate-500 font-normal block">
                                            {{ format_inr_short($fy['expenses'], $locale) }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Row 3: Closing Balance -->
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-3 px-4 font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-navy-900"></span>
                                    {{ __('available_balance') }}
                                </td>
                                @foreach($historicalSummary as $fy)
                                    <td class="py-3 px-4 text-right font-extrabold text-navy-950 font-sans {{ $fy['is_current'] ? 'bg-blue-50/30' : '' }}">
                                        {{ format_inr($fy['balance']) }}
                                        <span class="text-[10px] text-slate-500 font-normal block">
                                            {{ format_inr_short($fy['balance'], $locale) }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Row 4: Annual Target -->
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-3 px-4 font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    {{ __('fundraising_target') }}
                                </td>
                                @foreach($historicalSummary as $fy)
                                    <td class="py-3 px-4 text-right font-extrabold text-blue-700 font-sans {{ $fy['is_current'] ? 'bg-blue-50/30' : '' }}">
                                        {{ format_inr($fy['target']) }}
                                        <span class="text-[10px] text-slate-500 font-normal block">
                                            {{ format_inr_short($fy['target'], $locale) }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <!-- 10. DOWNLOADABLE REPORTS & DOCUMENTS -->
        <section id="reports" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <!-- Section Header -->
            <div class="mb-8 sm:mb-10 text-center sm:text-left">
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    {{ $reports->count() }} {{ __('nav_reports') }}
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ __('reports_section_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl">
                    {{ __('reports_section_subtitle') }}
                </p>
            </div>

            <!-- Report Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @foreach($reports as $rep)
                    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-xs hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ __('report_type_'.$rep->type) }}
                                </span>
                                <span class="text-[11px] text-slate-500 font-medium">
                                    {{ $rep->file_size }}
                                </span>
                            </div>

                            <h3 class="font-bold text-slate-900 text-base leading-snug group-hover:text-blue-700 transition-colors">
                                {{ $rep->trans('title', $locale) }}
                            </h3>

                            <div class="text-[11px] text-slate-500 font-medium">
                                {{ __('last_updated') }}: {{ format_date_localized($rep->published_at, $locale) }}
                            </div>
                        </div>

                        <!-- Action Buttons (Download / View) -->
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                            <a 
                                href="{{ route('reports.download', $rep) }}" 
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-900 py-1"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ __('report_view') }}
                            </a>

                            <a 
                                href="{{ route('reports.download', $rep) }}" 
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-slate-900 text-white hover:bg-blue-700 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                {{ __('report_download') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <!-- 11. TRANSPARENCY COMMITMENT -->
        <section id="transparency" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-blue-50/70 border border-blue-200/80 rounded-2xl p-6 sm:p-10">
                <div class="max-w-3xl mx-auto text-center space-y-4 mb-8">
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-blue-100 text-blue-800 text-xs font-bold border border-blue-200">
                        {{ __('app_name') }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('transparency_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                        {{ __('transparency_section_text') }}
                    </p>
                </div>

                <!-- 3 Pillars Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pillar 1: Open Reporting -->
                    <div class="bg-white p-5 sm:p-6 rounded-xl border border-blue-100 shadow-2xs space-y-2">
                        <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-base">
                            {{ __('pillar_1_title') }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ __('pillar_1_desc') }}
                        </p>
                    </div>

                    <!-- Pillar 2: Responsible Spending -->
                    <div class="bg-white p-5 sm:p-6 rounded-xl border border-blue-100 shadow-2xs space-y-2">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-base">
                            {{ __('pillar_2_title') }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ __('pillar_2_desc') }}
                        </p>
                    </div>

                    <!-- Pillar 3: Community Accountability -->
                    <div class="bg-white p-5 sm:p-6 rounded-xl border border-blue-100 shadow-2xs space-y-2">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-base">
                            {{ __('pillar_3_title') }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ __('pillar_3_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- 12. ABOUT SOCIETY & KEY STATS -->
        <section id="about" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-xs space-y-8">
                <div class="max-w-3xl space-y-3">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        {{ __('founded_year') }} &bull; {{ __('location') }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('about_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ __('about_section_text') }}
                    </p>
                </div>

                <!-- Key Statistics Strip -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 pt-2">
                    @foreach($stats as $st)
                        <div class="bg-slate-50 p-5 rounded-xl border border-slate-200/80 text-center">
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy-950 font-sans">
                                {{ $st->value }}
                            </div>
                            <div class="text-xs sm:text-sm font-bold text-slate-800 mt-1">
                                {{ $st->trans('label', $locale) }}
                            </div>
                            @if($st->subtext)
                                <div class="text-[11px] text-slate-500 font-medium mt-0.5">
                                    {{ $st->trans('subtext', $locale) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- 13. ANNOUNCEMENTS & UPDATES -->
        <section id="announcements" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <!-- Section Header -->
            <div class="mb-8 sm:mb-10 text-center sm:text-left">
                <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    {{ $announcements->count() }} {{ __('updates_section_title') }}
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ __('updates_section_title') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                    {{ __('updates_section_subtitle') }}
                </p>
            </div>

            <!-- Announcements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                @foreach($announcements as $ann)
                    <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 shadow-xs hover:border-blue-300 transition-colors space-y-2.5">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-semibold text-slate-500">
                                {{ format_date_localized($ann->published_at, $locale) }}
                            </span>
                            @if($ann->tag)
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60">
                                    {{ $ann->trans('tag', $locale) }}
                                </span>
                            @endif
                        </div>
                        <h3 class="font-bold text-slate-900 text-base leading-snug">
                            {{ $ann->trans('title', $locale) }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            {{ $ann->trans('description', $locale) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>


        <!-- 14. FAQ ACCORDION SECTION -->
        <section id="faq" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-xs space-y-8">
                <!-- Section Header -->
                <div class="max-w-2xl space-y-2 text-center sm:text-left">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        FAQ
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ __('faq_section_title') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600">
                        {{ __('faq_section_subtitle') }}
                    </p>
                </div>

                <!-- Accordion Items -->
                <div class="space-y-3" x-data="{ activeFaq: 1 }">
                    @foreach($faqs as $faq)
                        <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors">
                            <button 
                                @click="activeFaq = (activeFaq === {{ $faq->id }} ? null : {{ $faq->id }})"
                                class="w-full px-5 py-4 text-left font-bold text-slate-900 text-sm sm:text-base flex items-center justify-between gap-4 bg-slate-50/50 hover:bg-slate-100/70 transition-colors"
                            >
                                <span>{{ $faq->trans('question', $locale) }}</span>
                                <svg 
                                    :class="activeFaq === {{ $faq->id }} ? 'rotate-180 text-blue-600' : 'text-slate-400'"
                                    class="w-5 h-5 shrink-0 transition-transform duration-200" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div 
                                x-show="activeFaq === {{ $faq->id }}" 
                                x-cloak 
                                x-collapse
                                class="px-5 py-4 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 bg-white"
                            >
                                {{ $faq->trans('answer', $locale) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <!-- 15. CONTACT SECTION -->
        <section id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-24">
            <div class="bg-gradient-to-br from-navy-950 to-slate-900 text-white rounded-2xl p-6 sm:p-10 shadow-lg border border-navy-900">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-6 space-y-4 text-center lg:text-left">
                        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 uppercase tracking-wider">
                            {{ __('app_name') }}
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            {{ __('contact_section_title') }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-lg">
                            {{ __('contact_section_subtitle') }}
                        </p>
                    </div>

                    <!-- Contact Details Card -->
                    <div class="lg:col-span-6 bg-slate-900/90 p-5 sm:p-6 rounded-xl border border-slate-800 space-y-4 text-xs sm:text-sm">
                        <!-- Address -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <span class="font-bold text-slate-100 block">{{ __('app_name') }}</span>
                                <span class="text-slate-400">{{ __('contact_address_val') }}</span>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="font-bold text-slate-100 block">{{ __('contact_office_hours') }}</span>
                                <span class="text-slate-400">{{ __('contact_hours_val') }}</span>
                            </div>
                        </div>

                        <!-- Quick Action Buttons -->
                        <div class="pt-3 border-t border-slate-800 flex flex-wrap items-center gap-3">
                            <a 
                                href="tel:{{ __('contact_phone') }}" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition-colors"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ __('btn_call') }}
                            </a>

                            <a 
                                href="mailto:{{ __('contact_email') }}" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs border border-slate-700 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ __('btn_email') }}
                            </a>

                            <a 
                                href="https://maps.google.com/?q=Udaipur+Rajasthan" 
                                target="_blank" 
                                rel="noopener"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs border border-slate-700 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                {{ __('btn_directions') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Institutional Footer -->
    <x-public.footer 
        :locale="$locale" 
        :last-updated-formatted="$lastUpdatedFormatted" 
    />

    <!-- Mobile Fixed Bottom Navigation -->
    <x-public.mobile-nav 
        :locale="$locale" 
    />

</body>
</html>
