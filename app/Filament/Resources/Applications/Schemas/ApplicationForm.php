<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company')
                    ->schema([
                        TextInput::make('company_name')
                            ->required(),
                        TextInput::make('company_contact'),
                        TextInput::make('company_email')
                            ->email()
                            ->required(),
                        TextInput::make('company_role')
                            ->required(),
                        TextInput::make('company_application_name'),
                        TextInput::make('company_application_url')
                            ->url(),
                    ]),
                Section::make('Application')
                    ->schema([
                        Select::make('template_id')
                            ->label('Template')
                            ->relationship('template', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('document_id')
                            ->label('Document')
                            ->relationship('document', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->options([
                                "not_applied" => 'Not applied',
                                "applied" => 'Applied',
                                "interview" => 'Interview',
                                "rejected" => 'Rejected',
                                "accepted" => 'Accepted',
                            ])
                            ->required(),
                        FileUpload::make('letter')
                            ->acceptedFileTypes(['application/pdf'])
                            ->disk('private')
                            ->directory('sollicitation/letters')
                            ->required(),
                    ])
            ]);
    }
}
