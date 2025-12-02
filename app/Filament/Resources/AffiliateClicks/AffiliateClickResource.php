<?php

namespace App\Filament\Resources\AffiliateClicks;

use App\Filament\Resources\AffiliateClicks\Pages\CreateAffiliateClick;
use App\Filament\Resources\AffiliateClicks\Pages\EditAffiliateClick;
use App\Filament\Resources\AffiliateClicks\Pages\ListAffiliateClicks;
use App\Filament\Resources\AffiliateClicks\Schemas\AffiliateClickForm;
use App\Filament\Resources\AffiliateClicks\Tables\AffiliateClicksTable;
use App\Models\AffiliateClick;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliateClickResource extends Resource
{
    protected static ?string $model = AffiliateClick::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'AffiliateClick';

    public static function form(Schema $schema): Schema
    {
        return AffiliateClickForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AffiliateClicksTable::configure($table);
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
            'index' => ListAffiliateClicks::route('/'),
            'create' => CreateAffiliateClick::route('/create'),
            'edit' => EditAffiliateClick::route('/{record}/edit'),
        ];
    }
}
