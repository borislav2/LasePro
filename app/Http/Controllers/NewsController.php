<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 


class NewsController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
            
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published && !auth()->user()?->isAdmin()) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        return view('news.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', News::class);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // max 2MB
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $validated['image_path'] = $path;
        }

        $validated['user_id'] = auth()->id();
        
        News::create($validated);

        return redirect()->route('news.index')
            ->with('success', 'Новината беше създадена успешно.');
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $path = $request->file('image')->store('news', 'public');
            $validated['image_path'] = $path;
        }

        $news->update($validated);

        return redirect()->route('news.show', $news)
            ->with('success', 'Новината беше обновена успешно.');
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Новината беше изтрита успешно.');
    }
}
