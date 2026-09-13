<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\FleetItem;
use App\Models\FleetCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app-layout')]
#[Title('Fleet Details - Razzaq Engineering Services')]
class FleetDetailPage extends Component
{
    public ?FleetItem $fleetItem = null;
    public ?string $slug = null;
    public bool $isLoading = true;
    public ?string $errorMessage = null;
    public array $galleryImages = [];
    public ?int $activeGalleryImage = null;
    public $relatedFleetItems;

    // Cache durations
    private const CACHE_FLEET_ITEM = 3600;  // 1 hour
    private const CACHE_RELATED = 1800;     // 30 minutes

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->loadFleetItem();
    }

    /**
     * Load fleet item with all relationships
     */
    private function loadFleetItem(): void
    {
        $this->isLoading = true;
        $this->errorMessage = null;

        try {
            // Debug: Log the slug being searched
            Log::info('FleetDetailPage: Loading fleet item', ['slug' => $this->slug]);

            // Try WITHOUT cache first to debug
            $this->fleetItem = FleetItem::where('slug', $this->slug)
                ->where('is_active', true)
                ->with([
                    'category',
                    'media' => function ($query) {
                        $query->orderBy('sort_order');
                    },
                    'primaryMedia'
                ])
                ->first();

            // Debug: Log the result
            Log::info('FleetDetailPage: Query result', [
                'found' => $this->fleetItem ? 'yes' : 'no',
                'slug' => $this->slug
            ]);

            if (!$this->fleetItem) {
                // Try to find by ID as fallback
                if (is_numeric($this->slug)) {
                    $this->fleetItem = FleetItem::where('id', $this->slug)
                        ->where('is_active', true)
                        ->with(['category', 'media', 'primaryMedia'])
                        ->first();
                    
                    Log::info('FleetDetailPage: Fallback ID search', [
                        'found' => $this->fleetItem ? 'yes' : 'no'
                    ]);
                }

                if (!$this->fleetItem) {
                    // List all active fleet items for debugging
                    $allActive = FleetItem::where('is_active', true)
                        ->select('id', 'title', 'slug', 'is_active')
                        ->get();
                    
                    Log::info('FleetDetailPage: All active fleet items', [
                        'count' => $allActive->count(),
                        'items' => $allActive->toArray()
                    ]);

                    $this->errorMessage = 'Fleet item not found or is no longer available.';
                    $this->isLoading = false;
                    return;
                }
            }

            // Load gallery images
            $this->loadGalleryImages();

            // Load related fleet items
            $this->loadRelatedFleetItems();

            // Update page title dynamically
            $this->dispatch('update-page-title', title: $this->fleetItem->title . ' - Razzaq Engineering Services');

        } catch (\Exception $e) {
            $this->errorMessage = 'Unable to load fleet details. Please try again later.';
            Log::error('FleetDetailPage Error: ' . $e->getMessage(), [
                'slug' => $this->slug,
                'trace' => $e->getTraceAsString()
            ]);
        }

        $this->isLoading = false;
    }

    /**
     * Load gallery images from media relationship
     */
    private function loadGalleryImages(): void
    {
        $this->galleryImages = [];

        if ($this->fleetItem && $this->fleetItem->media && $this->fleetItem->media->count() > 0) {
            $this->galleryImages = $this->fleetItem->media
                ->where('file_type', 'image')
                ->pluck('file_path')
                ->toArray();
        }

        // If no gallery images from media, check if there's a main image
        if (empty($this->galleryImages) && $this->fleetItem) {
            if ($this->fleetItem->image_url && $this->fleetItem->image_url !== asset('images/placeholder-fleet.jpg')) {
                $this->galleryImages = [$this->fleetItem->image_url];
            } elseif ($this->fleetItem->image) {
                $this->galleryImages = [asset($this->fleetItem->image)];
            }
        }
    }

    /**
     * Load related fleet items (same category or featured)
     */
    private function loadRelatedFleetItems(): void
    {
        if (!$this->fleetItem) return;

        try {
            $query = FleetItem::where('is_active', true)
                ->with(['category', 'primaryMedia'])
                ->where('id', '!=', $this->fleetItem->id);

            // First try to get items from same category
            if ($this->fleetItem->fleet_category_id) {
                $query->where('fleet_category_id', $this->fleetItem->fleet_category_id);
            }

            $items = $query->orderBy('sort_order')->take(4)->get();

            // If not enough items, fill with featured items
            if ($items->count() < 4) {
                $existingIds = $items->pluck('id')->push($this->fleetItem->id)->toArray();
                
                $featuredItems = FleetItem::where('is_active', true)
                    ->where('is_featured', true)
                    ->whereNotIn('id', $existingIds)
                    ->with(['category', 'primaryMedia'])
                    ->orderBy('sort_order')
                    ->take(4 - $items->count())
                    ->get();

                $items = $items->merge($featuredItems);
            }

            // If still not enough, get random items
            if ($items->count() < 4) {
                $existingIds = $items->pluck('id')->push($this->fleetItem->id)->toArray();
                
                $randomItems = FleetItem::where('is_active', true)
                    ->whereNotIn('id', $existingIds)
                    ->with(['category', 'primaryMedia'])
                    ->inRandomOrder()
                    ->take(4 - $items->count())
                    ->get();

                $items = $items->merge($randomItems);
            }

            $this->relatedFleetItems = $items->take(4);

        } catch (\Exception $e) {
            Log::error('FleetDetailPage related items error: ' . $e->getMessage());
            $this->relatedFleetItems = collect();
        }
    }

    /**
     * Open gallery modal
     */
    public function openGallery(int $index): void
    {
        if (empty($this->galleryImages)) return;
        
        $this->activeGalleryImage = max(0, min($index, count($this->galleryImages) - 1));
    }

    /**
     * Close gallery modal
     */
    public function closeGallery(): void
    {
        $this->activeGalleryImage = null;
    }

    /**
     * Navigate to next gallery image
     */
    public function nextGalleryImage(): void
    {
        if (empty($this->galleryImages) || $this->activeGalleryImage === null) return;

        $this->activeGalleryImage = ($this->activeGalleryImage + 1) % count($this->galleryImages);
    }

    /**
     * Navigate to previous gallery image
     */
    public function prevGalleryImage(): void
    {
        if (empty($this->galleryImages) || $this->activeGalleryImage === null) return;

        $this->activeGalleryImage = ($this->activeGalleryImage - 1 + count($this->galleryImages)) % count($this->galleryImages);
    }

    /**
     * Clear cache for this fleet item
     */
    public function clearDetailCache(): void
    {
        Cache::forget('fleet_item_detail_' . $this->slug);
        if ($this->fleetItem) {
            Cache::forget('related_fleet_items_' . $this->fleetItem->id);
        }
        
        $this->dispatch('cache-cleared', message: 'Fleet cache cleared successfully.');
    }

    /**
     * Clear all fleet related caches
     */
    public function flushFleetCache(): void
    {
        try {
            if ($this->slug) {
                Cache::forget('fleet_item_detail_' . $this->slug);
            }

            if ($this->fleetItem?->id) {
                Cache::forget('related_fleet_items_' . $this->fleetItem->id);
            }

            $this->dispatch('cache-cleared', message: 'Fleet cache cleared successfully.');
        } catch (\Exception $e) {
            Log::error('Fleet cache flush error: ' . $e->getMessage());
            $this->dispatch('cache-cleared', message: 'Unable to clear fleet cache.');
        }
    }

    public function render()
    {
        return view('livewire.website.fleet-detail-page', [
            'fleetItem' => $this->fleetItem,
            'galleryImages' => $this->galleryImages,
            'activeGalleryImage' => $this->activeGalleryImage,
            'relatedFleetItems' => $this->relatedFleetItems,
        ]);
    }
}