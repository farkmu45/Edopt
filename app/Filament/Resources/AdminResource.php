<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;
    protected static ?string $label = 'Admin';
    protected static ?string $pluralLabel = 'Admin';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administrasi';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->required(),
                    TextInput::make('password')
                        ->label('Kata Sandi')
                        ->password()
                        ->required(),
                    BelongsToSelect::make('orphanage')
                        ->label('Panti Asuhan')
                        ->relationship('orphanage', 'name')
                        ->required()
                        ->searchable()
                        ->nullable(),
                ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('orphanage.name')
                    ->label('Panti asuhan')
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make('is_master')
                    ->sortable()
                    ->label('Akun master'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir diubah')
                    ->date()
                    ->sortable(),
            ])
            ->filters([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
