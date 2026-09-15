<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $enquiries = Enquiry::query()
            ->when($search, function ($query, $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.enquiry.list', compact('enquiries', 'search', 'perPage'));
    }

    public function show(Enquiry $enquiry)
    {
        if (!$enquiry->is_read) {
            $enquiry->update(['is_read' => true]);
        }

        return view('admin.enquiry.show', compact('enquiry'));
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.home.enquiries')
            ->with('success', 'Enquiry deleted successfully.');
    }
}
