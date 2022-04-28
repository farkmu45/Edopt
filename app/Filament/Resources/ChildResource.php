<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Filament\Resources\OrphanageResource\RelationManagers\ChildrenRelationManager;
use App\Models\Child;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\Component;

class ChildResource extends Resource
{
    protected static ?string $model = Child::class;
    protected static ?string $label = 'Anak';
    protected static ?string $pluralLabel = 'Anak';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-emoji-happy';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make(
                    [
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('name')->required()->label('Nama'),
                            Forms\Components\TextInput::make('age')->label('Umur')->numeric()->required(),
                            Forms\Components\Select::make('gender')->label('Jenis Kelamin')->options(['MALE' => 'Laki-laki', 'FEMALE' => 'Perempuan'])->required(),
                            Forms\Components\BelongsToSelect::make('orphanage_id')->label('Panti Asuhan')
                                ->relationship('orphanage', 'name')
                                ->required()
                                ->default(function (Component $livewire) {
                                    if ($livewire instanceof ChildrenRelationManager) {
                                        return $livewire->ownerRecord->id;
                                    } else if (auth()->user()->orphanage_id) {
                                        return auth()->user()->orphanage_id;
                                    } else {
                                        return null;
                                    }
                                })
                                ->disabled(fn (Component $livewire): bool => $livewire instanceof ChildrenRelationManager ?: auth()->user()->orphanage_id ?: false)
                                ->searchable()
                                ->hidden(function () {
                                    if (auth()->user()->is_master) {
                                        return false;
                                    } else if (auth()->user()->orphanage_id) {
                                        return true;
                                    }
                                })
                        ]),

                        Forms\Components\Textarea::make('additional_info')->label('Informasi Tambahan'),
                    ]
                )->columnSpan(2),
                Forms\Components\Card::make([
                    Forms\Components\Placeholder::make('created_at')
                        ->label('Dibuat')
                        ->content(fn (?Child $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                    Forms\Components\Placeholder::make('updated_at')
                        ->label('Terakhir diubah')
                        ->content(fn (?Child $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                ])->columnSpan(1),
            ])->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('gender')->label('Jenis Kelamin')->enum(
                    [
                        'MALE' => 'Laki-laki',
                        'FEMALE' => 'Perempuan'
                    ]
                )->sortable()->searchable(),
                Tables\Columns\TextColumn::make('age')->label('Umur')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('orphanage.name')->label('Panti Asuhan')->sortable()->searchable()
                    ->hidden(function () {
                        if (auth()->user()->isMaster) {
                            return false;
                        }
                        return true;
                    }),
                Tables\Columns\BooleanColumn::make('is_adopted')->sortable()->label('Teradopsi'),
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
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
}
