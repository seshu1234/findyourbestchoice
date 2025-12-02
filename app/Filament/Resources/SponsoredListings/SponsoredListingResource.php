<?php

namespace App\Filament\Resources\SponsoredListings;

use App\Filament\Resources\SponsoredListings\Pages\CreateSponsoredListing;
use App\Filament\Resources\SponsoredListings\Pages\EditSponsoredListing;
use App\Filament\Resources\SponsoredListings\Pages\ListSponsoredListings;
use App\Filament\Resources\SponsoredListings\Pages\ViewSponsoredListing;
use App\Filament\Resources\SponsoredListings\Schemas\SponsoredListingForm;
use App\Filament\Resources\SponsoredListings\Schemas\SponsoredListingInfolist;
use App\Filament\Resources\SponsoredListings\Tables\SponsoredListingsTable;
use App\Models\SponsoredListing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SponsoredListingResource extends Resource
{
    protected static ?string $model = SponsoredListing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'SponsoredListing';

    public static function form(Schema $schema): Schema
    {
        return SponsoredListingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SponsoredListingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SponsoredListingsTable::configure($table);
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
            'index' => ListSponsoredListings::route('/'),
            'create' => CreateSponsoredListing::route('/create'),
            'view' => ViewSponsoredListing::route('/{record}'),
            'edit' => EditSponsoredListing::route('/{record}/edit'),
        ];
    }
}
