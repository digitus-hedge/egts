<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BehindTheSceneRequest;
use App\Models\BehindTheScene;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class BehindTheSceneController extends Controller
{
    /**
     * Display a listing of Behind The Scenes items.
     */
   public function index(Request $request)
{
    $search  = $request->get('search');
    $perPage = $request->get('per_page', 10);

    $behindTheScenes = BehindTheScene::with('service')
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->orderBy('sort_order')
        ->latest()
        ->paginate($perPage)
        ->withQueryString();

    return view('admin.behind-scene.list', compact('behindTheScenes', 'search', 'perPage'));
}

    /**
     * Show the form for creating a new Behind The Scenes item.
     */
    public function create()
    {
        $services = Service::select('id', 'title')->get();
        $behindTheScene = new BehindTheScene(); // so $behindTheScene->exists works in the blade

        return view('admin.behind-scene.form', compact('services', 'behindTheScene'));
    }

    /**
     * Store a newly created Behind The Scenes item.
     */
    public function store(BehindTheSceneRequest $request)
    {
        $data = $request->only(['service_id', 'title', 'description']);


        // Reset all media fields first, then set only the selected one
        $data['video']     = null;
        $data['video_url'] = null;
        $data['image']     = null;

        switch ($request->media_type) {
            case 'video':
                if ($request->hasFile('video')) {
                    $data['video'] = $request->file('video')->store('behind-the-scenes/videos', 'public');
                }
                break;

            case 'video_url':
                $data['video_url'] = $request->video_url;
                break;

            case 'image':
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('behind-the-scenes/images', 'public');
                }
                break;
        }

        BehindTheScene::create($data);

        return redirect()->route('home.services.behind-the-scenes')
            ->with('success', 'Behind The Scenes item created successfully.');
    }

    /**
     * Show the form for editing an existing Behind The Scenes item.
     */
    public function edit(BehindTheScene $behind_the_scene)
    {
        $services = Service::select('id', 'title')->get();

        return view('admin.behind-scene.form', [
            'services'       => $services,
            'behindTheScene' => $behind_the_scene,
        ]);
    }

    /**
     * Update an existing Behind The Scenes item.
     */
    public function update(BehindTheSceneRequest $request, BehindTheScene $behind_the_scene)
    {
        $data = $request->only(['service_id', 'title', 'description']);
      
        // Delete old files for media types that are no longer selected
        if ($behind_the_scene->video && $request->media_type !== 'video') {
            Storage::disk('public')->delete($behind_the_scene->video);
        }
        if ($behind_the_scene->image && $request->media_type !== 'image') {
            Storage::disk('public')->delete($behind_the_scene->image);
        }

        // Reset all media fields, then set only the selected one
        $data['video']     = null;
        $data['video_url'] = null;
        $data['image']     = null;

        switch ($request->media_type) {
            case 'video':
                if ($request->hasFile('video')) {
                    if ($behind_the_scene->video) {
                        Storage::disk('public')->delete($behind_the_scene->video);
                    }
                    $data['video'] = $request->file('video')->store('behind-the-scenes/videos', 'public');
                } else {
                    // keep existing video if no new file uploaded
                    $data['video'] = $behind_the_scene->video;
                }
                break;

            case 'video_url':
                $data['video_url'] = $request->video_url;
                break;

            case 'image':
                if ($request->hasFile('image')) {
                    if ($behind_the_scene->image) {
                        Storage::disk('public')->delete($behind_the_scene->image);
                    }
                    $data['image'] = $request->file('image')->store('behind-the-scenes/images', 'public');
                } else {
                    // keep existing image if no new file uploaded
                    $data['image'] = $behind_the_scene->image;
                }
                break;
        }

        $behind_the_scene->update($data);

        return redirect()->route('home.services.behind-the-scenes')
            ->with('success', 'Behind The Scenes item updated successfully.');
    }

    /**
     * Remove a Behind The Scenes item.
     */
    public function destroy(BehindTheScene $behind_the_scene)
    {
        if ($behind_the_scene->video) {
            Storage::disk('public')->delete($behind_the_scene->video);
        }
        if ($behind_the_scene->image) {
            Storage::disk('public')->delete($behind_the_scene->image);
        }

        $behind_the_scene->delete();

        return back()->with('success', 'Behind The Scenes item deleted successfully.');
    }
}