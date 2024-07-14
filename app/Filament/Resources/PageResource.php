<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Helpers\PageLayout;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->columns(3)
                ->schema([
                    Section::make()
                        ->columnSpan(2)
                        ->schema([
                            // Forms\Components\TextInput::make('sections'),
    Builder::make('content')
        ->blocks([
            Block::make('heading')
                ->schema([
                    Forms\Components\TextInput::make('content')
                        ->label('Heading')
                        ->required(),
                    Forms\Components\Select::make('level')
                        ->options([
                            'h1' => 'Heading 1',
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                            'h5' => 'Heading 5',
                            'h6' => 'Heading 6',
                        ])
                        ->required(),
                ])
                ->columns(2),
            Block::make('paragraph')
                ->schema([
                    Forms\Components\Textarea::make('content')
                        ->label('Paragraph')
                        ->required(),
                        // ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ]),
            Block::make('image-paragraph')
                ->schema([
                    Forms\Components\FileUpload::make('url')
                        ->label('Image')
                        ->image()
                        ->required(),
                    Forms\Components\TextInput::make('alt')
                        ->label('Alt text')
                        ->required(),
                    Forms\Components\Textarea::make('content')
                        ->label('Paragraph')
                        ->required(),
                        // ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ]),
            Block::make('image')
                ->schema([
                    Forms\Components\FileUpload::make('url')
                        ->label('Image')
                        ->image()
                        ->required(),
                    Forms\Components\TextInput::make('alt')
                        ->label('Alt text')
                        ->required(),
                ]),
            Block::make('paragraph')
                ->schema([
                    Forms\Components\Textarea::make('content')
                        ->label('Paragraph')
                        ->required(),
                        // ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ]),
                ])
            ])->columnSpan(2),
                    Section::make()
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('meta_image')
                                ->image(),
                            Forms\Components\TextInput::make('meta_title')
                                ->maxLength(255),
                            Forms\Components\Textarea::make('meta_keywords'),
                            Forms\Components\Textarea::make('meta_description')
                                ->maxLength(255),
                        ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layout')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('meta_image'),
                Tables\Columns\TextColumn::make('meta_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
