<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;
    protected static ?string $label = 'Kunjungan';
    protected static ?string $pluralLabel = 'Kunjungan';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Umum';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    DateTimePicker::make('time')
                        ->label('Waktu')
                        ->disabled()
                        ->withoutSeconds()
                        ->required(),
                    BelongsToSelect::make('child_id')
                        ->label('Anak')
                        ->relationship('child', 'name')
                        ->hidden(fn (Component $livewire): bool => $livewire instanceof Pages\EditAppointment)
                        ->required()
                        ->searchable(),
                    Radio::make('status')
                        ->options(['SUCCESS' => 'Sukses', 'FAILED' => 'Gagal', 'INPROGRESS' => 'Dalam proses'])
                        ->required()
                        ->disabled(fn (?Model $record): bool => $record['status'] == 'SUCCESS')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('child.name')
                    ->label('Nama anak')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('child.orphanage.name')
                    ->limit()
                    ->label('Panti asuhan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Pengadopsi')
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('status')
                    ->enum([
                        'INPROGRESS' => 'Dalam proses',
                        'SUCCESS' => 'Sukses',
                        'FAILED' => 'Gagal',
                    ])
                    ->colors([
                        'danger' => 'FAIELD',
                        'warning' => 'INPROGRESS',
                        'success' => 'SUCCESS',
                    ]),
                TextColumn::make('time')
                    ->label('Waktu kunjungan')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListAppointments::route('/'),
            // 'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
