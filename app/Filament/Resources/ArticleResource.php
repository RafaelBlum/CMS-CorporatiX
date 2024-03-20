<?php

namespace App\Filament\Resources;


use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStatsOverview;
use App\Models\Article;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as SectionInfo;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Enums\StatusArticleEnum;

use App\Filament\Clusters\Blog;
use Filament\Pages\SubNavigationPosition;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

//    protected static ?string $navigationGroup = "Blog";
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $activeNavigationIcon = 'heroicon-o-book-open';

    protected static ?string $pluralModelLabel = "Artigos";
    protected static ?string $modelLabel = "Artigo";

    protected static ?string $cluster = Blog::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    /**
     * Form create or edit article
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3)->schema([

                    Section::make()->schema([
                        FileUpload::make('featured_image_url')
                            ->label('Imagem do artigo')
                            ->required()
                            ->disk('public')
                            ->directory('image_posts')
                            ->columnSpanFull(),

                    ])->columnSpan(1),

                    Section::make()->schema([
                        Grid::make(4)->schema([
                            Group::make()->schema([
                                TextInput::make('title')
                                    ->label('Título do artigo')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(debounce: '1000')
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
//                                    TextInput::make('slug')
//                                        ->maxLength(255)
//                                        ->disabled()
//                                        ->dehydrated()
//                                        ->unique(ignoreRecord: true),
                            ])->columnSpan(4),
                        ]),

                        Grid::make(4)->schema([
                            Group::make()->schema([


                            ])->columnSpan(2),

                            Group::make()->schema([

                            ])->columnSpan(2),
                        ]),

                        Grid::make(11)->schema([
                            Group::make()->schema([


                            ])->columnSpan(1),

                            Group::make()->schema([

                            ])->columnSpan(5),

                            Group::make()->schema([

                            ])->columnSpan(5),
                        ]),

                    ])->columnSpan(2),
                ]),

                Tabs::make('Create article')->tabs([

                    Tab::make('Configurações')->icon('heroicon-m-inbox')->schema([
                            Grid::make(8)->schema([
                                Group::make()->schema([
                                    Select::make('tags')
                                        ->label('Tags')
                                        ->multiple()
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->distinct()
                                        ->relationship('tags', 'name'),

                                ])->columnSpan(2),

                                Group::make()->schema([
                                    Select::make('category_id')
                                        ->label('Categoria')
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->distinct()
                                        ->relationship('category', 'name'),
                                ])->columnSpan(2),

                                Group::make()->schema([
                                    Select::make('status')
                                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Selecione o status do seu artigo.')
                                        ->hintColor('primary')
                                        ->default('draft')
                                        ->options(StatusArticleEnum::class)
                                        ->live()
                                        ->required(),

                                ])->columnSpan(function (Get $get) {
                                                    if($get('status') == 'published' || $get('status') == 'scheduled'){
                                                        return 2;
                                                    }else{
                                                        return 4;
                                                    }
                                                }),

                                Group::make()->schema([
                                    DatePicker::make('published_at')->hidden(fn (Get $get) => $get('status') !== 'published')
                                        ->displayFormat(function () {
                                            return 'd/m/Y';
                                        })->columnSpanFull(),

                                    DatePicker::make('scheduled_for')->hidden(fn (Get $get) => $get('status') !== 'scheduled')
                                        ->displayFormat(function () {
                                            return 'd/m/Y';
                                        }),
                                ])->columnSpan(2),
                            ]),



                    ])->columns(3),

                    Tab::make('Conteúdo descritivo')
                        ->icon('heroicon-m-inbox')
                        ->schema([
                            TextInput::make('subTitle')->label('Sub Titulo')
                                ->maxLength(255)
                                ->required(),

                            Textarea::make('summary')->label('Resumo')
                                ->maxLength(255)
                                ->required(),

                            RichEditor::make('content')
                                ->toolbarButtons([
                                    'attachFiles',
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h1',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ])
                                ->maxLength(65535)
                                ->columnSpanFull(),
                        ])
                ])->columnSpanFull()->activeTab(1)->persistTabInQueryString(),

                ])->columns([
                    'default' => 2,
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2
                ]);
    }

    /**
     *
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image_url')
                    ->square()
                    ->defaultImageUrl(url('storage/app/public/image_posts'))
                    ->size(60)
                    ->label(''),

                TextColumn::make('title')
                    ->label('Titulo')
                    ->limit(20)
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Categoria'),

                TextColumn::make('author.name')
                    ->label('Autor'),

                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),


            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusArticleEnum::class),

                SelectFilter::make('category_id')
                    ->label('Categorias')
                    ->relationship('category', 'name')
                    ->preload()
                    ->multiple(),

                SelectFilter::make('tags')
                    ->label('tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                    ViewAction::make(),
                ])->tooltip("Menu")
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Creating a resource with a View page
     * links developer:
     * https://filamentphp.com/docs/3.x/panels/resources/viewing-records
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                SectionInfo::make([
                    TextEntry::make('title')
                        ->size('lg')
                        ->weight('bold')
                        ->hiddenLabel(),

                    ImageEntry::make('featured_image_url')
                        ->view('filament/article/article-image'),

                    TextEntry::make('content')
                        ->hiddenLabel()->alignJustify()
                        ->view('filament/article/article-content')
                        ->html(),

                ])->columnSpan(2),

                SectionInfo::make([

                    \Filament\Infolists\Components\Group::make([
                        TextEntry::make('created_at')
                            ->date(),
                        TextEntry::make('updated_at')
                            ->date(),

                        TextEntry::make('author.name')
                            ->color('primary'),

                        IconEntry::make('published_at')
                            ->boolean(),
                    ])->columns(2),

                    TextEntry::make('category.name')
                        ->badge()
                        ->separator(','),

                    TextEntry::make('tags.name')
                        ->badge()
                        ->color('gray')
                        ->separator(','),

                ])->columnSpan(1),

            ])->columns(3);
    }

    /**
     *
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ArticleStatsOverview::class
        ];
    }

    /**
     *
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

}

