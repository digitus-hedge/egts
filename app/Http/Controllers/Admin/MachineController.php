<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineRequest;
use App\Models\Machine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MachineController extends Controller
{
    protected int $imageWidth = 600;
    protected int $imageHeight = 450;
    protected int $compressQuality = 70;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $machines = Machine::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.machine.list', compact('machines', 'search', 'perPage'));
    }

    public function create()
    {
        $machine = new Machine();
        return view('admin.machine.form', compact('machine'));
    }

    public function store(MachineRequest $request)
    {
        $data = $request->validated();

        $machine = new Machine();
        $machine->title = $data['title'];
        $machine->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            $machine->image = $this->processAndStoreImage($request->file('image'));
        }

        $machine->save();

        return redirect()
            ->route('admin.home.facility.machines')
            ->with('success', 'Machine created successfully.');
    }

    public function edit(Machine $machine)
    {
        return view('admin.machine.form', compact('machine'));
    }

    public function update(MachineRequest $request, Machine $machine)
    {
        $data = $request->validated();

        $machine->title = $data['title'];
        $machine->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            if ($machine->image) {
                Storage::disk('public')->delete($machine->image);
            }
            $machine->image = $this->processAndStoreImage($request->file('image'));
        }

        $machine->save();

        return redirect()
            ->route('admin.home.facility.machines')
            ->with('success', 'Machine updated successfully.');
    }

    public function destroy(Machine $machine)
    {
        if ($machine->image) {
            Storage::disk('public')->delete($machine->image);
        }

        $machine->delete();

        return redirect()
            ->route('admin.home.facility.machines')
            ->with('success', 'Machine deleted successfully.');
    }

    private function processAndStoreImage($file): string
    {
        $filename = 'machines/' . Str::random(20) . '.webp';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover($this->imageWidth, $this->imageHeight);
        $encoded = $image->toWebp(quality: $this->compressQuality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
