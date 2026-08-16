<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Faq;
use App\Models\FinancialYear;
use App\Models\Report;
use App\Models\SocietyStat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class PublicDashboardController extends Controller
{
    /**
     * Display the public transparency dashboard.
     */
    public function index(Request $request): View
    {
        $locale = App::getLocale();

        // 1. All financial years
        $allFinancialYears = FinancialYear::orderBy('start_date', 'desc')->get();

        // 2. Selected financial year (via ?year=2026-27, or fallback to current, or first)
        $selectedYearName = $request->query('year');
        $financialYear = $allFinancialYears->firstWhere('name', $selectedYearName)
            ?? $allFinancialYears->firstWhere('is_current', true)
            ?? $allFinancialYears->first();

        abort_if(! $financialYear, 500, 'No financial year data found. Please run seeders.');

        // 3. Overall Financial Overview calculations
        $totalIncome = (float) $financialYear->incomes()->sum('amount');
        $totalExpenses = (float) $financialYear->expenses()->sum('amount');
        $balance = $totalIncome - $totalExpenses;
        $target = (float) $financialYear->target_amount;

        $targetPercentage = $target > 0 ? min(100, round(($totalIncome / $target) * 100, 1)) : 0;
        $remainingTarget = max(0, $target - $totalIncome);
        $expenseToIncomePercentage = $totalIncome > 0 ? round(($totalExpenses / $totalIncome) * 100, 1) : 0;
        $balanceToIncomePercentage = $totalIncome > 0 ? round(($balance / $totalIncome) * 100, 1) : 0;

        $incomeGrowthPrevYear = 0;
        if ($financialYear->previous_year_income && $financialYear->previous_year_income > 0) {
            $incomeGrowthPrevYear = round(
                (($totalIncome - (float) $financialYear->previous_year_income) / (float) $financialYear->previous_year_income) * 100,
                1
            );
        }

        // 4. Income by Category Breakdown
        $incomesRaw = $financialYear->incomes()->get();
        $incomeByCategory = $incomesRaw->groupBy('category')->map(function ($items, $categoryKey) use ($totalIncome) {
            $catAmount = (float) $items->sum('amount');
            $first = $items->first();
            $percentage = $totalIncome > 0 ? round(($catAmount / $totalIncome) * 100, 1) : 0;

            return [
                'key' => $categoryKey,
                'category_name' => $first->category_name ?? ['hi' => $categoryKey, 'en' => $categoryKey],
                'amount' => $catAmount,
                'percentage' => $percentage,
                'count' => $items->count(),
            ];
        })->sortByDesc('amount')->values();

        // 5. Expenses by Category Breakdown
        $expensesRaw = $financialYear->expenses()->get();
        $expensesByCategory = $expensesRaw->groupBy('category')->map(function ($items, $categoryKey) use ($totalExpenses) {
            $catAmount = (float) $items->sum('amount');
            $first = $items->first();
            $percentage = $totalExpenses > 0 ? round(($catAmount / $totalExpenses) * 100, 1) : 0;

            return [
                'key' => $categoryKey,
                'category_name' => $first->category_name ?? ['hi' => $categoryKey, 'en' => $categoryKey],
                'amount' => $catAmount,
                'percentage' => $percentage,
                'count' => $items->count(),
            ];
        })->sortByDesc('amount')->values();

        // 6. Monthly Breakdown (April to March for Indian FY)
        $monthOrder = [
            4 => ['en' => 'April', 'hi' => 'अप्रैल', 'short_en' => 'Apr', 'short_hi' => 'अप्रै'],
            5 => ['en' => 'May', 'hi' => 'मई', 'short_en' => 'May', 'short_hi' => 'मई'],
            6 => ['en' => 'June', 'hi' => 'जून', 'short_en' => 'Jun', 'short_hi' => 'जून'],
            7 => ['en' => 'July', 'hi' => 'जुलाई', 'short_en' => 'Jul', 'short_hi' => 'जुला'],
            8 => ['en' => 'August', 'hi' => 'अगस्त', 'short_en' => 'Aug', 'short_hi' => 'अग'],
            9 => ['en' => 'September', 'hi' => 'सितंबर', 'short_en' => 'Sep', 'short_hi' => 'सितं'],
            10 => ['en' => 'October', 'hi' => 'अक्टूबर', 'short_en' => 'Oct', 'short_hi' => 'अक्टू'],
            11 => ['en' => 'November', 'hi' => 'नवंबर', 'short_en' => 'Nov', 'short_hi' => 'नव'],
            12 => ['en' => 'December', 'hi' => 'दिसंबर', 'short_en' => 'Dec', 'short_hi' => 'दिसं'],
            1 => ['en' => 'January', 'hi' => 'जनवरी', 'short_en' => 'Jan', 'short_hi' => 'जन'],
            2 => ['en' => 'February', 'hi' => 'फ़रवरी', 'short_en' => 'Feb', 'short_hi' => 'फ़र'],
            3 => ['en' => 'March', 'hi' => 'मार्च', 'short_en' => 'Mar', 'short_hi' => 'मार्च'],
        ];

        $monthlyData = [];
        foreach ($monthOrder as $mNum => $names) {
            $monthIncomes = $incomesRaw->filter(fn ($item) => (int) Carbon::parse($item->date)->format('n') === $mNum);
            $monthExpenses = $expensesRaw->filter(fn ($item) => (int) Carbon::parse($item->date)->format('n') === $mNum);

            $mIncome = (float) $monthIncomes->sum('amount');
            $mExpense = (float) $monthExpenses->sum('amount');
            $mNet = $mIncome - $mExpense;

            $monthlyData[] = [
                'month_num' => $mNum,
                'name_en' => $names['en'],
                'name_hi' => $names['hi'],
                'short_en' => $names['short_en'],
                'short_hi' => $names['short_hi'],
                'name' => $names[$locale] ?? $names['hi'],
                'short' => $names['short_'.$locale] ?? $names['short_hi'],
                'income' => $mIncome,
                'expenses' => $mExpense,
                'net' => $mNet,
            ];
        }

        // 7. Projects & Initiatives
        $projects = $financialYear->projects()->with('expenses')->get()->map(function ($proj) {
            $spent = (float) $proj->expenses->sum('amount');
            $budget = (float) $proj->budget;
            $remaining = max(0, $budget - $spent);
            $progressPct = $budget > 0 ? min(100, round(($spent / $budget) * 100, 1)) : 0;

            return [
                'id' => $proj->id,
                'slug' => $proj->slug,
                'name' => $proj->name,
                'description' => $proj->description,
                'budget' => $budget,
                'spent' => $spent,
                'remaining' => $remaining,
                'progress_percentage' => $progressPct,
                'status' => $proj->status,
                'beneficiaries_count' => $proj->beneficiaries_count,
            ];
        });

        // 8. Transactions (Public Ledger)
        $transactions = $financialYear->transactions()
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // 9. Multi-Year Historical Summary ("Year at a Glance")
        $historicalSummary = $allFinancialYears->sortBy('start_date')->map(function ($fy) {
            $inc = (float) $fy->incomes()->sum('amount');
            $exp = (float) $fy->expenses()->sum('amount');
            $bal = $inc - $exp;
            $tgt = (float) $fy->target_amount;

            return [
                'name' => $fy->name,
                'label' => $fy->label,
                'is_current' => $fy->is_current,
                'income' => $inc,
                'expenses' => $exp,
                'balance' => $bal,
                'target' => $tgt,
            ];
        })->values();

        // 10. Announcements
        $announcements = Announcement::where('is_published', true)
            ->orderBy('order')
            ->orderBy('published_at', 'desc')
            ->get();

        // 11. Reports & Documents
        $reports = Report::where(function ($q) use ($financialYear) {
            $q->where('financial_year_id', $financialYear->id)
                ->orWhereNull('financial_year_id');
        })
            ->orderBy('order')
            ->orderBy('published_at', 'desc')
            ->get();

        // 12. Society Stats & FAQs
        $stats = SocietyStat::orderBy('order')->get();
        $faqs = Faq::orderBy('order')->get();

        // 13. Latest update date (from transactions, income or current date)
        $latestDate = $transactions->max('date') ?? Carbon::now()->toDateString();
        $lastUpdatedFormatted = format_date_localized($latestDate, $locale);

        return view('public.dashboard', compact(
            'locale',
            'financialYear',
            'allFinancialYears',
            'totalIncome',
            'totalExpenses',
            'balance',
            'target',
            'targetPercentage',
            'remainingTarget',
            'expenseToIncomePercentage',
            'balanceToIncomePercentage',
            'incomeGrowthPrevYear',
            'incomeByCategory',
            'expensesByCategory',
            'monthlyData',
            'projects',
            'transactions',
            'historicalSummary',
            'announcements',
            'reports',
            'stats',
            'faqs',
            'lastUpdatedFormatted'
        ));
    }

    /**
     * Download or view a sample transparency report.
     */
    public function downloadReport(Report $report): Response
    {
        $locale = App::getLocale();
        $title = is_array($report->title) ? ($report->title[$locale] ?? reset($report->title)) : $report->title;

        // Generate a clean institutional text-based report / summary for prototype download
        $content = "MULTANI AGRAHAN SOCIETY, UDAIPUR\n";
        $content .= "====================================================\n";
        $content .= "PUBLIC FINANCIAL TRANSPARENCY REPORT\n";
        $content .= "Document: {$title}\n";
        $content .= 'Type: '.strtoupper($report->type)."\n";
        $content .= "Published: {$report->published_at->format('d F Y')}\n";
        $content .= "====================================================\n\n";
        $content .= "Notice: This is an official transparency summary generated by the\n";
        $content .= "Multani Agrahan Society Financial Portal, Udaipur, Rajasthan.\n\n";
        $content .= "DEMO DOCUMENT - All figures in this demo prototype are illustrative.\n";

        $filename = 'MAS_Report_'.str_replace(' ', '_', $title).'.txt';

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
