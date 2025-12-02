<?php

namespace App\Filament\Resources\SponsoredListings\Pages;

use App\Filament\Resources\SponsoredListings\SponsoredListingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSponsoredListings extends ListRecords
{
    protected static string $resource = SponsoredListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
