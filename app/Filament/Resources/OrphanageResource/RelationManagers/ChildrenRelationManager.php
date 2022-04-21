<?php

namespace App\Filament\Resources\OrphanageResource\RelationManagers;

use App\Filament\Resources\ChildResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ChildrenRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'children';

    protected static ?string $title = 'Anak';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return ChildResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ChildResource::table($table);
    }
}
