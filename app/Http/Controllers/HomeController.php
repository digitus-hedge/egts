<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BehindTheScene;
use App\Models\ClientSection;
use App\Models\FacilityBanner;
use App\Models\HomeAbout;
use App\Models\Machine;
use App\Models\Project;
use App\Models\ProjectsClientsBanner;
use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\Stat;
use App\Models\Tool;
use App\Models\WhyChooseUs;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::first();
        $about  = HomeAbout::first();
        $stat   = Stat::first();
        $serviceSection = ServiceSection::first();
        $services = Service::latest()->take(8)->get();
        $clientSection = ClientSection::first();
        $whyChooseUs = WhyChooseUs::first();

        return view('web.home', compact('banner', 'about', 'stat', 'serviceSection', 'services', 'clientSection', 'whyChooseUs'));
    }

    public function about()
    {
        $whyChooseUs = WhyChooseUs::first();
        $bts = BehindTheScene::latest()->get();

        return view('web.about_us', compact('whyChooseUs', 'bts'));
    }

    public function facility()
    {
        $facilityBanner = FacilityBanner::first();
        $machines = Machine::latest()->get();
        $tools = Tool::latest()->get();

        return view('web.facility_capabilities', compact('facilityBanner', 'machines', 'tools'));
    }

    public function projectsClients()
    {
        $banner = ProjectsClientsBanner::first();
        $projects = Project::latest()->get();

        return view('web.projects_clients', compact('banner', 'projects'));
    }

    public function services()
    {
        $services = Service::get();

        return view('web.services', compact('services'));
    }

     public function serviceDetails($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $relatedServices = Service::where('id', '!=', $service->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('web.service_details', compact('service', 'relatedServices'));
    }
}
