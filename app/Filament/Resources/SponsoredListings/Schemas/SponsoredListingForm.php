<?php

namespace App\Filament\Resources\SponsoredListings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SponsoredListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tool_id')
                    ->relationship('tool', 'name')
                    ->required(),
                TextInput::make('created_by')
                    ->numeric(),
                TextInput::make('amount')
                    ->numeric(),
                DateTimePicker::make('starts_at'),
                DateTimePicker::make('ends_at'),
                TextInput::make('placement')
                    ->required()
                    ->default('homepage'),
                TextInput::make('slot_name'),
                TextInput::make('priority')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('active')
                    ->required(),
                TextInput::make('meta'),
            ]);
    }
}
