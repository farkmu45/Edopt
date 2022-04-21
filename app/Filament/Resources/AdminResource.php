<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Closure;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

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
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')->label('Nama')->required(),
                    Forms\Components\TextInput::make('email')->email()->required(),
                    Forms\Components\TextInput::make('password')->label('Kata Sandi')->password()->required(),
                    Forms\Components\BelongsToSelect::make('orphanage')->label('Panti Asuhan')->disabled(fn (Closure $get) => $get('is_admin') == true)->relationship('orphanage', 'name')->required()->reactive()->searchable()->nullable(),
                    Forms\Components\Toggle::make('is_master')->label('Akun Master')
                        ->disabled(fn (Closure $get) => $get('orphanage') !== null)->reactive(),
                ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('orphanage.name')->label('Panti asuhan')->sortable()->searchable(),
                Tables\Columns\BooleanColumn::make('is_master')->sortable()->label('Akun master'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->date()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir diubah')->date()->sortable(),
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
