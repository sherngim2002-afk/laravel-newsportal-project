<?php

namespace App\Filament\Widgets;

use App\Models\Advertise;
use App\Models\Article;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Categories', Category::count())
                ->url(route('filament.admin.resources.categories.index')),
            Stat::make('Total Articles', Article::count())
                ->url(route('filament.admin.resources.articles.index')),
            Stat::make('Total Advertises', Advertise::count())
                ->url(route('filament.admin.resources.advertises.index')),
        ];
    }
}
