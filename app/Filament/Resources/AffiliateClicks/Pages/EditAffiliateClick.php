<?php

namespace App\Filament\Resources\AffiliateClicks\Pages;

use App\Filament\Resources\AffiliateClicks\AffiliateClickResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAffiliateClick extends EditRecord
{
    protected static string $resource = AffiliateClickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
