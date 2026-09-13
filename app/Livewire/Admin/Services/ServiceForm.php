<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Service;
use App\Traits\HandlesUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

#[Layout('components.layouts.admin-layout')]
#[Title('Service Form - Admin Panel')]
class ServiceForm extends Component
{
    // Uploads Handle karne wala hamara professional trait
    use HandlesUploads;

    public $serviceId = null;
    public $isEditing = false;
    public $isSaving = false;
    
    public $os_image;
    public $existing_os_image = null; // Purani image ka path store karne ke liye
    public $os_banner;
    public $existing_os_banner = null; // Purani banner image ka path store karne ke liye
    public $imagePreview;
    public $bannerPreview;
    
    #[Validate('required|string|max:255')]
    public $os_name = '';
    
    #[Validate('nullable|string|max:255')]
    public $os_slug = '';
    
    #[Validate('nullable|string|max:100')]
    public $os_icon = '';
    
    #[Validate('nullable|string')]
    public $os_description = '';
    
    #[Validate('nullable|string')]
    public $os_short_description = '';
    
    #[Validate('nullable|string|max:255')]
    public $meta_title = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_description = '';
    
    #[Validate('nullable|string|max:500')]
    public $meta_keywords = '';
    
    #[Validate('nullable|integer|min:0')]
    public $sort_order = 0;
    
    #[Validate('boolean')]
    public $is_active = true;
    
    #[Validate('boolean')]
    public $is_featured = false;

