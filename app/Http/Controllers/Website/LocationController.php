<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\OurService;
use App\Models\Core\Project;
use App\Models\SEO\SeoData;

class LocationController extends Controller
{
    protected $cities = [
        'lahore' => 'Lahore',
        'islamabad' => 'Islamabad',
        'karachi' => 'Karachi',
        'rawalpindi' => 'Rawalpindi',
        'peshawar' => 'Peshawar'
    ];

    public function index()
    {
        $seo = SeoData::where('seo_page_type', 'locations')->first();
        $cities = $this->cities;
        
        return view('website.locations.index', compact('seo', 'cities'));
    }

    public function city($city)
    {
        if (!array_key_exists($city, $this->cities)) {
            abort(404);
        }
        
        $cityName = $this->cities[$city];
        $services = OurService::where('is_active', true)->get();
        $projects = Project::where('is_active', true)
            ->where(function($q) use ($cityName) {
                $q->where('p_location', 'like', "%{$cityName}%")
                  ->orWhere('p_category', 'like', "%{$cityName}%");
            })
            ->get();
        
        $seo = SeoData::where('seo_page_type', 'city_' . $city)->first();
        
        return view('website.locations.city', compact('cityName', 'city', 'services', 'projects', 'seo'));
    }

    public function cityService($city, $service)
    {
        if (!array_key_exists($city, $this->cities)) {
            abort(404);
        }
        
        $cityName = $this->cities[$city];
        $serviceData = OurService::where('os_slug', $service)
            ->orWhere('os_name', 'like', "%{$service}%")
            ->firstOrFail();
        
        $seo = SeoData::where('seo_page_type', "{$service}_{$city}")->first();
        
        return view('website.locations.city-service', compact('cityName', 'city', 'serviceData', 'seo'));
    }

    public function concreteCutting($city)
    {
        return $this->cityService($city, 'concrete-cutting');
    }

    public function coreCutting($city)
    {
        return $this->cityService($city, 'core-cutting');
    }

    public function wallSawing($city)
    {
        return $this->cityService($city, 'wall-sawing');
    }

    public function wireSawing($city)
    {
        return $this->cityService($city, 'wire-sawing');
    }

    public function floorSawing($city)
    {
        return $this->cityService($city, 'floor-sawing');
    }
}