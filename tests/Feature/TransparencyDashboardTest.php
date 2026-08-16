<?php

use App\Models\FinancialYear;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

it('defaults to hindi language on initial visit', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertSee('lang="hi"', false);
    $response->assertSee('मुल्तानी अग्रहन सोसाइटी, उदयपुर');
    $response->assertSee('पारदर्शिता, जिसे आप देख सकते हैं।');
    $response->assertSee('डेमो डेटा');
});

it('switches to english and remembers preference in session and cookies', function () {
    // Switch to English
    $response = $this->get('/locale/en');

    $response->assertRedirect('/');
    $response->assertSessionHas('locale', 'en');
    $response->assertCookie('locale', 'en');

    // Visit dashboard with English session
    $dashboard = $this->withSession(['locale' => 'en'])->get('/');
    $dashboard->assertSuccessful();
    $dashboard->assertSee('lang="en"', false);
    $dashboard->assertSee('Multani Agrahan Society, Udaipur');
    $dashboard->assertSee('Transparency You Can See.');
    $dashboard->assertSee('Demo Data');
});

it('switches back to hindi cleanly', function () {
    $response = $this->withSession(['locale' => 'en'])->get('/locale/hi');

    $response->assertRedirect('/');
    $response->assertSessionHas('locale', 'hi');
    $response->assertCookie('locale', 'hi');

    $dashboard = $this->withSession(['locale' => 'hi'])->get('/');
    $dashboard->assertSuccessful();
    $dashboard->assertSee('lang="hi"', false);
    $dashboard->assertSee('मुल्तानी अग्रहन सोसाइटी, उदयपुर');
});

it('mathematically reconciles financial totals for fy 2026-27', function () {
    $fy = FinancialYear::where('name', '2026-27')->firstOrFail();

    $totalIncome = (float) $fy->incomes()->sum('amount');
    $totalExpenses = (float) $fy->expenses()->sum('amount');
    $balance = $totalIncome - $totalExpenses;
    $target = (float) $fy->target_amount;
    $achievementPct = round(($totalIncome / $target) * 100, 1);
    $remainingTarget = $target - $totalIncome;

    expect($totalIncome)->toBe(1875000.0)
        ->and($totalExpenses)->toBe(1142500.0)
        ->and($balance)->toBe(732500.0)
        ->and($target)->toBe(2500000.0)
        ->and($achievementPct)->toBe(75.0)
        ->and($remainingTarget)->toBe(625000.0);

    // Verify rendered amounts on the dashboard
    $response = $this->get('/');
    $response->assertSuccessful();
    $response->assertSee('₹18,75,000');
    $response->assertSee('₹11,42,500');
    $response->assertSee('₹7,32,500');
    $response->assertSee('₹25,00,000');
    $response->assertSee('75%');
});

it('verifies exact category allocations for fy 2026-27', function () {
    $fy = FinancialYear::where('name', '2026-27')->firstOrFail();

    $incomes = $fy->incomes()->get()->groupBy('category')->map->sum('amount');
    expect((float) $incomes['membership_contributions'])->toBe(425000.0)
        ->and((float) $incomes['donations'])->toBe(680000.0)
        ->and((float) $incomes['community_contributions'])->toBe(320000.0)
        ->and((float) $incomes['events_activities'])->toBe(210000.0)
        ->and((float) $incomes['other_receipts'])->toBe(240000.0);

    $expenses = $fy->expenses()->get()->groupBy('category')->map->sum('amount');
    expect((float) $expenses['community_welfare'])->toBe(310000.0)
        ->and((float) $expenses['education_support'])->toBe(185000.0)
        ->and((float) $expenses['medical_assistance'])->toBe(140000.0)
        ->and((float) $expenses['events_cultural'])->toBe(165000.0)
        ->and((float) $expenses['infrastructure_maintenance'])->toBe(130000.0)
        ->and((float) $expenses['administrative'])->toBe(112500.0)
        ->and((float) $expenses['other_expenses'])->toBe(100000.0);
});

it('displays all 8 community projects with valid progress and budgets', function () {
    $projects = Project::all();

    expect($projects)->toHaveCount(8);

    $response = $this->get('/');
    $response->assertSuccessful();

    foreach ($projects as $project) {
        $response->assertSee($project->trans('name', 'hi'));
        expect($project->progress_percentage)->toBeGreaterThanOrEqual(0)
            ->and($project->progress_percentage)->toBeLessThanOrEqual(100);
    }
});

it('can filter and view historical financial years via query parameter', function () {
    // Check FY 2025-26
    $response2526 = $this->get('/?year=2025-26');
    $response2526->assertSuccessful();
    $response2526->assertSee('₹16,80,000');
    $response2526->assertSee('₹10,90,000');
    $response2526->assertSee('₹5,90,000');

    // Check FY 2024-25
    $response2425 = $this->get('/?year=2024-25');
    $response2425->assertSuccessful();
    $response2425->assertSee('₹14,20,000');
    $response2425->assertSee('₹9,80,000');
    $response2425->assertSee('₹4,40,000');
});

it('allows viewing or downloading generated financial reports', function () {
    $report = Report::firstOrFail();

    $response = $this->get(route('reports.download', $report));

    $response->assertSuccessful();
    $response->assertHeader('Content-Disposition');
    $response->assertSee('MULTANI AGRAHAN SOCIETY, UDAIPUR');
    $response->assertSee($report->trans('title', 'hi'));
});

it('verifies indian currency format and localized date helpers', function () {
    expect(format_inr(1875000))->toBe('₹18,75,000')
        ->and(format_inr(1142500))->toBe('₹11,42,500')
        ->and(format_inr(732500))->toBe('₹7,32,500')
        ->and(format_inr(500))->toBe('₹500')
        ->and(format_inr_short(1875000, 'hi'))->toBe('₹18.75 लाख')
        ->and(format_inr_short(1875000, 'en'))->toBe('₹18.75 Lakh');
});