    // Icon options - Comprehensive list for all industries
    public $iconOptions = [
        // ============================================================
        // CONSTRUCTION & ENGINEERING
        // ============================================================
        'bi bi-tools' => 'Tools',
        'bi bi-wrench' => 'Wrench',
        'bi bi-wrench-adjustable' => 'Adjustable Wrench',
        'bi bi-hammer' => 'Hammer',
        'bi bi-screwdriver' => 'Screwdriver',
        'bi bi-nut' => 'Nut & Bolt',
        'bi bi-cone-striped' => 'Construction Cone',
        'bi bi-building' => 'Building',
        'bi bi-building-add' => 'Building Add',
        'bi bi-building-check' => 'Building Check',
        'bi bi-building-dash' => 'Building Dash',
        'bi bi-building-down' => 'Building Down',
        'bi bi-building-exclamation' => 'Building Alert',
        'bi bi-building-gear' => 'Building Gear',
        'bi bi-building-up' => 'Building Up',
        'bi bi-buildings' => 'Buildings',
        'bi bi-house' => 'House',
        'bi bi-house-add' => 'House Add',
        'bi bi-house-check' => 'House Check',
        'bi bi-house-door' => 'House Door',
        'bi bi-house-gear' => 'House Gear',
        'bi bi-house-heart' => 'House Heart',
        'bi bi-houses' => 'Houses',
        'bi bi-bricks' => 'Bricks',
        'bi bi-rulers' => 'Rulers',
        'bi bi-border-outer' => 'Blueprint',
        'bi bi-box-seam' => 'Container',
        'bi bi-truck' => 'Truck',
        'bi bi-truck-flatbed' => 'Flatbed Truck',
        'bi bi-droplet' => 'Water/Droplet',
        'bi bi-pipe' => 'Pipe',

        // ============================================================
        // ELECTRICAL & ELECTRONICS
        // ============================================================
        'bi bi-lightning' => 'Lightning',
        'bi bi-lightning-charge' => 'Lightning Charge',
        'bi bi-plug' => 'Plug',
        'bi bi-outlet' => 'Outlet',
        'bi bi-lightbulb' => 'Lightbulb',
        'bi bi-lightbulb-fill' => 'Lightbulb Fill',
        'bi bi-lightbulb-off' => 'Lightbulb Off',
        'bi bi-cpu' => 'CPU',
        'bi bi-cpu-fill' => 'CPU Fill',
        'bi bi-motherboard' => 'Motherboard',
        'bi bi-memory' => 'Memory',
        'bi bi-gpu-card' => 'GPU Card',
        'bi bi-router' => 'Router',
        'bi bi-modem' => 'Modem',
        'bi bi-wifi' => 'WiFi',
        'bi bi-wifi-off' => 'WiFi Off',
        'bi bi-bluetooth' => 'Bluetooth',
        'bi bi-battery' => 'Battery',
        'bi bi-battery-charging' => 'Battery Charging',
        'bi bi-battery-full' => 'Battery Full',
        'bi bi-battery-half' => 'Battery Half',
        'bi bi-usb-c' => 'USB-C',
        'bi bi-usb-plug' => 'USB Plug',
        'bi bi-usb-symbol' => 'USB Symbol',
        'bi bi-cable' => 'Cable',
        'bi bi-ethernet' => 'Ethernet',

        // ============================================================
        // PLUMBING & WATER
        // ============================================================
        'bi bi-droplet' => 'Droplet',
        'bi bi-droplet-fill' => 'Droplet Fill',
        'bi bi-droplet-half' => 'Droplet Half',
        'bi bi-water' => 'Water',
        'bi bi-moisture' => 'Moisture',
        'bi bi-tsunami' => 'Flood/Tsunami',
        'bi bi-pipe' => 'Pipe',
        'bi bi-faucet' => 'Faucet',
        'bi bi-shower' => 'Shower',
        'bi bi-bucket' => 'Bucket',
        'bi bi-bucket-fill' => 'Bucket Fill',
        'bi bi-cup-hot' => 'Hot Water',
        'bi bi-thermometer-half' => 'Thermometer',
        'bi bi-thermometer-high' => 'Thermometer High',
        'bi bi-thermometer-low' => 'Thermometer Low',
        'bi bi-thermometer-snow' => 'Thermometer Snow',
        'bi bi-thermometer-sun' => 'Thermometer Sun',

        // ============================================================
        // HVAC & COOLING
        // ============================================================
        'bi bi-fan' => 'Fan',
        'bi bi-wind' => 'Wind',
        'bi bi-snow' => 'Snow/Cooling',
        'bi bi-snow2' => 'Snow 2',
        'bi bi-cloud-snow' => 'Cloud Snow',
        'bi bi-thermometer-snow' => 'Thermometer Cold',
        'bi bi-thermometer-sun' => 'Thermometer Hot',
        'bi bi-thermometer' => 'Thermometer',
        'bi bi-thermometer-half' => 'Temperature',
        'bi bi-gear-wide-connected' => 'HVAC System',

        // ============================================================
        // FIRE SAFETY & SECURITY
        // ============================================================
        'bi bi-fire' => 'Fire',
        'bi bi-shield' => 'Shield',
        'bi bi-shield-fill' => 'Shield Fill',
        'bi bi-shield-check' => 'Shield Check',
        'bi bi-shield-exclamation' => 'Shield Alert',
        'bi bi-shield-lock' => 'Shield Lock',
        'bi bi-shield-shaded' => 'Shield Shaded',
        'bi bi-shield-slash' => 'Shield Slash',
        'bi bi-alarm' => 'Alarm',
        'bi bi-alarm-fill' => 'Alarm Fill',
        'bi bi-bell' => 'Bell',
        'bi bi-bell-fill' => 'Bell Fill',
        'bi bi-camera-video' => 'CCTV Camera',
        'bi bi-camera-video-fill' => 'CCTV Camera Fill',
        'bi bi-webcam' => 'Webcam',
        'bi bi-lock' => 'Lock',
        'bi bi-lock-fill' => 'Lock Fill',
        'bi bi-unlock' => 'Unlock',
        'bi bi-key' => 'Key',
        'bi bi-key-fill' => 'Key Fill',
        'bi bi-fingerprint' => 'Fingerprint',
        'bi bi-eyeglasses' => 'Inspection',

        // ============================================================
        // PAINTING & DECORATION
        // ============================================================
        'bi bi-brush' => 'Brush',
        'bi bi-brush-fill' => 'Brush Fill',
        'bi bi-paint-bucket' => 'Paint Bucket',
        'bi bi-palette' => 'Palette',
        'bi bi-palette-fill' => 'Palette Fill',
        'bi bi-palette2' => 'Palette 2',
        'bi bi-easel' => 'Easel',
        'bi bi-easel-fill' => 'Easel Fill',
        'bi bi-eraser' => 'Eraser',
        'bi bi-pencil' => 'Pencil',
        'bi bi-pencil-square' => 'Pencil Square',
        'bi bi-pen' => 'Pen',
        'bi bi-vector-pen' => 'Vector Pen',
        'bi bi-paint' => 'Paint',

        // ============================================================
        // CARPENTRY & WOODWORK
        // ============================================================
        'bi bi-tree' => 'Tree/Wood',
        'bi bi-tree-fill' => 'Tree Fill',
        'bi bi-scissors' => 'Scissors',
        'bi bi-rulers' => 'Rulers',
        'bi bi-border-width' => 'Border Width',
        'bi bi-columns' => 'Columns',
        'bi bi-columns-gap' => 'Columns Gap',
        'bi bi-layers' => 'Layers',
        'bi bi-layers-half' => 'Layers Half',

        // ============================================================
        // ROOFING & EXTERIOR
        // ============================================================
        'bi bi-house-roof' => 'House Roof',
        'bi bi-house-up' => 'House Up',
        'bi bi-house-down' => 'House Down',
        'bi bi-cloud-rain' => 'Rain',
        'bi bi-cloud-rain-heavy' => 'Heavy Rain',
        'bi bi-cloud-lightning' => 'Storm',
        'bi bi-cloud-lightning-rain' => 'Thunderstorm',
        'bi bi-cloud-sun' => 'Partly Cloudy',
        'bi bi-sun' => 'Sun',
        'bi bi-sun-fill' => 'Sun Fill',
        'bi bi-moon' => 'Moon',
        'bi bi-moon-stars' => 'Night',

        // ============================================================
        // FLOORING & TILING
        // ============================================================
        'bi bi-grid' => 'Grid/Tile',
        'bi bi-grid-3x3' => 'Grid 3x3',
        'bi bi-grid-3x3-gap' => 'Grid Gap',
        'bi bi-aspect-ratio' => 'Aspect Ratio',
        'bi bi-fullscreen' => 'Full Screen',
        'bi bi-fullscreen-exit' => 'Exit Full Screen',
        'bi bi-square' => 'Square/Tile',
        'bi bi-square-half' => 'Square Half',
        'bi bi-border-all' => 'Border All',
        'bi bi-border-inner' => 'Border Inner',
        'bi bi-border-center' => 'Border Center',
        'bi bi-puzzle' => 'Puzzle/Pattern',
        'bi bi-puzzle-fill' => 'Puzzle Fill',

        // ============================================================
        // GLASS & WINDOWS
        // ============================================================
        'bi bi-window' => 'Window',
        'bi bi-window-plus' => 'Window Plus',
        'bi bi-window-x' => 'Window Close',
        'bi bi-window-dock' => 'Window Dock',
        'bi bi-window-sidebar' => 'Window Sidebar',
        'bi bi-window-split' => 'Window Split',
        'bi bi-window-stack' => 'Window Stack',

        // ============================================================
        // LANDSCAPING & GARDENING
        // ============================================================
        'bi bi-flower1' => 'Flower',
        'bi bi-flower2' => 'Flower 2',
        'bi bi-flower3' => 'Flower 3',
        'bi bi-tree' => 'Tree',
        'bi bi-tree-fill' => 'Tree Fill',
        'bi bi-leaf' => 'Leaf',
        'bi bi-sun' => 'Sun',
        'bi bi-cloud-sun' => 'Sunny',
        'bi bi-water' => 'Water',
        'bi bi-umbrella' => 'Umbrella',
        'bi bi-umbrella-fill' => 'Umbrella Fill',

        // ============================================================
        // DEMOLITION & EXCAVATION
        // ============================================================
        'bi bi-cone-striped' => 'Cone',
        'bi bi-exclamation-triangle' => 'Warning',
        'bi bi-exclamation-triangle-fill' => 'Warning Fill',
        'bi bi-exclamation-octagon' => 'Stop',
        'bi bi-exclamation-octagon-fill' => 'Stop Fill',
        'bi bi-exclamation-circle' => 'Alert Circle',
        'bi bi-exclamation-diamond' => 'Alert Diamond',
        'bi bi-truck' => 'Truck',
        'bi bi-minecart' => 'Minecart',
        'bi bi-minecart-loaded' => 'Minecart Loaded',

        // ============================================================
        // RENOVATION & REMODELING
        // ============================================================
        'bi bi-arrow-repeat' => 'Repeat/Renovate',
        'bi bi-arrow-clockwise' => 'Clockwise',
        'bi bi-arrow-counterclockwise' => 'Counter Clockwise',
        'bi bi-recycle' => 'Recycle',
        'bi bi-box-arrow-up' => 'Upgrade',
        'bi bi-box-arrow-down' => 'Downgrade',
        'bi bi-stars' => 'Stars',
        'bi bi-star' => 'Star',
        'bi bi-star-fill' => 'Star Fill',
        'bi bi-star-half' => 'Star Half',
        'bi bi-award' => 'Award',
        'bi bi-award-fill' => 'Award Fill',
        'bi bi-trophy' => 'Trophy',
        'bi bi-trophy-fill' => 'Trophy Fill',

        // ============================================================
        // GENERAL BUSINESS & SERVICES
        // ============================================================
        'bi bi-gear' => 'Gear',
        'bi bi-gear-fill' => 'Gear Fill',
        'bi bi-gear-wide' => 'Gear Wide',
        'bi bi-gear-wide-connected' => 'Connected Gears',
        'bi bi-clipboard' => 'Clipboard',
        'bi bi-clipboard-check' => 'Clipboard Check',
        'bi bi-clipboard-data' => 'Clipboard Data',
        'bi bi-clipboard-minus' => 'Clipboard Minus',
        'bi bi-clipboard-plus' => 'Clipboard Plus',
        'bi bi-clipboard-x' => 'Clipboard Close',
        'bi bi-clipboard-pulse' => 'Clipboard Pulse',
        'bi bi-check-circle' => 'Check Circle',
        'bi bi-check-circle-fill' => 'Check Fill',
        'bi bi-check-square' => 'Check Square',
        'bi bi-check-all' => 'Check All',
        'bi bi-check-lg' => 'Check Large',
        'bi bi-phone' => 'Phone',
        'bi bi-phone-fill' => 'Phone Fill',
        'bi bi-telephone' => 'Telephone',
        'bi bi-telephone-fill' => 'Telephone Fill',
        'bi bi-telephone-forward' => 'Call Forward',
        'bi bi-telephone-inbound' => 'Call Inbound',
        'bi bi-telephone-outbound' => 'Call Outbound',
        'bi bi-envelope' => 'Email',
        'bi bi-envelope-fill' => 'Email Fill',
        'bi bi-envelope-open' => 'Open Email',
        'bi bi-envelope-check' => 'Email Check',
        'bi bi-envelope-exclamation' => 'Email Alert',
        'bi bi-globe' => 'Globe',
        'bi bi-globe2' => 'Globe 2',
        'bi bi-globe-americas' => 'Americas',
        'bi bi-globe-asia-australia' => 'Asia Australia',
        'bi bi-globe-central-south-asia' => 'South Asia',
        'bi bi-globe-europe-africa' => 'Europe Africa',
        'bi bi-pin-map' => 'Pin Map',
        'bi bi-pin-map-fill' => 'Pin Map Fill',
        'bi bi-geo-alt' => 'Location',
        'bi bi-geo-alt-fill' => 'Location Fill',
        'bi bi-map' => 'Map',
        'bi bi-map-fill' => 'Map Fill',
        'bi bi-signpost' => 'Signpost',
        'bi bi-signpost-2' => 'Signpost 2',
        'bi bi-signpost-fill' => 'Signpost Fill',
        'bi bi-signpost-2-fill' => 'Signpost 2 Fill',
        'bi bi-sign-turn-right' => 'Turn Right',
        'bi bi-sign-turn-left' => 'Turn Left',
        'bi bi-sign-turn-slight-right' => 'Slight Right',
        'bi bi-sign-turn-slight-left' => 'Slight Left',
        'bi bi-sign-yield' => 'Yield',
        'bi bi-sign-stop' => 'Stop Sign',
        'bi bi-sign-railroad' => 'Railroad',

        // ============================================================
        // INDUSTRY SPECIFIC
        // ============================================================
        'bi bi-minecart' => 'Mining',
        'bi bi-minecart-loaded' => 'Mining Loaded',
        'bi bi-fuel-pump' => 'Fuel/Gas',
        'bi bi-fuel-pump-fill' => 'Fuel Fill',
        'bi bi-oil-lamp' => 'Oil',
        'bi bi-radioactive' => 'Radioactive',
        'bi bi-virus' => 'Virus',
        'bi bi-virus2' => 'Virus 2',
        'bi bi-heart-pulse' => 'Health',
        'bi bi-heart-pulse-fill' => 'Health Fill',
        'bi bi-hospital' => 'Hospital',
        'bi bi-hospital-fill' => 'Hospital Fill',
        'bi bi-capsule' => 'Medicine',
        'bi bi-capsule-pill' => 'Pill',
        'bi bi-prescription' => 'Prescription',
        'bi bi-prescription2' => 'Prescription 2',
        'bi bi-bandaid' => 'First Aid',
        'bi bi-bandaid-fill' => 'First Aid Fill',
        'bi bi-calculator' => 'Calculator',
        'bi bi-calculator-fill' => 'Calculator Fill',
        'bi bi-bank' => 'Bank',
        'bi bi-cash' => 'Cash',
        'bi bi-cash-coin' => 'Coin',
        'bi bi-cash-stack' => 'Cash Stack',
        'bi bi-credit-card' => 'Credit Card',
        'bi bi-credit-card-2' => 'Credit Card 2',
        'bi bi-wallet' => 'Wallet',
        'bi bi-wallet-fill' => 'Wallet Fill',
        'bi bi-wallet2' => 'Wallet 2',
        'bi bi-piggy-bank' => 'Piggy Bank',
        'bi bi-piggy-bank-fill' => 'Piggy Bank Fill',
        'bi bi-graph-up' => 'Graph Up',
        'bi bi-graph-up-arrow' => 'Growth',
        'bi bi-graph-down' => 'Graph Down',
        'bi bi-graph-down-arrow' => 'Decline',
        'bi bi-bar-chart' => 'Bar Chart',
        'bi bi-bar-chart-fill' => 'Bar Chart Fill',
        'bi bi-bar-chart-line' => 'Chart Line',
        'bi bi-bar-chart-steps' => 'Chart Steps',
        'bi bi-pie-chart' => 'Pie Chart',
        'bi bi-pie-chart-fill' => 'Pie Chart Fill',
        'bi bi-diagram-3' => 'Diagram',
        'bi bi-diagram-3-fill' => 'Diagram Fill',

        // ============================================================
        // PEOPLE & TEAM
        // ============================================================
        'bi bi-person' => 'Person',
        'bi bi-person-fill' => 'Person Fill',
        'bi bi-person-check' => 'Person Check',
        'bi bi-person-plus' => 'Person Plus',
        'bi bi-person-x' => 'Person Remove',
        'bi bi-person-gear' => 'Person Gear',
        'bi bi-people' => 'People',
        'bi bi-people-fill' => 'People Fill',
        'bi bi-person-badge' => 'Badge',
        'bi bi-person-badge-fill' => 'Badge Fill',
        'bi bi-person-workspace' => 'Workspace',
        'bi bi-file-person' => 'File Person',
        'bi bi-file-earmark-person' => 'Earmark Person',

        // ============================================================
        // DOCUMENTS & FILES
        // ============================================================
        'bi bi-file-earmark-text' => 'Document',
        'bi bi-file-earmark-check' => 'File Check',
        'bi bi-file-earmark-pdf' => 'PDF File',
        'bi bi-file-earmark-word' => 'Word File',
        'bi bi-file-earmark-excel' => 'Excel File',
        'bi bi-file-earmark-ppt' => 'PowerPoint',
        'bi bi-file-earmark-image' => 'Image File',
        'bi bi-file-earmark-zip' => 'ZIP File',
        'bi bi-files' => 'Files',
        'bi bi-files-alt' => 'Files Alt',
        'bi bi-folder' => 'Folder',
        'bi bi-folder-fill' => 'Folder Fill',
        'bi bi-folder-check' => 'Folder Check',
        'bi bi-folder-plus' => 'Folder Plus',
        'bi bi-folder-symlink' => 'Folder Link',
        'bi bi-printer' => 'Printer',
        'bi bi-printer-fill' => 'Printer Fill',

        // ============================================================
        // COMMUNICATION
        // ============================================================
        'bi bi-chat' => 'Chat',
        'bi bi-chat-fill' => 'Chat Fill',
        'bi bi-chat-dots' => 'Chat Dots',
        'bi bi-chat-dots-fill' => 'Chat Dots Fill',
        'bi bi-chat-quote' => 'Quote',
        'bi bi-chat-quote-fill' => 'Quote Fill',
        'bi bi-chat-text' => 'Chat Text',
        'bi bi-chat-text-fill' => 'Chat Text Fill',
        'bi bi-chat-square' => 'Chat Square',
        'bi bi-chat-square-text' => 'Chat Square Text',
        'bi bi-chat-square-quote' => 'Chat Square Quote',
        'bi bi-chat-heart' => 'Chat Heart',
        'bi bi-chat-heart-fill' => 'Chat Heart Fill',
        'bi bi-chat-left' => 'Chat Left',
        'bi bi-chat-left-text' => 'Left Text',
        'bi bi-chat-right' => 'Chat Right',
        'bi bi-chat-right-text' => 'Right Text',
        'bi bi-wechat' => 'WeChat',
        'bi bi-whatsapp' => 'WhatsApp',
        'bi bi-messenger' => 'Messenger',
        'bi bi-telegram' => 'Telegram',
        'bi bi-share' => 'Share',
        'bi bi-share-fill' => 'Share Fill',
        'bi bi-send' => 'Send',
        'bi bi-send-fill' => 'Send Fill',
        'bi bi-send-check' => 'Send Check',
        'bi bi-send-exclamation' => 'Send Alert',
        'bi bi-send-x' => 'Send Cancel',

        // ============================================================
        // TIME & CALENDAR
        // ============================================================
        'bi bi-clock' => 'Clock',
        'bi bi-clock-fill' => 'Clock Fill',
        'bi bi-clock-history' => 'History',
        'bi bi-alarm' => 'Alarm',
        'bi bi-stopwatch' => 'Stopwatch',
        'bi bi-hourglass' => 'Hourglass',
        'bi bi-hourglass-top' => 'Hourglass Top',
        'bi bi-hourglass-bottom' => 'Hourglass Bottom',
        'bi bi-hourglass-split' => 'Hourglass Split',
        'bi bi-calendar' => 'Calendar',
        'bi bi-calendar-fill' => 'Calendar Fill',
        'bi bi-calendar-check' => 'Calendar Check',
        'bi bi-calendar-date' => 'Calendar Date',
        'bi bi-calendar-event' => 'Calendar Event',
        'bi bi-calendar-plus' => 'Calendar Plus',
        'bi bi-calendar-minus' => 'Calendar Minus',
        'bi bi-calendar-x' => 'Calendar Cancel',
        'bi bi-calendar-week' => 'Calendar Week',
        'bi bi-calendar-month' => 'Calendar Month',
        'bi bi-calendar-range' => 'Calendar Range',
        'bi bi-calendar-heart' => 'Calendar Heart',

        // ============================================================
        // MISC USEFUL ICONS
        // ============================================================
        'bi bi-award' => 'Award',
        'bi bi-badge-3d' => '3D',
        'bi bi-badge-4k' => '4K',
        'bi bi-badge-ar' => 'AR',
        'bi bi-badge-vr' => 'VR',
        'bi bi-badge-hd' => 'HD',
        'bi bi-badge-sd' => 'SD',
        'bi bi-badge-tm' => 'Trademark',
        'bi bi-badge-cc' => 'CC',
        'bi bi-badge-wc' => 'WC',
        'bi bi-badge-ad' => 'Ad',
        'bi bi-bag' => 'Bag',
        'bi bi-bag-fill' => 'Bag Fill',
        'bi bi-bag-check' => 'Bag Check',
        'bi bi-bag-plus' => 'Bag Plus',
        'bi bi-bag-x' => 'Bag Remove',
        'bi bi-bag-heart' => 'Bag Heart',
        'bi bi-basket' => 'Basket',
        'bi bi-basket-fill' => 'Basket Fill',
        'bi bi-basket2' => 'Basket 2',
        'bi bi-basket2-fill' => 'Basket 2 Fill',
        'bi bi-basket3' => 'Basket 3',
        'bi bi-basket3-fill' => 'Basket 3 Fill',
        'bi bi-cart' => 'Cart',
        'bi bi-cart-fill' => 'Cart Fill',
        'bi bi-cart-plus' => 'Cart Plus',
        'bi bi-cart-x' => 'Cart Remove',
        'bi bi-cart-check' => 'Cart Check',
        'bi bi-cart-dash' => 'Cart Dash',
        'bi bi-tag' => 'Tag',
        'bi bi-tag-fill' => 'Tag Fill',
        'bi bi-tags' => 'Tags',
        'bi bi-tags-fill' => 'Tags Fill',
        'bi bi-bookmark' => 'Bookmark',
        'bi bi-bookmark-fill' => 'Bookmark Fill',
        'bi bi-bookmark-check' => 'Bookmark Check',
        'bi bi-bookmark-plus' => 'Bookmark Plus',
        'bi bi-bookmark-x' => 'Bookmark Remove',
        'bi bi-bookmark-heart' => 'Bookmark Heart',
        'bi bi-bookmark-star' => 'Bookmark Star',
        'bi bi-heart' => 'Heart',
        'bi bi-heart-fill' => 'Heart Fill',
        'bi bi-heart-half' => 'Heart Half',
        'bi bi-heart-arrow' => 'Heart Arrow',
        'bi bi-heart-pulse' => 'Heart Pulse',
        'bi bi-heartbreak' => 'Heartbreak',
        'bi bi-rocket' => 'Rocket',
        'bi bi-rocket-fill' => 'Rocket Fill',
        'bi bi-rocket-takeoff' => 'Rocket Launch',
        'bi bi-rocket-takeoff-fill' => 'Rocket Launch Fill',
        'bi bi-train-freight-front' => 'Train',
        'bi bi-train-front' => 'Train Front',
        'bi bi-train-lightrail-front' => 'Light Rail',
        'bi bi-truck' => 'Truck',
        'bi bi-truck-front' => 'Truck Front',
        'bi bi-airplane' => 'Airplane',
        'bi bi-airplane-fill' => 'Airplane Fill',
        'bi bi-airplane-engines' => 'Airplane Engines',
    ];

