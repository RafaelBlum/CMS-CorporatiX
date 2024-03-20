<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),

                TextInput::make('number')
                    ->label('Numero'),

                TextInput::make('bairro')
                    ->label('Bairro'),

                TextInput::make('city')
                    ->label('Cidade'),

                TextInput::make('state')
                    ->label('Estado'),

                TextInput::make('cep')
                    ->label('CEP'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->recordTitleAttribute('street')
        ->columns([
            Tables\Columns\TextColumn::make('street'),
            Tables\Columns\TextColumn::make('number'),
            Tables\Columns\TextColumn::make('bairro'),
            Tables\Columns\TextColumn::make('city'),
            Tables\Columns\TextColumn::make('state'),
            Tables\Columns\TextColumn::make('cep'),
        ])

        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }
}
