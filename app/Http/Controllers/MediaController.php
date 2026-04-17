<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MediaController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Media::ordered();

        // Filter by category if provided
        if ($request->has('category') && in_array($request->category, ['wood', 'stone', 'metal'])) {
            $query->byCategory($request->category);
        }

        $media = $query->paginate(20);
        return view('media.index', compact('media'));
    }

    public function gallery(Request $request)
    {
        $category = $request->get('category');
        $type = $request->get('type');

        $query = Media::published()->ordered();

        if ($category && in_array($category, ['wood', 'stone', 'metal'])) {
            $query->byCategory($category);
        }

        if ($type && in_array($type, ['image', 'video'])) {
            $query->byType($type);
        }

        $media = $query->get();
        $featuredMedia = Media::published()->featured()->ordered()->limit(6)->get();

        return view('gallery.index', compact('media', 'featuredMedia', 'category', 'type'));
    }

    public function byCategory($category)
    {
        if (!in_array($category, ['wood', 'stone', 'metal'])) {
            abort(404);
        }

        $media = Media::published()->byCategory($category)->ordered()->get();
        $featuredMedia = Media::published()->byCategory($category)->featured()->ordered()->limit(4)->get();

        return view('gallery.category', compact('media', 'featuredMedia', 'category'));
    }

    public function create()
    {
        $this->authorize('create', Media::class);
        return view('media.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Media::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:51200', // max 50MB
            'type' => 'required|in:image,video',
            'category' => 'required|in:wood,stone,metal',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $folder = $validated['type'] === 'video' ? 'videos' : 'images';
            $categoryFolder = $validated['category'];
            $path = $file->store("media/{$folder}/{$categoryFolder}", 'public');
            $validated['file_path'] = $path;
        }

        $validated['uploaded_by_user_id'] = auth()->id();
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_published'] = $request->boolean('is_published', true);

        Media::create($validated);

        return redirect()->route('media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    public function edit(Media $media)
    {
        $this->authorize('update', $media);
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $this->authorize('update', $media);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:51200',
            'type' => 'required|in:image,video',
            'category' => 'required|in:wood,stone,metal',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('file')) {
            if ($media->file_path) {
                Storage::disk('public')->delete($media->file_path);
            }
            $file = $request->file('file');
            $folder = $validated['type'] === 'video' ? 'videos' : 'images';
            $categoryFolder = $validated['category'];
            $path = $file->store("media/{$folder}/{$categoryFolder}", 'public');
            $validated['file_path'] = $path;
        }

        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_published'] = $request->boolean('is_published', true);

        $media->update($validated);

        return redirect()->route('media.index')
            ->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $media)
    {
        $this->authorize('delete', $media);

        if ($media->file_path) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('media.index')
            ->with('success', 'Media deleted successfully.');
    }

    public function featuredByCategory($category)
    {
        if (!in_array($category, ['wood', 'stone', 'metal'])) {
            return collect();
        }

        return Media::published()
            ->byCategory($category)
            ->featured()
            ->ordered()
            ->limit(4)
            ->get();
    }
}