    public function mount($serviceId = null)
    {
        if ($serviceId) {
            $service = $serviceId instanceof Service ? $serviceId : Service::find($serviceId);
            
            if ($service) {
                $this->serviceId = $service->id;
                $this->isEditing = true;
                
                foreach (['os_name','os_slug','os_icon','os_description','os_short_description','meta_title','meta_description','meta_keywords','sort_order','is_active','is_featured'] as $field) {
                    if (isset($service->$field)) $this->$field = $service->$field;
                }
                
                // Existing paths save kar rahe hain taake update par purani file automatic remove ho sake
                $this->existing_os_image = $service->os_image;
                $this->existing_os_banner = $service->os_banner;

                // Previews load karne ka safe tarika (bina static URLs ke)
                if ($this->existing_os_image) {
                    $this->imagePreview = $service->image_url;
                }
                if ($this->existing_os_banner) {
                    $this->bannerPreview = $service->banner_url;
                }
                
            }
        }
    }

    // ============================================
    // CKEDITOR LISTENER - THIS IS THE KEY FIX
    // ============================================
    #[On('ckeditor-value-updated')]
    public function handleCkEditorUpdate($value, $field)
    {
        $fieldMap = [
            'os_description' => 'os_description',
        ];

        if (isset($fieldMap[$field]) && property_exists($this, $fieldMap[$field])) {
            $this->{$fieldMap[$field]} = $value;
        }
    }

