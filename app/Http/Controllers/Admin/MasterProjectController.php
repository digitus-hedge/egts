<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterProjectRequest;
use App\Models\MasterProject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MasterProjectController extends Controller
{
    protected int $imageWidth = 800;
    protected int $imageHeight = 600;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $masterProjects = MasterProject::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.master-project.list', compact('masterProjects', 'search', 'perPage'));
    }

    public function create()
    {
        $masterProject = new MasterProject();
        return view('admin.master-project.form', compact('masterProject'));
    }

    public function store(MasterProjectRequest $request)
    {
        $data = $request->validated();

        $masterProject = new MasterProject();
        $masterProject->title = $data['title'];
        $masterProject->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            $masterProject->image = $this->processAndStoreImage($request->file('image'));
        }

        $masterProject->save();

        return redirect()
            ->route('admin.home.masters.projects')
            ->with('success', 'Project created successfully.');
    }

    public function edit(MasterProject $master_project)
    {
        return view('admin.master-project.form', ['masterProject' => $master_project]);
    }

    public function update(MasterProjectRequest $request, MasterProject $master_project)
    {
        $data = $request->validated();

        $master_project->title = $data['title'];
        $master_project->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($master_project->image) {
                Storage::disk('public')->delete($master_project->image);
            }
            $master_project->image = $this->processAndStoreImage($request->file('image'));
        }

        $master_project->save();

        return redirect()
            ->route('admin.home.masters.projects')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(MasterProject $master_project)
    {
        if ($master_project->image) {
            Storage::disk('public')->delete($master_project->image);
        }

        $master_project->delete();

        return redirect()
            ->route('admin.home.masters.projects')
            ->with('success', 'Project deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'master-projects/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
