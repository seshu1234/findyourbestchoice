<?php

namespace App\Filament\Resources\Comparisons\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ComparisonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('toolA.name')
                    ->label('Tool a'),
                TextEntry::make('toolB.name')
                    ->label('Tool b'),
                TextEntry::make('slug'),
                TextEntry::make('content')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
