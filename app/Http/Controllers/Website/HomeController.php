<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceAdvantage;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Faq;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\Slider;
use App\Models\Company;
use App\Models\AboutUs;
use App\Models\SeoData;
use App\Models\ContactUs;
use App\Models\ContactAddress;
use App\Models\Testimonial;
use App\Models\PdfFile;
use App\Models\Page;
use App\Models\NewsletterSubscriber;

class HomeController extends Controller
{
    public function index(){
        $services = Service::active()->ordered()->get();
        $seo = SeoData::where('seo_page_type', 'Home')->first();
        $slider = Slider::active()->ordered()->get();
        $com = Company::active()->first();
        $os = Service::active()->get();
        $sd = ServiceDetail::all();
        $pro = Project::active()->latest()->get();
        $pc = ProductCategory::active()->select('pc_name')->get();
        $testimonials = Testimonial::active()->featured()->ordered()->get();
 
        return view('website/index', compact('pc','services','slider','com','os','sd','seo','pro','testimonials'));
    }
    
    public function service_detail_name($name){
        $services = Service::active()->ordered()->get();
        $s = $name;
        $pdffile = PdfFile::active()->first();
        $os = Service::active()->get();
        
        // Using relationships (MUCH cleaner!)
        $sd = ServiceDetail::with(['service.serviceAdvantages'])->ordered()->get();
        
        $seo = SeoData::where('seo_page_type', $name)->first();
        $pc = ProductCategory::active()->select('pc_name')->get();
        
        return view('website/service_detail', compact('pc','services','s','seo','os','sd','pdffile'));
    }
    
    public function contact_submit(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'cm_name' => $request->name,
            'cm_email' => $request->email,
            'cm_phone' => $request->phone,
            'cm_subject' => $request->subject,
            'cm_message' => $request->message,
            'cm_source' => 'website',
            'cm_priority' => 'medium',
            'cm_status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    
    public function blog(){
        $services = Service::active()->ordered()->get();
        $pc = ProductCategory::active()->select('pc_name')->get();
        $seo = SeoData::where('seo_page_type', 'Blog')->first();
        
        // Eager loading for performance
        $blogs = BlogPost::published()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(9);
        
        $categories = BlogCategory::active()->ordered()->get();
        $recentPosts = BlogPost::published()->latest()->limit(5)->get();
        $tags = BlogTag::active()->ordered()->get();
        
        return view('website/blog/index', compact('pc', 'services', 'seo', 'blogs', 'categories', 'recentPosts', 'tags'));
    }
    
    public function blog_show($slug){
        $services = Service::active()->ordered()->get();
        $pc = ProductCategory::active()->select('pc_name')->get();
        
        $blog = BlogPost::published()
            ->with(['category', 'tags', 'author', 'comments.replies'])
            ->where('bp_slug', $slug)
            ->firstOrFail();
        
        // Increment view count
        $blog->increment('views_count');
        
        $categories = BlogCategory::active()->ordered()->get();
        $recentPosts = BlogPost::published()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->limit(5)
            ->get();
        $tags = BlogTag::active()->ordered()->get();
        
        return view('website/blog/show', compact('pc', 'services', 'blog', 'categories', 'recentPosts', 'tags'));
    }
    
    public function search(Request $request){
        $query = $request->get('q');
        $services = Service::active()->ordered()->get();
        $pc = ProductCategory::active()->select('pc_name')->get();
        $seo = SeoData::where('seo_page_type', 'Search')->first();

        $results = collect();
        
        if($query){
            $results['services'] = Service::active()
                ->where(function($q) use ($query) {
                    $q->where('os_name', 'like', '%'.$query.'%')
                      ->orWhere('os_description', 'like', '%'.$query.'%');
                })->get();
            
            $results['products'] = Product::active()
                ->where(function($q) use ($query) {
                    $q->where('p_name', 'like', '%'.$query.'%')
                      ->orWhere('p_description', 'like', '%'.$query.'%');
                })->get();
            
            $results['blogs'] = BlogPost::published()
                ->where(function($q) use ($query) {
                    $q->where('bp_title', 'like', '%'.$query.'%')
                      ->orWhere('bp_content', 'like', '%'.$query.'%');
                })->get();
        }

        return view('website/search', compact('pc', 'services', 'seo', 'query', 'results'));
    }
    
    public function newsletter_subscribe(Request $request){
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,ns_email',
            'name' => 'nullable|string|max:255',
        ]);

        NewsletterSubscriber::create([
            'ns_email' => $request->email,
            'ns_name' => $request->name,
            'subscription_token' => bin2hex(random_bytes(32)),
            'is_subscribed' => 1,
            'subscribed_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}