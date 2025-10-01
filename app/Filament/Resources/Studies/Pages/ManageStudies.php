<?php

namespace App\Filament\Resources\Studies\Pages;

use App\Filament\Resources\Studies\StudyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageStudies extends ManageRecords
{
    protected static string $resource = StudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
