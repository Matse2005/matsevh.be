<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\ManageProjects;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    protected static string|\UnitEnum|null $navigationGroup = 'Website';

    protected static ?string $recordTitleAttribute = 'Attribute';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),
                RichEditor::make('description')
                    ->columnSpanFull(),
                TagsInput::make('technologies')
                    ->columnSpanFull(),
                TextInput::make('github_url')
                    ->url(),
                TextInput::make('demo_url')
                    ->url(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('site/projects'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Project')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('technologies')
                    ->badge()
                    ->searchable(),
                TextColumn::make('github_url')
                    ->searchable(),
                TextColumn::make('demo_url')
                    ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProjects::route('/'),
        ];
    }
}
