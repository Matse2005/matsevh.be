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
        if (!$application->document) {
            throw new \Exception('No cover letter uploaded.');
        }

        $mailer = Mail::build([
            'transport' => 'smtp',
            'host' => env('PERSONAL_MAIL_HOST'),
            'port' => env('PERSONAL_MAIL_PORT'),
            'encryption' => env('PERSONAL_MAIL_ENCRYPTION'),
            'username' => env('PERSONAL_MAIL_USERNAME'),
            'password' => env('PERSONAL_MAIL_PASSWORD'),
        ]);
        $mailer->to($application->company_email)
            ->send(new Sollicitation($application))
        ;

        // Update application status
        $application->update([
            'status' => 'applied',
            'sent_at' => now(),
        ]);
    }
}
