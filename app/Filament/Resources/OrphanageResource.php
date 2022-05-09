<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrphanageResource\Pages;
use App\Filament\Resources\OrphanageResource\RelationManagers;
use App\Models\Orphanage;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

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

                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        TextInput::make('location')
                            ->label('Lokasi')
                            ->required(),
                        Grid::make()
                            ->schema([
                                TextInput::make('latitude')
                                    ->required(),
                                TextInput::make('longtitude')
                                    ->required(),
                                TimePicker::make('opening_hours')
                                    ->label('Jam buka')
                                    ->format('H:i')
                                    ->withoutSeconds()
                                    ->required(),
                                TimePicker::make('closed_hours')
                                    ->label('Jam tutup')
                                    ->format('H:i')
                                    ->withoutSeconds()
                                    ->required(),
                            ]),

                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Card::make()
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Dibuat')
                            ->content(fn (?Orphanage $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Placeholder::make('updated_at')
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
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('location')
                    ->sortable()
                    ->searchable()
                    ->label('Lokasi'),
                TextColumn::make('latitude'),
                TextColumn::make('longtitude'),
                TextColumn::make('longtitude'),
                TextColumn::make('opening_hours')
                    ->label('Jam buka')
                    ->sortable()
                    ->time('H:m'),
                TextColumn::make('closed_hours')
                    ->label('Jam tutup')
                    ->sortable()
                    ->time('H:m'),
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
