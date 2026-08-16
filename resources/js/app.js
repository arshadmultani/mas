import './bootstrap';
import Alpine from 'alpinejs';
import {
    Chart,
    BarController,
    BarElement,
    DoughnutController,
    ArcElement,
    LineController,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
    Filler
} from 'chart.js';

// Register Chart.js components
Chart.register(
    BarController,
    BarElement,
    DoughnutController,
    ArcElement,
    LineController,
    LineElement,
    PointElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
    Filler
);

window.Chart = Chart;
window.Alpine = Alpine;

// Global helper for formatting INR in JS
window.formatINR = function (amount) {
    if (amount === null || amount === undefined || isNaN(amount)) return '₹0';
    const num = Math.round(Number(amount));
    const isNeg = num < 0;
    const abs = Math.abs(num).toString();
    
    let lastThree = abs.substring(abs.length - 3);
    let otherNumbers = abs.substring(0, abs.length - 3);
    if (otherNumbers !== '') {
        lastThree = ',' + lastThree;
    }
    const res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;
    return (isNeg ? '-' : '') + '₹' + res;
};

// Initialize interactive charts when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // 1. Monthly Performance Chart
    const monthlyCanvas = document.getElementById('monthlyPerformanceChart');
    if (monthlyCanvas) {
        const rawMonthlyData = JSON.parse(monthlyCanvas.dataset.monthly || '[]');
        const locale = document.documentElement.lang || 'hi';
        const labels = rawMonthlyData.map(m => locale === 'hi' ? m.name_hi : m.name_en);
        const incomeData = rawMonthlyData.map(m => m.income);
        const expenseData = rawMonthlyData.map(m => m.expenses);
        const netData = rawMonthlyData.map(m => m.net);

        new Chart(monthlyCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: locale === 'hi' ? 'मासिक आय' : 'Monthly Income',
                        data: incomeData,
                        backgroundColor: '#16a34a',
                        hoverBackgroundColor: '#15803d',
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.7,
                        categoryPercentage: 0.75,
                    },
                    {
                        label: locale === 'hi' ? 'मासिक खर्च' : 'Monthly Expenses',
                        data: expenseData,
                        backgroundColor: '#dc2626',
                        hoverBackgroundColor: '#b91c1c',
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.7,
                        categoryPercentage: 0.75,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 14,
                            boxHeight: 14,
                            borderRadius: 4,
                            useBorderRadius: true,
                            font: {
                                family: locale === 'hi' ? "'Noto Sans Devanagari', sans-serif" : "'Plus Jakarta Sans', sans-serif",
                                size: 12,
                                weight: 600,
                            },
                            color: '#334155'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            family: locale === 'hi' ? "'Noto Sans Devanagari', sans-serif" : "'Plus Jakarta Sans', sans-serif",
                            size: 13,
                            weight: 700,
                        },
                        bodyFont: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12,
                        },
                        callbacks: {
                            label: function (context) {
                                return ` ${context.dataset.label}: ${window.formatINR(context.raw)}`;
                            },
                            afterBody: function (contexts) {
                                const inc = contexts[0]?.raw || 0;
                                const exp = contexts[1]?.raw || 0;
                                const net = inc - exp;
                                const label = locale === 'hi' ? 'शुद्ध शेष (Net)' : 'Net Balance';
                                return `\n ${label}: ${window.formatINR(net)}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            font: {
                                family: locale === 'hi' ? "'Noto Sans Devanagari', sans-serif" : "'Plus Jakarta Sans', sans-serif",
                                size: 11,
                                weight: 500,
                            },
                            color: '#64748b'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                        },
                        ticks: {
                            callback: function (val) {
                                if (val >= 100000) {
                                    return '₹' + (val / 100000).toFixed(1) + (locale === 'hi' ? ' लाख' : 'L');
                                }
                                return '₹' + (val / 1000) + 'k';
                            },
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 11,
                            },
                            color: '#64748b'
                        }
                    }
                }
            }
        });
    }

    // 2. Income Sources Doughnut Chart
    const incomeCanvas = document.getElementById('incomeDistributionChart');
    if (incomeCanvas) {
        const rawIncomeData = JSON.parse(incomeCanvas.dataset.incomes || '[]');
        const locale = document.documentElement.lang || 'hi';
        const labels = rawIncomeData.map(c => c.category_name[locale] || c.category_name.hi || c.category_name.en || c.key);
        const amounts = rawIncomeData.map(c => c.amount);

        const colors = [
            '#16a34a',
            '#2563eb',
            '#0d9488',
            '#d97706',
            '#6366f1',
            '#84cc16'
        ];

        new Chart(incomeCanvas, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: amounts,
                    backgroundColor: colors.slice(0, amounts.length),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            boxHeight: 12,
                            borderRadius: 3,
                            useBorderRadius: true,
                            padding: 16,
                            font: {
                                family: locale === 'hi' ? "'Noto Sans Devanagari', sans-serif" : "'Plus Jakarta Sans', sans-serif",
                                size: 12,
                                weight: 600,
                            },
                            color: '#334155'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const val = context.raw;
                                const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                return ` ${window.formatINR(val)} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // 3. Expense Categories Doughnut Chart
    const expenseCanvas = document.getElementById('expenseDistributionChart');
    if (expenseCanvas) {
        const rawExpenseData = JSON.parse(expenseCanvas.dataset.expenses || '[]');
        const locale = document.documentElement.lang || 'hi';
        const labels = rawExpenseData.map(c => c.category_name[locale] || c.category_name.hi || c.category_name.en || c.key);
        const amounts = rawExpenseData.map(c => c.amount);

        const expenseColors = [
            '#dc2626',
            '#ea580c',
            '#d97706',
            '#4f46e5',
            '#0284c7',
            '#059669',
            '#7c3aed'
        ];

        new Chart(expenseCanvas, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: amounts,
                    backgroundColor: expenseColors.slice(0, amounts.length),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            boxHeight: 12,
                            borderRadius: 3,
                            useBorderRadius: true,
                            padding: 14,
                            font: {
                                family: locale === 'hi' ? "'Noto Sans Devanagari', sans-serif" : "'Plus Jakarta Sans', sans-serif",
                                size: 11.5,
                                weight: 600,
                            },
                            color: '#334155'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#e2e8f0',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const val = context.raw;
                                const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                return ` ${window.formatINR(val)} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
});

// Start Alpine
Alpine.start();
