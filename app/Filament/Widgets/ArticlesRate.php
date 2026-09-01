<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ArticlesRate extends ChartWidget
{
    protected ?string $heading = 'Articles Posted by Month';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        // Get article count grouped by month
        $articles = Article::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $data[] = $articles[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Articles',
                    'data' => $data,
                    'fill' => false,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
