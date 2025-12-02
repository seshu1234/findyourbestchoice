<?php

namespace App\Filament\Resources\SeoPages;

use App\Filament\Resources\SeoPages\Pages\CreateSeoPage;
use App\Filament\Resources\SeoPages\Pages\EditSeoPage;
use App\Filament\Resources\SeoPages\Pages\ListSeoPages;
use App\Filament\Resources\SeoPages\Pages\ViewSeoPage;
use App\Filament\Resources\SeoPages\Schemas\SeoPageForm;
use App\Filament\Resources\SeoPages\Schemas\SeoPageInfolist;
use App\Filament\Resources\SeoPages\Tables\SeoPagesTable;
use App\Models\SeoPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoPageResource extends Resource
{
    protected static ?string $model = SeoPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'SeoPage';

    public static function form(Schema $schema): Schema
    {
        return SeoPageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SeoPageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoPagesTable::configure($table);
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
            'index' => ListSeoPages::route('/'),
            'create' => CreateSeoPage::route('/create'),
            'view' => ViewSeoPage::route('/{record}'),
            'edit' => EditSeoPage::route('/{record}/edit'),
        ];
    }
}
