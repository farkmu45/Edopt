<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrphanageResource\Pages;
use App\Filament\Resources\OrphanageResource\RelationManagers;
use App\Models\Orphanage;
use Closure;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrphanageResource extends Resource
{
    protected static ?string $model = Orphanage::class;
    protected static ?string $label = 'Panti asuhan';
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
                        FileUpload::make('image_url')
                            ->label('Gambar')
                            ->directory('orphanageImages')
                            ->required()
                            ->imageCropAspectRatio('16:9')
                            ->image()
                            ->maxSize(2000),
                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                        Grid::make()
                            ->schema([
                                BelongsToSelect::make('province_id')
                                    ->relationship('province', 'name')
                                    ->label('Provinsi')
                                    ->required()
                                    ->afterStateUpdated(function (Closure $get, $set) {
                                        if ($get('province_id') == null) {
                                            $set('regency_id', null);
                                        }
                                    })
                                    ->getOptionLabelFromRecordUsing(fn (Model $record) => ucwords(strtolower($record->name)))
                                    ->reactive()
                                    ->required(),
                                BelongsToSelect::make('regency_id')
                                    ->relationship(
                                        'regency',
                                        'name',
                                        fn (Builder $query, Closure $get) =>
                                        $query->where('province_id', '=', $get('province_id'))
                                    )
                                    ->label('Kabupaten')
                                    ->getOptionLabelFromRecordUsing(fn (Model $record) => ucwords(strtolower($record->name)))
                                    ->disabled(fn (Closure $get) => $get('province_id') == null)
                                    ->reactive()
                                    ->required(),
                                BelongsToSelect::make('district_id')
                                    ->relationship(
                                        'district',
                                        'name',
                                        fn (Builder $query, Closure $get) =>
                                        $query->where('regency_id', '=', $get('regency_id'))
                                    )
                                    ->label('Kecamatan')
                                    ->disabled(fn (Closure $get) => $get('regency_id') == null)
                                    ->getOptionLabelFromRecordUsing(fn (Model $record) => ucwords(strtolower($record->name)))
                                    ->reactive()
                                    ->required()
                                    ->columnSpan(2)
                            ]),
                        TextInput::make('address')
                            ->label('Alamat')
                            ->required(),
                        Grid::make()
                            ->schema([
                                TextInput::make('latitude')
                                    ->required(),
                                TextInput::make('longitude')
                                    ->required(),
                                TimePicker::make('opening_hours')
                                    ->label('Jam buka')
                                    ->format('H:i')
                                    ->withoutSeconds()
                                    ->required(),
                                TimePicker::make('closing_hours')
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
                TextColumn::make('province.name')
                    ->label('Provinsi')
                    ->formatStateUsing(fn (string $state): string => ucwords(strtolower($state)))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('regency.name')
                    ->label('Kabupaten')
                    ->formatStateUsing(fn (string $state): string => ucwords(strtolower($state)))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('district.name')
                    ->label('Kecamatan')
                    ->formatStateUsing(fn (string $state): string => ucwords(strtolower($state)))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('address')
                    ->sortable()
                    ->searchable()
                    ->label('Alamat'),
                TextColumn::make('opening_hours')
                    ->label('Jam buka')
                    ->sortable()
                    ->time('H:m'),
                TextColumn::make('closing_hours')
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