    public function updatedOsName()
    {
        if (!$this->isEditing || empty($this->os_slug)) {
            $this->os_slug = Str::slug($this->os_name);
        }
    }

    public function generateSlug() { $this->os_slug = Str::slug($this->os_name); }

    public function updatedOsImage()
    {
        $this->validateOnly('os_image', ['os_image' => 'image|max:5120']);
        try { $this->imagePreview = $this->os_image->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function updatedOsBanner()
    {
        $this->validateOnly('os_banner', ['os_banner' => 'image|max:5120']);
        try { $this->bannerPreview = $this->os_banner->temporaryUrl(); } catch (\Exception $e) {}
    }

    public function removeImage() 
    { 
        $this->os_image = null; 
        $this->imagePreview = null; 
    }
    
    public function removeBanner() 
    { 
        $this->os_banner = null; 
        $this->bannerPreview = null; 
    }

    public function save()
    {
        $rules = ['os_name' => 'required|string|max:255'];
        if ($this->os_image) $rules['os_image'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        if ($this->os_banner) $rules['os_banner'] = 'image|mimes:jpeg,png,jpg,webp|max:5120';
        
        $this->validate($rules);
        $this->isSaving = true;
        
        try {
            $service = $this->isEditing ? Service::findOrFail($this->serviceId) : new Service();
            
            foreach (['os_name','os_slug','os_icon','os_description','os_short_description','meta_title','meta_description','meta_keywords'] as $field) {
                if (property_exists($this, $field)) $service->$field = $this->$field ?: null;
            }
            
            $service->sort_order = (int) ($this->sort_order ?? 0);
            $service->is_active = (bool) $this->is_active;
            $service->is_featured = (bool) $this->is_featured;
            
            // 1. Main Image (Create aur Update dono is single line se handle honge)
            if ($this->os_image) {
                $service->os_image = $this->uploadFile($this->os_image, 'services', $this->existing_os_image);
            }
            
            // 2. Banner Image (Auto-delete aur path generation automated)
            if ($this->os_banner) {
                $service->os_banner = $this->uploadFile($this->os_banner, 'services/banners', $this->existing_os_banner);
            }
            
            $service->save();
            $this->isSaving = false;
            
            $message = $this->isEditing ? 'Service updated successfully!' : 'Service created successfully!';
            $this->dispatch('toast', type: 'success', title: 'Success!', message: $message);
            $this->dispatch($this->isEditing ? 'service-updated' : 'service-created');
            
            return redirect()->route('admin.services.index');
            
        } catch (\Exception $e) {
            $this->isSaving = false;
            Log::error('Service save error: ' . $e->getMessage());
            $this->dispatch('toast', type: 'error', title: 'Error!', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.services.service-form');
    }
}