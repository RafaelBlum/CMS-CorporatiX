<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use App\Filament\Clusters\Blog;
use Filament\Pages\SubNavigationPosition;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

//    protected static ?string $navigationGroup = "Blog";
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $activeNavigationIcon = 'heroicon-o-book-open';

    protected static ?string $modelLabel = "Categoria";

    protected static ?string $cluster = Blog::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Título da categoria')
                    ->required()
                    ->maxLength(100)
                    ->live(debounce: '1000')
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true),
            ]);
    }

    /**
     * table category list
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->description(function (Category $record) {
                        return "Total de artigos " . $record->articles()->count();
                    })
                    ->tooltip(fn (Model $record): string => "Categoria {$record->name}")
                    ->extraAttributes([
                        'class' => 'text-xs',
                    ])
                    ->searchable(),

                TextColumn::make('articles_count')
                    ->counts('articles')
                    ->label('Artigos pertencentes'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Relations with category
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * route categories
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
