<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use RyanChandler\FilamentProfile\Pages\Profile as BaseProfile;

class Profile extends BaseProfile
{

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament-profile::filament.pages.profile';
    protected static ?string $title = 'Profil';
    protected static ?string $slug = 'profile';
    protected static ?string $navigationGroup = 'Akun';
    protected static ?int $navigationSort = 9;


    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Profil',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Umum')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->helperText('Pastikan domain email adalah edopt.com')
                        ->rule('ends_with:@edopt.com')
                        ->unique(ignoreRecord: true)
                        ->label('Alamat email')
                        ->required(),
                ]),
            Section::make('Ubah Kata Sandi')
                ->columns(2)
                ->schema([
                    TextInput::make('password')
                        ->label('Password Sekarang')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('Password Baru')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new_password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Verifikasi Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new_password'),
                        ]),
                ]),
        ];
    }
}
