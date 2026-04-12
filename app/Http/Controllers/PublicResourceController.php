<?php

namespace App\Http\Controllers;


use App\Models\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // За изтегляне

class PublicResourceController extends Controller
{
    // Показва списък с ресурси
    public function index()
    {
        // Извличане само на публикувани ресурси, подредени по дата
        $resources = Resource::where('is_published', true)
                             ->orderBy('created_at', 'desc')
                             ->paginate(15); // Примерна пагинация

        return view('resources.index', compact('resources'));
    }
 
    public function download(Resource $resource)
    {
        // 1. Проверка дали ресурсът е публикуван (допълнителна сигурност)
        if (!$resource->is_published) {
            abort(404, 'Ресурсът не е публикуван.');
        }

        // 2. Вземане на пътя от базата данни
        $path = $resource->file_path; // Пътят, записан при качването (напр. 'resources/filename.pdf')

        // 3. Проверка дали пътят не е празен
        if (empty($path)) {
            Log::error("Грешка при изтегляне: Пътят до файла е празен за ресурс ID: {$resource->id}");
            abort(404, 'Информацията за файла липсва.');
        }

        // 4. Използване на 'public' диска изрично
        $disk = Storage::disk('public');

        // 5. Проверка дали файлът съществува ФИЗИЧЕСКИ на диска
        if (!$disk->exists($path)) {
            // Логване на грешката за по-лесно дебъгване
            Log::error("Грешка при изтегляне: Файлът не е намерен на очаквания път.", [
                'resource_id' => $resource->id,
                'expected_relative_path' => $path, // Пътят, който търсим (от DB)
                'disk_root' => config('filesystems.disks.public.root'), // Къде търси Storage
                'full_resolved_path_attempt' => $disk->path($path) // Пълният път на сървъра
            ]);
            abort(404, 'Файлът не беше намерен на сървъра.');
        }

        // 6. Определяне на името на файла за изтегляне
        // Използваме оригиналното име, ако е записано, иначе взимаме името от пътя
        $downloadName = $resource->original_filename ?? basename($path);

        // 7. Опит за изтегляне
        try {
            // Връщаме отговор за изтегляне
            return $disk->download($path, $downloadName);

        } catch (\Exception $e) {
            // Логване на всякакви други грешки по време на процеса
            Log::error("Изключение при опит за изтегляне на файл.", [
                'resource_id' => $resource->id,
                'path' => $path,
                'download_name' => $downloadName,
                'error_message' => $e->getMessage()
            ]);
            abort(500, 'Възникна неочаквана грешка при изтеглянето на файла.');
        }
    }
}