<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;
    protected static ?string $label = 'Janji Temu';
    protected static ?string $pluralLabel = 'Janji Temu';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('time')->label('Waktu')->withoutSeconds()->required(),
                Forms\Components\BelongsToSelect::make('child_id')->label('Anak')->relationship('child', 'name')
                    ->hidden(fn (Component $livewire): bool => $livewire instanceof Pages\EditAppointment)->required()->searchable(),
                Forms\Components\Radio::make('status')->options(['SUCCEED' => 'Sukses', 'FAILED' => 'Gagal', 'INPROGRESS' => 'Dalam proses'])->required()
                    ->disabled(fn (?Model $record): bool => $record['status'] == 'SUCCEED')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('child.name')->label('Nama anak')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'INPROGRESS' => 'Dalam proses',
                    'SUCCEED' => 'Sukses',
                    'FAILED' => 'Gagal',
                ])->colors([
                    'danger' => 'FAIELD',
                    'warning' => 'INPROGRESS',
                    'success' => 'SUCCEED',
                ]),
                Tables\Columns\TextColumn::make('time')->label('Waktu bertemu')->dateTime()->sortable()->searchable()
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
