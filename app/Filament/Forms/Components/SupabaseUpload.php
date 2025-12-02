<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class SupabaseUpload extends Field
{
    protected string $view = 'filament.forms.components.supabase-upload';

    protected bool $multiple = true;
    protected string $bucket = 'tools';

    public function multiple(bool $condition = true): static
    {
        $this->multiple = $condition;
        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    public function bucket(string $bucket): static
    {
        $this->bucket = $bucket;
        return $this;
    }

    public function getBucket(): string
    {
        return $this->bucket;
    }
}
