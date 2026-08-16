<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_years', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. 2026-27
            $table->json('label'); // {"hi": "2026–27", "en": "2026–27"}
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('target_amount', 14, 2)->default(0);
            $table->decimal('previous_year_income', 14, 2)->nullable();
            $table->boolean('is_current')->default(false)->index();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->index();
            $table->json('name'); // {"hi": "...", "en": "..."}
            $table->json('description');
            $table->decimal('budget', 14, 2);
            $table->string('status')->default('ongoing'); // ongoing, completed, near_completion, planned
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('beneficiaries_count')->default(0);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('category')->index(); // membership_contributions, donations, etc.
            $table->json('category_name');
            $table->json('description')->nullable();
            $table->json('source')->nullable();
            $table->decimal('amount', 14, 2);
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->date('date');
            $table->string('category')->index();
            $table->json('category_name');
            $table->json('description')->nullable();
            $table->json('vendor')->nullable();
            $table->decimal('amount', 14, 2);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('type')->index(); // income, expense
            $table->string('category')->index();
            $table->json('category_name');
            $table->json('description');
            $table->decimal('amount', 14, 2);
            $table->string('reference_no')->nullable();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('tag')->nullable();
            $table->date('published_at');
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->nullable()->constrained()->nullOnDelete();
            $table->json('title');
            $table->string('type'); // financial, activity, audit, budget
            $table->string('file_path');
            $table->string('file_size')->default('1.2 MB');
            $table->date('published_at');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->json('question');
            $table->json('answer');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('society_stats', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->json('label');
            $table->string('value');
            $table->json('subtext')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_stats');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('financial_years');
    }
};
