<?php

namespace App\Filament\Resources\Tools\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ToolInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('short_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('category.name')
                    ->label('Category')
                    ->placeholder('-'),
                TextEntry::make('logo_url')
                    ->placeholder('-'),
                TextEntry::make('price_from')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('affiliate_url')
                    ->placeholder('-'),
                TextEntry::make('official_url')
                    ->placeholder('-'),
                TextEntry::make('upvotes')
                    ->numeric(),
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
