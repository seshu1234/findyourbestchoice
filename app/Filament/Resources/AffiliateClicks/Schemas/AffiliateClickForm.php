<?php

namespace App\Filament\Resources\AffiliateClicks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AffiliateClickForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tool_id')
                    ->relationship('tool', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('ip'),
                TextInput::make('user_agent'),
                TextInput::make('referrer'),
                TextInput::make('meta'),
            ]);
    }
}
