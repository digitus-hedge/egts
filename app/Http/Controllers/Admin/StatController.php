<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatRequest;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $stats = Stat::query()
            ->when($search, function ($query, $search) {
                $query->where('label', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('sort_order')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.stat.list', compact('stats', 'search', 'perPage'));
    }

    public function create()
    {
        $stat = new Stat();
        return view('admin.stat.form', compact('stat'));
    }

    public function store(StatRequest $request)
    {
        Stat::create($request->validated());

        return redirect()
            ->route('admin.home.stats')
            ->with('success', 'Stat created successfully.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stat.form', compact('stat'));
    }

    public function update(StatRequest $request, Stat $stat)
    {
        $stat->update($request->validated());

        return redirect()
            ->route('admin.home.stats')
            ->with('success', 'Stat updated successfully.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();

        return redirect()
            ->route('admin.home.stats')
            ->with('success', 'Stat deleted successfully.');
    }
}