<?php

namespace App\Filament\Resources\Applications\Tables;

use App\Mail\Sollicitation;
use App\Models\Application;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('company_role')
                    ->searchable(),
                TextColumn::make('company_application_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('template.title')
                    ->label('Template')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('document.name')
                    ->label('Document')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('sent_at')
                    ->dateTime()
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
                Action::make('send')
                    ->label('Send Application')
                    ->action(function (Application $record) {
                        self::sendApplication($record);
                    })
                    ->requiresConfirmation()
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function sendApplication(Application $application)
    {
        Mail::mailer('personal')->to($application->company_email)
            ->send(new Sollicitation($application));

        $application->update([
            'status' => 'applied',
            'sent_at' => now(),
        ]);
    }
}
