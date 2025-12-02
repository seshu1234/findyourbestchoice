<?php

namespace App\Filament\Resources\Tools;

use App\Filament\Resources\Tools\Pages\CreateTool;
use App\Filament\Resources\Tools\Pages\EditTool;
use App\Filament\Resources\Tools\Pages\ListTools;
use App\Filament\Resources\Tools\Schemas\ToolForm;
use App\Filament\Resources\Tools\Tables\ToolsTable;
use App\Models\Tool;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class ToolResource extends Resource
{
    protected static ?string $model = Tool::class;

    protected static UnitEnum|string|null $navigationGroup = 'Tools';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;


    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return ToolForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ToolsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTools::route('/'),
            'create' => CreateTool::route('/create'),
            'edit' => EditTool::route('/{record}/edit'),
        ];
    }
}
