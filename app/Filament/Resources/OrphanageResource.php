<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrphanageResource\Pages;
use App\Filament\Resources\OrphanageResource\RelationManagers;
use App\Models\Orphanage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrphanageResource extends Resource
{
    protected static ?string $model = Orphanage::class;
    protected static ?string $label = 'Panti Asuhan';
    protected static ?string $pluralLabel = 'Panti Asuhan';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Nama')->required(),
                        Forms\Components\TextInput::make('location')->label('Lokasi')->required(),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('latitude')->required(),
                                Forms\Components\TextInput::make('longtitude')->required(),
                                Forms\Components\TimePicker::make('opening_hours')->label('Jam buka')->format('H:i')->withoutSeconds()->required(),
                                Forms\Components\TimePicker::make('closed_hours')->label('Jam tutup')->format('H:i')->withoutSeconds()->required(),
                            ]),

                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Dibuat')
                            ->content(fn (?Orphanage $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Terakhir diubah')
                            ->content(fn (?Orphanage $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Nama'),
                Tables\Columns\TextColumn::make('location')->sortable()->searchable()->label('Lokasi'),
                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longtitude'),
                Tables\Columns\TextColumn::make('longtitude'),
                Tables\Columns\TextColumn::make('opening_hours')->label('Jam buka')->sortable()->time('H:m'),
                Tables\Columns\TextColumn::make('closed_hours')->label('Jam tutup')->sortable()->time('H:m'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ChildrenRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrphanages::route('/'),
            'create' => Pages\CreateOrphanage::route('/create'),
            'edit' => Pages\EditOrphanage::route('/{record}/edit'),
        ];
    }
}
