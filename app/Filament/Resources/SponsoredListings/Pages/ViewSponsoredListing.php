<?php

namespace App\Filament\Resources\SponsoredListings\Pages;

use App\Filament\Resources\SponsoredListings\SponsoredListingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSponsoredListing extends ViewRecord
{
    protected static string $resource = SponsoredListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
