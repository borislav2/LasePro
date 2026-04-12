<?php

namespace App\Filament\Teacher\Resources\EventResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by_user_id'] = Auth::id();
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
