<?php

namespace App\Filament\Resources\Comparisons\Pages;

use App\Filament\Resources\Comparisons\ComparisonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewComparison extends ViewRecord
{
    protected static string $resource = ComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
