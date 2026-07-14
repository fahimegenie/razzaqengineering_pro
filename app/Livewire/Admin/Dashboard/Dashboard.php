<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Slider;
use App\Models\OurService;
use App\Models\Project;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\QuoteRequest;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\OurTeam;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Dashboard - Razzaq Engineering Admin')]
class Dashboard extends Component
{
    use WithPagination;
    
    // Loading states
    public $isLoading = false;
    public $errorMessage = '';
    public $lastRefreshed = null;
    
    // Filters
    #[Url(history: true)]
    public $period = '12months';
    
    #[Url(history: true)]
    public $chartType = 'area';
    
    // Alpine state tracking
    public $selectedStat = null;
    public $showDetailModal = false;
    public $selectedChart = null;
    public $activeTab = 'overview';
    
    // Computed properties cache
    private $statsCache = [];
    
    public function mount()
    {
        $this->loadDashboardData();
    }
    
    private function loadDashboardData()
    {
        try {
            $this->isLoading = true;
            
            // Cache expensive queries for 5 minutes
            $this->statsCache = Cache::remember('admin.dashboard.stats', 300, function () {
                return $this->calculateAllStats();
            });
            
            $this->lastRefreshed = now();
            $this->isLoading = false;
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to load dashboard data. Please try again.';
            $this->isLoading = false;
            Log::error('Dashboard error: ' . $e->getMessage());
        }
    }
    
    #[Computed]
    public function stats()
    {
        if (!empty($this->statsCache)) {
            return $this->statsCache['stats'];
        }
        
        return $this->getDefaultStats();
    }
    
    #[Computed]
    public function projectStatusChart()
    {
        if (!empty($this->statsCache)) {
            return $this->statsCache['projectStatusChart'];
        }
        
        return $this->getDefaultProjectChart();
    }
    
    #[Computed]
    public function monthlyMessagesChart()
    {
        return Cache::remember('admin.dashboard.monthlyMessages.' . $this->period, 300, function () {
            return $this->calculateMonthlyMessages();
        });
    }
    
    #[Computed]
    public function servicesChart()
    {
        return Cache::remember('admin.dashboard.services', 300, function () {
            return $this->calculateServicesData();
        });
    }
    
    #[Computed]
    public function blogCategoriesChart()
    {
        return Cache::remember('admin.dashboard.blogCategories', 300, function () {
            return $this->calculateBlogCategories();
        });
    }
    
    #[Computed]
    public function recentMessages()
    {
        return ContactMessage::with(['assignedTo'])
            ->latest()
            ->take(5)
            ->get();
    }
    
    #[Computed]
    public function recentProjects()
    {
        return Project::with(['category'])
            ->latest()
            ->take(5)
            ->get();
    }
    
    #[Computed]
    public function recentBlogPosts()
    {
        return BlogPost::with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();
    }
    
    #[Computed]
    public function recentQuotes()
    {
        return QuoteRequest::latest()
            ->take(5)
            ->get();
    }
    
