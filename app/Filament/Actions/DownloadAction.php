<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (Model $record): StreamedResponse {
            $filePath = $record->file_path;

            if (!Storage::exists($filePath)) {
                abort(404, 'File not found.');
            }

            return Storage::download($filePath);
        });
    }
}
