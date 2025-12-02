<?php

namespace App\Filament\Resources\Tools\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Str;
use App\Filament\Forms\Components\SupabaseUpload;

class ToolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Info')
                ->description('Basic details about the tool')
                ->schema([
                    TextInput::make('name')
                        ->label('Tool Name')
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state)))
                        ->columnSpan(2),

                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Auto-generated from the name')
                        ->columnSpan(1),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('Choose a category')
                        ->columnSpan(1),
                ])->columns(2),

            Section::make('Media')
                ->description('Upload a logo and images for the tool')
                ->schema([
                    SupabaseUpload::make('logo_file')
                        ->bucket('tools')
                        ->label('Upload Logo (Supabase)')
                        ->columnSpan(1),

                    TextInput::make('logo_url')
                        ->label('Logo URL (optional)')
                        ->url()
                        ->columnSpan(1),

                    SupabaseUpload::make('image_files')
                        ->bucket('tools')
                        ->label('Upload Tool Images (multiple)')
                        ->columnSpanFull(),

                    TextInput::make('images')
                        ->label('Images URLs (Comma Separated)')
                        ->helperText('Used only if you want to manually paste URLs')
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Description')
                ->description('Short and full descriptions shown on the tool page')
                ->schema([
                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(3)
                        ->columnSpanFull(),

                    RichEditor::make('description')
                        ->label('Full Description')
                        ->columnSpanFull(),
                ]),

            Section::make('Links & Pricing')
                ->description('External links and starting price')
                ->schema([
                    TextInput::make('price_from')
                        ->numeric()
                        ->label('Starting Price'),

                    TextInput::make('affiliate_url')
                        ->label('Affiliate URL')
                        ->url(),

                    TextInput::make('official_url')
                        ->label('Official Website')
                        ->url(),
                ])->columns(3),

            Section::make('Pros & Cons')
                ->description('List advantages and disadvantages')
                ->schema([
                    Repeater::make('pros')
                        ->schema([
                            TextInput::make('item')->label('Pro'),
                        ])
                        ->collapsible()
                        ->columnSpan(1),

                    Repeater::make('cons')
                        ->schema([
                            TextInput::make('item')->label('Con'),
                        ])
                        ->collapsible()
                        ->columnSpan(1),
                ])->columns(2),

            Section::make('Meta')
                ->schema([
                    KeyValue::make('meta')->label('Meta Data')->columnSpanFull(),
                ]),

            Section::make('System')
                ->description('Internal system fields')
                ->collapsed()
                ->schema([
                    TextInput::make('upvotes')
                        ->numeric()
                        ->default(0)
                        ->label('Upvotes'),

                    TextInput::make('created_by')
                        ->numeric(),
                ])->columns(2),
        ]);
    }
}
