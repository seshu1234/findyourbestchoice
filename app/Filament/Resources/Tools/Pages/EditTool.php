<?php

namespace App\Filament\Resources\Tools\Pages;

use App\Filament\Resources\Tools\ToolResource;
use Filament\Resources\Pages\EditRecord;

class EditTool extends EditRecord
{
    protected static string $resource = ToolResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['images'])) {
            if (is_string($data['images'])) {
                $decoded = json_decode($data['images'], true);
                if (is_array($decoded)) {
                    $data['images'] = $decoded;
                }
            }
        }

        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        }

        return $data;
    }
}
