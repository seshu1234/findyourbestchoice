<?php

namespace App\Filament\Resources\Comparisons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ComparisonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tool_a_id')
                    ->relationship('toolA', 'name')
                    ->required(),
                Select::make('tool_b_id')
                    ->relationship('toolB', 'name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('comparison_data'),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('meta'),
                TextInput::make('created_by')
                    ->numeric(),
            ]);
    }
}
