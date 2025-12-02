<?php

namespace App\Filament\Resources\SponsoredListings\Pages;

use App\Filament\Resources\SponsoredListings\SponsoredListingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSponsoredListing extends EditRecord
{
    protected static string $resource = SponsoredListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
