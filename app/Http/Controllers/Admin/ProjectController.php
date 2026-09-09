<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
    protected int $imageWidth = 800;
    protected int $imageHeight = 600;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $projects = Project::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.project.list', compact('projects', 'search', 'perPage'));
    }

    public function create()
    {
        $project = new Project();
        return view('admin.project.form', compact('project'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();
        $project->title = $data['title'];
        $project->client_name = $data['client_name'] ?? null;
        $project->description = $data['description'] ?? null;
        $project->meta_title = $data['meta_title'] ?? null;
        $project->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            $project->image = $this->processAndStoreImage($request->file('image'));
        }

        $project->save();

        return redirect()
            ->route('admin.home.projects')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.project.form', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->title = $data['title'];
        $project->client_name = $data['client_name'] ?? null;
        $project->description = $data['description'] ?? null;
        $project->meta_title = $data['meta_title'] ?? null;
        $project->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $project->image = $this->processAndStoreImage($request->file('image'));
        }

        $project->save();

        return redirect()
            ->route('admin.home.projects')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.home.projects')
            ->with('success', 'Project deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'projects/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
