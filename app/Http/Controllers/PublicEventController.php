<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    public function index()
    {
        // Извличане само на публикувани и предстоящи/текущи събития
        $now = Carbon::now();
        $events = Event::where('is_published', true)
                       // Показваме събития, които завършват днес или в бъдеще
                       ->where('end_datetime', '>=', $now)
                       ->orderBy('start_datetime', 'asc') // Подреждане по начална дата
                       ->paginate(10);

        return view('events.index', compact('events'));
    }
}
