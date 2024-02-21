<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArticleStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected static bool $isLazy = false;

    /**
     * https://filamentphp.com/docs/3.x/panels/resources/widgets#creating-a-resource-widget
    */
    protected function getStats(): array
    {
        $publishe = Article::where('status', 'published')->withCount('author')->count();


        return [
            Stat::make('Total de artigos', Article::all()->count())
                ->description('Publicados: ', $publishe)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total de categorias', Category::all()->count())
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Total de Tags', Tag::all()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
