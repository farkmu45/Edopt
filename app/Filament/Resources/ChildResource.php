<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Filament\Resources\OrphanageResource\RelationManagers\ChildrenRelationManager;
use App\Models\Child;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;

class ChildResource extends Resource
{
    protected static ?string $model = Child::class;
    protected static ?string $label = 'Biodata anak';
    protected static ?string $pluralLabel = 'Anak';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-emoji-happy';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make(
                    [
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Nama'),
                                TextInput::make('age')
                                    ->label('Umur')
                                    ->numeric()
                                    ->required(),
                                Select::make('gender')
                                    ->label('Jenis kelamin')
                                    ->options(['MALE' => 'Laki-laki', 'FEMALE' => 'Perempuan'])
                                    ->required(),
                                BelongsToSelect::make('orphanage_id')
                                    ->label('Panti asuhan')
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
                        RichEditor::make('additional_info')
                            ->label('Informasi tambahan')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                            ]),
                    ]
                )->columnSpan(2),
                Card::make([
                    Placeholder::make('created_at')
                        ->label('Dibuat')
                        ->content(fn (?Child $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                    Placeholder::make('updated_at')
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
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis kelamin')
                    ->enum(
                        [
                            'MALE' => 'Laki-laki',
                            'FEMALE' => 'Perempuan'
                        ]
                    )->sortable()
                    ->searchable(),
                TextColumn::make('age')
                    ->label('Umur')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('orphanage.name')
                    ->label('Panti asuhan')
                    ->sortable()
                    ->searchable()
                    ->hidden(function () {
                        if (auth()->user()->isMaster) {
                            return false;
                        }
                        return true;
                    }),
                BooleanColumn::make('is_adopted')
                    ->sortable()
                    ->label('Teradopsi'),
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
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
}