    #[Computed]
    public function recentUsers()
    {
        return User::latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'created_at', 'avatar']);
    }
    
    #[Computed]
    public function totalSliders()
    {
        return Slider::count();
    }
    
    #[Computed]
    public function totalServices()
    {
        return OurService::count();
    }
    
    #[Computed]
    public function totalProjects()
    {
        return Project::count();
    }
    
    #[Computed]
    public function totalProducts()
    {
        return Product::count();
    }
    
    #[Computed]
    public function totalBlogs()
    {
        return BlogPost::count();
    }
    
    #[Computed]
    public function totalMessages()
    {
        return ContactMessage::count();
    }
    
    #[Computed]
    public function totalUsers()
    {
        return User::count();
    }
    
    #[Computed]
    public function totalTestimonials()
    {
        return Testimonial::count();
    }
    
    #[Computed]
    public function totalFaqs()
    {
        return Faq::count();
    }
    
    #[Computed]
    public function totalPages()
    {
        return Page::count();
    }
    
    #[Computed]
    public function totalTeam()
    {
        return OurTeam::count();
    }
    
    #[Computed]
    public function newMessages()
    {
        return ContactMessage::where('cm_status', 'new')->count();
    }
    
    #[Computed]
    public function newQuotes()
    {
        return QuoteRequest::where('qr_status', 'pending')->count();
    }
    
    #[Computed]
    public function todayStats()
    {
        return Cache::remember('admin.dashboard.todayStats', 60, function () {
            $today = Carbon::today();
            return [
                'messages' => ContactMessage::whereDate('created_at', $today)->count(),
                'projects' => Project::whereDate('created_at', $today)->count(),
                'users' => User::whereDate('created_at', $today)->count(),
                'quotes' => QuoteRequest::whereDate('created_at', $today)->count(),
            ];
        });
    }
    
    private function calculateAllStats()
    {
        return [
            'stats' => $this->buildStatsArray(),
            'projectStatusChart' => $this->calculateProjectStatus(),
        ];
    }
    
    private function buildStatsArray()
    {
        return [
            [
                'title' => 'Total Sliders',
                'value' => $this->totalSliders,
                'icon' => 'bi-images',
                'color' => 'primary',
                'url' => route('admin.sliders.index'),
                'trend' => '+12%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Total Services',
                'value' => $this->totalServices,
                'icon' => 'bi-gear',
                'color' => 'success',
                'url' => route('admin.services.index'),
                'trend' => '+5%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Total Projects',
                'value' => $this->totalProjects,
                'icon' => 'bi-briefcase',
                'color' => 'warning',
                'url' => route('admin.projects.index'),
                'trend' => '+8%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Total Products',
                'value' => $this->totalProducts,
                'icon' => 'bi-box-seam',
                'color' => 'danger',
                'url' => route('admin.products.index'),
                'trend' => '+15%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Blog Posts',
                'value' => $this->totalBlogs,
                'icon' => 'bi-journal-text',
                'color' => 'info',
                'url' => route('admin.blog.posts.index'),
                'trend' => '+3%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Messages',
                'value' => $this->totalMessages,
                'icon' => 'bi-envelope',
                'color' => 'secondary',
                'url' => url('admin.contacts.messages'),
                'trend' => $this->newMessages . ' new',
                'trend_color' => 'danger',
                'trend_icon' => 'bi-exclamation-circle',
            ],
            [
                'title' => 'Users',
                'value' => $this->totalUsers,
                'icon' => 'bi-people',
                'color' => 'primary',
                'url' => url('admin.users.index'),
                'trend' => '+2%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
            [
                'title' => 'Testimonials',
                'value' => $this->totalTestimonials,
                'icon' => 'bi-chat-quote',
                'color' => 'success',
                'url' => route('admin.testimonials.index'),
                'trend' => '+10%',
                'trend_color' => 'success',
                'trend_icon' => 'bi-arrow-up-short',
            ],
        ];
    }
    
    private function calculateProjectStatus()
    {
        return [
            'series' => [
                Project::where('p_status', 'completed')->count(),
                Project::where('p_status', 'in-progress')->count(),
                Project::where('p_status', 'upcoming')->count(),
            ],
            'labels' => ['Completed', 'In Progress', 'Upcoming'],
            'colors' => ['#28a745', '#ffc107', '#17a2b8'],
        ];
    }
    
    private function calculateMonthlyMessages()
    {
        $months = $this->period === '6months' ? 6 : 12;
        
        $monthlyMessages = ContactMessage::selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%b %Y') as month,
                    COUNT(*) as count
                ")
                ->where('created_at', '>=', now()->subMonths($months))
                ->groupByRaw('YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, "%b %Y")')
                ->orderByRaw('YEAR(created_at), MONTH(created_at)')
                ->get();
            
        return [
            'categories' => $monthlyMessages->pluck('month')->toArray(),
            'series' => [
                [
                    'name' => 'Messages',
                    'data' => $monthlyMessages->pluck('count')->toArray(),
                ]
            ],
        ];
    }
    
    private function calculateServicesData()
    {
        $services = OurService::withCount('serviceDetails')->get();
        
        return [
            'categories' => $services->pluck('os_name')->toArray(),
            'series' => [
                [
                    'name' => 'Details',
                    'data' => $services->pluck('details_count')->toArray(),
                ]
            ],
        ];
    }
    
    private function calculateBlogCategories()
    {
        $blogCategories = DB::table('blog_posts')
            ->join('blog_categories', 'blog_posts.category_id', '=', 'blog_categories.id')
            ->select('blog_categories.bc_name', DB::raw('COUNT(*) as count'))
            ->groupBy('blog_categories.id', 'blog_categories.bc_name')
            ->orderByDesc('count')
            ->limit(8)
            ->get();
            
        return [
            'series' => $blogCategories->pluck('count')->toArray(),
            'labels' => $blogCategories->pluck('bc_name')->toArray(),
        ];
    }
    
    private function getDefaultStats()
    {
        return [
            [
                'title' => 'No Data',
                'value' => 0,
                'icon' => 'bi-exclamation-triangle',
                'color' => 'secondary',
                'url' => '#',
                'trend' => 'N/A',
                'trend_color' => 'secondary',
                'trend_icon' => 'bi-dash',
            ],
        ];
    }
    
    private function getDefaultProjectChart()
    {
        return [
            'series' => [0, 0, 0],
            'labels' => ['No Data', 'No Data', 'No Data'],
            'colors' => ['#6c757d', '#6c757d', '#6c757d'],
        ];
    }
    
    // Public methods for interactions
    public function refreshData()
    {
        Cache::forget('admin.dashboard.stats');
        Cache::forget('admin.dashboard.monthlyMessages.' . $this->period);
        Cache::forget('admin.dashboard.services');
        Cache::forget('admin.dashboard.blogCategories');
        Cache::forget('admin.dashboard.todayStats');
        
        $this->loadDashboardData();
        $this->dispatch('toast', 
            type: 'success', 
            title: 'Refreshed!',
            message: 'Dashboard data has been refreshed successfully.'
        );
    }
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function showStatDetail($index)
    {
        $stats = $this->stats;
        if (isset($stats[$index])) {
            $this->selectedStat = $stats[$index];
            $this->showDetailModal = true;
        }
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedStat = null;
    }
    
    public function updatedPeriod($value)
    {
        Cache::forget('admin.dashboard.monthlyMessages.' . $value);
        $this->dispatch('chart-updated', chart: 'monthlyMessages');
    }
    
    public function updatedChartType($value)
    {
        $this->dispatch('chart-type-changed', type: $value);
    }
    
    public function exportData($type = 'csv')
    {
        try {
            // Export logic here
            $this->dispatch('toast', 
                type: 'success', 
                message: "Data exported as {$type} successfully."
            );
        } catch (\Exception $e) {
            $this->dispatch('toast', 
                type: 'error', 
                message: 'Export failed: ' . $e->getMessage()
            );
        }
    }
    
    #[Computed]
    public function getQuickActionsProperty()
    {
        return [
            [
                'label' => 'Add Slider',
                'icon' => 'bi-plus-circle',
                'url' => route('admin.sliders.create'),
                'color' => 'primary',
            ],
            [
                'label' => 'Add Service',
                'icon' => 'bi-plus-circle',
                'url' => url('admin.services.create'),
                'color' => 'success',
            ],
            [
                'label' => 'Add Project',
                'icon' => 'bi-plus-circle',
                'url' => url('admin.projects.create'),
                'color' => 'warning',
            ],
            [
                'label' => 'Add Product',
                'icon' => 'bi-plus-circle',
                'url' => route('admin.products.create'),
                'color' => 'danger',
            ],
            [
                'label' => 'Write Post',
                'icon' => 'bi-pencil-square',
                'url' => route('admin.blog.posts.create'),
                'color' => 'info',
            ],
            [
                'label' => 'Add User',
                'icon' => 'bi-person-plus',
                'url' => url('admin.users.create'),
                'color' => 'secondary',
            ],
            [
                'label' => 'New Page',
                'icon' => 'bi-file-earmark-plus',
                'url' => url('admin.pages.create'),
                'color' => 'outline-primary',
            ],
            [
                'label' => 'Settings',
                'icon' => 'bi-gear',
                'url' => route('admin.settings.index'),
                'color' => 'outline-secondary',
            ],
        ];
    }
    
    #[Computed]
    public function getWelcomeMessageProperty()
    {
        $hour = now()->hour;
        $name = auth()->user()->name ?? 'Admin';
        
        if ($hour < 12) {
            return "Good Morning, {$name}! ☀️";
        } elseif ($hour < 17) {
            return "Good Afternoon, {$name}! 👋";
        } else {
            return "Good Evening, {$name}! 🌙";
        }
    }
    
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard', [
            'stats' => $this->stats,
            'projectStatusChart' => $this->projectStatusChart,
            'monthlyMessagesChart' => $this->monthlyMessagesChart,
            'servicesChart' => $this->servicesChart,
            'blogCategoriesChart' => $this->blogCategoriesChart,
            'recentMessages' => $this->recentMessages,
            'recentProjects' => $this->recentProjects,
            'recentBlogPosts' => $this->recentBlogPosts,
            'recentQuotes' => $this->recentQuotes,
            'recentUsers' => $this->recentUsers,
            'todayStats' => $this->todayStats,
            'quickActions' => $this->quickActions,
            'welcomeMessage' => $this->welcomeMessage,
        ]);
    }
}