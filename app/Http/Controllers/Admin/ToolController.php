<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToolRequest;
use App\Models\Tool;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ToolController extends Controller
{
    protected int $imageWidth = 600;
    protected int $imageHeight = 450;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $tools = Tool::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.tool.list', compact('tools', 'search', 'perPage'));
    }

    public function create()
    {
        $tool = new Tool();
        return view('admin.tool.form', compact('tool'));
    }

    public function store(ToolRequest $request)
    {
        $data = $request->validated();

        $tool = new Tool();
        $tool->title = $data['title'];
        $tool->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            $tool->image = $this->processAndStoreImage($request->file('image'));
        }

        $tool->save();

        return redirect()
            ->route('admin.home.facility.tools')
            ->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        return view('admin.tool.form', compact('tool'));
    }

    public function update(ToolRequest $request, Tool $tool)
    {
        $data = $request->validated();

        $tool->title = $data['title'];
        $tool->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($tool->image) {
                Storage::disk('public')->delete($tool->image);
            }
            $tool->image = $this->processAndStoreImage($request->file('image'));
        }

        $tool->save();

        return redirect()
            ->route('admin.home.facility.tools')
            ->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        if ($tool->image) {
            Storage::disk('public')->delete($tool->image);
        }

        $tool->delete();

        return redirect()
            ->route('admin.home.facility.tools')
            ->with('success', 'Tool deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'tools/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
