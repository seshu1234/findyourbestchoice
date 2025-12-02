<?php

namespace App\Filament\Resources\AffiliateClicks\Pages;

use App\Filament\Resources\AffiliateClicks\AffiliateClickResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAffiliateClicks extends ListRecords
{
    protected static string $resource = AffiliateClickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
