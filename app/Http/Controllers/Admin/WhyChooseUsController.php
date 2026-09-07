<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhyChooseUsRequest;
use App\Models\WhyChooseUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class WhyChooseUsController extends Controller
{
    protected int $imageWidth = 700;
    protected int $imageHeight = 800;
    protected int $compressQuality = 70;

    /**
     * SHOW FORM — always the single Why Choose Us section (or empty model if none exists yet)
     */
    public function index()
    {
        $why = WhyChooseUs::first() ?? new WhyChooseUs();
        return view('admin.why-choose-us.form', compact('why'));
    }

    /**
     * STORE — creates the section if none exists, otherwise updates the existing one
     */
    public function store(WhyChooseUsRequest $request)
    {
        $data = $request->validated();

        $why = WhyChooseUs::first() ?? new WhyChooseUs();
        $why->heading = $data['heading'];
        $why->description = $data['description'];

        // $why->mission_title = $data['mission_title'];
        // $why->mission_description = $data['mission_description'];

        // $why->vision_title = $data['vision_title'];
        // $why->vision_description = $data['vision_description'];

        // $why->values_title = $data['values_title'];
        // $why->values_description = $data['values_description'];

        // $why->commitment_title = $data['commitment_title'];
        // $why->commitment_description = $data['commitment_description'];

        // foreach (['mission_image', 'vision_image', 'values_image'] as $field) {
        //     if ($request->hasFile($field)) {
        //         if ($why->{$field}) {
        //             Storage::disk('public')->delete($why->{$field});
        //         }
        //         $why->{$field} = $this->processAndStoreImage($request->file($field));
        //     }
        // }

        $why->save();

        return redirect()
            ->route('admin.home.why-choose-us')
            ->with('success', 'Why Choose Us section saved successfully.');
    }

  
    
}
