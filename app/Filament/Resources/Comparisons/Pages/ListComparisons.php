<?php

namespace App\Filament\Resources\Comparisons\Pages;

use App\Filament\Resources\Comparisons\ComparisonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComparisons extends ListRecords
{
    protected static string $resource = ComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
