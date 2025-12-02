<?php

namespace App\Filament\Resources\SeoPages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SeoPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Textarea::make('body')
                    ->columnSpanFull(),
                TextInput::make('tools'),
                TextInput::make('meta'),
                TextInput::make('created_by')
                    ->numeric(),
            ]);
    }
}
