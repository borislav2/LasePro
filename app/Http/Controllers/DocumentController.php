<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->paginate(10);
        return view('documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function download(Document $document)
    {
        return response()->download(storage_path('app/public/' . $document->file_path));
    }
}