<?php

namespace App\Filament\Resources\Tools\Pages;

use App\Filament\Resources\Tools\ToolResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTool extends CreateRecord
{
    protected static string $resource = ToolResource::class;

    /**
     * Convert uploader JSON string -> array of URLs, convert tags comma string -> array (or leave as-is)
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // images field: field stored as JSON-string from the custom field
        if (isset($data['images'])) {
            if (is_string($data['images'])) {
                $decoded = json_decode($data['images'], true);
                if (is_array($decoded)) {
                    $data['images'] = $decoded;
                }
            }
        }

        // tags: if submitted as comma-separated string, convert to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        }

        return $data;
    }
}
