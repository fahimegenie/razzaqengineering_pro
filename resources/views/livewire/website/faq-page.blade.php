@php
    $settings = App\Models\Setting::getCached();
    $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
    $primaryPhoneFormatted = $settings->mobile_phone_1 ?? '+92 304 8902805';
    $showQuoteForm = $settings->enable_quote_form ?? true;
    $siteName = $settings->site_name ?? 'Razzaq Engineering Services';
@endphp

<div class="faq-page-wrapper">
    
    <!-- ============================================
         HERO SECTION
         ============================================ -->
    <section class="faq-hero">
        <div class="container faq-hero-content">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="faq-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">FAQ</li>
                        </ol>
                    </nav>
                    <h1 class="faq-hero-title">Frequently Asked Questions</h1>
                    <p class="faq-hero-subtitle">
                        {{ $settings->site_tagline ?? 'Find answers to common questions about our services' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         FAQ CONTENT
         ============================================ -->
    <section class="faq-section"
             x-data="{
                search: '',
                activeCategory: 'all',
                activeQuestion: null,
                
                toggle(id) {
                    this.activeQuestion = (this.activeQuestion === id) ? null : id;
                },
                
                filterCategory(cat) {
                    this.activeCategory = cat;
                    this.activeQuestion = null;
                    $wire.filterByCategory(cat);
                },
                
                matchesSearch(faq) {
                    if (!this.search) return true;
                    const term = this.search.toLowerCase();
                    const question = (faq.faq_question || '').toLowerCase();
                    // Strip HTML tags for answer search
                    const answer = (faq.faq_answer || '').replace(/<[^>]*>/g, '').toLowerCase();
                    const category = (faq.faq_category || '').toLowerCase();
                    return question.includes(term) || answer.includes(term) || category.includes(term);
                },
                
                matchesCategory(faq) {
                    if (this.activeCategory === 'all') return true;
                    return (faq.faq_category || '') === this.activeCategory;
                },
                
                // Count visible FAQs
                getVisibleCount() {
                    const list = this.$refs.faqList;
                    if (!list) return 0;
                    const items = list.querySelectorAll('.faq-item');
                    let count = 0;
                    items.forEach(item => {
                        if (item.style.display !== 'none') count++;
                    });
                    return count;
                }
             }">
        <div class="container">
            
            {{-- Loading State --}}
            @if($isLoading)
                <div class="text-center py-5">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2">Loading FAQs...</p>
                </div>
            @else
                
                {{-- Search Bar - Alpine.js controlled, NO Livewire --}}
                <div class="row justify-content-center mb-4" data-aos="fade-up">
                    <div class="col-lg-6">
                        <div class="faq-search-wrap position-relative">
                            <i class="fas fa-search faq-search-icon"></i>
                            <input type="text" 
                                   class="faq-search-input"
                                   x-model="search"
                                   @input="activeQuestion = null"
                                   placeholder="Search your question...">
                            <button class="faq-search-clear" 
                                    x-show="search"
                                    @click="search = ''; activeQuestion = null"
                                    aria-label="Clear search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Categories Filter --}}
                @if(count($categories) > 0)
                    <div class="faq-categories justify-content-center mb-4" data-aos="fade-up">
                        <button class="faq-cat-btn" 
                                :class="{ 'active': activeCategory === 'all' }"
                                @click="filterCategory('all')">
                            <i class="fas fa-list me-1"></i> All Questions
                        </button>
                        @foreach($categories as $cat)
                            <button class="faq-cat-btn" 
                                    :class="{ 'active': activeCategory === '{{ $cat }}' }"
                                    @click="filterCategory('{{ $cat }}')">
                                <i class="fas fa-folder me-1"></i> {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                @endif
                
                {{-- FAQ List --}}
                <div class="row justify-content-center" data-aos="fade-up">
                    <div class="col-lg-9">
                        
                        @if(!empty($faqs) && count($faqs) > 0)
                            {{-- Results Count --}}
                            <p class="text-muted small mb-3" 
                               x-show="search || activeCategory !== 'all'"
                               x-cloak>
                                <span x-text="getVisibleCount()"></span> 
                                question(s) found
                            </p>
                            
                            <div x-ref="faqList">
                                @foreach($faqs as $faq)
                                    <div class="faq-item"
                                         x-show="matchesSearch(@js($faq->toArray())) && matchesCategory(@js($faq->toArray()))"
                                         :class="{ 'faq-item-active': activeQuestion === {{ $faq->id }} }">
                                        
                                        {{-- Question Header --}}
                                        <div class="faq-question" 
                                             @click="toggle({{ $faq->id }})"
                                             role="button"
                                             tabindex="0"
                                             aria-expanded="false"
                                             :aria-expanded="activeQuestion === {{ $faq->id }}">
                                            <span class="faq-q-icon">Q</span>
                                            <span class="faq-q-text">{{ $faq->faq_question }}</span>
                                            @if($faq->faq_category)
                                                <span class="badge bg-info d-none d-md-inline-block ms-2" style="font-size: 0.7rem;">
                                                    {{ $faq->faq_category }}
                                                </span>
                                            @endif
                                            <i class="fas fa-chevron-down faq-arrow" 
                                               :class="{ 'rotated': activeQuestion === {{ $faq->id }} }"></i>
                                        </div>
                                        
                                        {{-- Answer Body - Renders CKEditor HTML --}}
                                        <div class="faq-answer" 
                                             x-show="activeQuestion === {{ $faq->id }}"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                                             x-transition:enter-end="opacity-100 transform translate-y-0"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0">
                                            <div class="faq-answer-content">
                                                {{-- Render HTML content from CKEditor --}}
                                                {!! $faq->faq_answer !!}
                                            </div>
                                        </div>
                                        
                                    </div>
                                @endforeach
                            </div>
                            
                            {{-- No Results Found --}}
                            <div class="text-center py-5" 
                                 x-show="getVisibleCount() === 0"
                                 x-cloak>
                                <i class="fas fa-search fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Questions Found</h5>
                                <p class="text-muted">Try different keywords or browse all questions.</p>
                                <button class="btn btn-outline-success rounded-pill px-4" 
                                        @click="search = ''; filterCategory('all')">
                                    <i class="fas fa-redo me-2"></i> Show All Questions
                                </button>
                            </div>
                        @else
                            {{-- Empty State --}}
                            <div class="text-center py-5">
                                <i class="fas fa-question-circle fa-3x text-muted opacity-25 mb-3"></i>
                                <h4 class="fw-bold">No FAQs Available</h4>
                                <p class="text-muted">Please check back later for frequently asked questions.</p>
                            </div>
                        @endif
                        
                    </div>
                </div>
                
            @endif
            
            {{-- CTA Section - Dynamic from Settings --}}
            <div class="row justify-content-center mt-5" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="faq-cta">
                        <h4><i class="fas fa-headset me-2"></i> Still Have Questions?</h4>
                        <p>Can't find what you're looking for? Our team is ready to help you.</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            @if($showQuoteForm)
                            <a href="{{ route('quote.index') }}" class="btn-faq-cta">
                                <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                            </a>
                            @endif
                            <a href="tel:{{ $primaryPhone }}" class="btn-faq-cta">
                                <i class="fas fa-phone-alt me-2"></i> {{ $primaryPhoneFormatted }}
                            </a>
                            @php
                                $whatsappNumber = $settings->whatsapp_number_2 ?? $settings->mobile_phone_1 ?? '+923048902805';
                                $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
                            @endphp
                            @if($whatsappClean)
                            <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="btn-faq-cta" style="background:#25D366; color:#fff;">
                                <i class="fab fa-whatsapp me-2"></i> WhatsApp Chat
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

</div>

@push('styles')
<style>
    /* ============================================
       FAQ PAGE STYLES
       ============================================ */
    .faq-page-wrapper {
        background: #f8f9fa;
    }
    
    /* Hero Section */
    .faq-hero {
        position: relative;
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .faq-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }
    
    .faq-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.02);
        border-radius: 50%;
    }
    
    .faq-hero-content { 
        position: relative; 
        z-index: 1; 
        padding: 40px 0;
    }
    
    .faq-breadcrumb {
        display: flex; 
        gap: 8px; 
        list-style: none; 
        padding: 0; 
        margin: 0 0 15px;
        flex-wrap: wrap;
    }
    
    .faq-breadcrumb li { 
        color: rgba(255,255,255,0.7); 
        font-size: 0.85rem; 
    }
    
    .faq-breadcrumb li a { 
        color: #fff; 
        text-decoration: none; 
        transition: color 0.3s ease;
    }
    
    .faq-breadcrumb li a:hover { 
        color: #48c964; 
    }
    
    .faq-breadcrumb li:not(:last-child)::after { 
        content: '/'; 
        margin-left: 8px; 
        color: rgba(255,255,255,0.4); 
    }
    
    .faq-breadcrumb li.active {
        color: #48c964;
    }
    
    .faq-hero-title { 
        color: #fff; 
        font-size: 2.5rem; 
        font-weight: 800; 
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .faq-hero-subtitle { 
        color: rgba(255,255,255,0.85); 
        font-size: 1.1rem; 
        margin-top: 10px;
    }

    /* FAQ Section */
    .faq-section { 
        padding: 60px 0 80px;
    }

    /* Search */
    .faq-search-wrap { 
        position: relative; 
    }
    
    .faq-search-input {
        width: 100%; 
        padding: 15px 50px 15px 50px;
        border: 2px solid #e9ecef; 
        border-radius: 50px;
        font-size: 0.95rem; 
        background: #fff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    
    .faq-search-input:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.1);
        outline: none;
    }
    
    .faq-search-icon { 
        position: absolute; 
        left: 20px; 
        top: 50%; 
        transform: translateY(-50%); 
        color: #aaa;
        font-size: 1rem;
    }
    
    .faq-search-clear {
        position: absolute; 
        right: 15px; 
        top: 50%; 
        transform: translateY(-50%);
        background: #eee; 
        border: none; 
        width: 28px; 
        height: 28px; 
        border-radius: 50%;
        cursor: pointer; 
        color: #888; 
        font-size: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .faq-search-clear:hover { 
        background: #dc3545; 
        color: #fff; 
    }

    /* Categories */
    .faq-categories { 
        display: flex; 
        flex-wrap: wrap; 
        gap: 8px; 
        margin-bottom: 25px; 
    }
    
    .faq-cat-btn {
        padding: 8px 20px; 
        border: 2px solid #e9ecef; 
        background: #fff;
        border-radius: 50px; 
        font-size: 0.82rem; 
        font-weight: 600;
        color: #555; 
        cursor: pointer; 
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .faq-cat-btn:hover { 
        border-color: #28a745; 
        color: #28a745; 
        background: #f0faf3; 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40,167,69,0.1);
    }
    
    .faq-cat-btn.active { 
        background: #28a745; 
        color: #fff; 
        border-color: #28a745;
        box-shadow: 0 4px 15px rgba(40,167,69,0.2);
    }

    /* FAQ Items */
    .faq-item {
        background: #fff; 
        border: 1px solid #eef0f2; 
        border-radius: 12px;
        margin-bottom: 12px; 
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    
    .faq-item:hover { 
        box-shadow: 0 5px 20px rgba(0,0,0,0.06); 
    }
    
    .faq-item-active { 
        border-color: #28a745; 
        box-shadow: 0 5px 25px rgba(40,167,69,0.1) !important; 
    }

    .faq-question {
        padding: 18px 22px; 
        display: flex; 
        align-items: center; 
        gap: 12px;
        cursor: pointer; 
        font-weight: 600; 
        font-size: 0.95rem;
        color: #0a1628; 
        transition: all 0.3s ease; 
        user-select: none;
    }
    
    .faq-question:hover { 
        color: #0056b3; 
    }
    
    .faq-item-active .faq-question { 
        background: linear-gradient(135deg, rgba(40,167,69,0.03), rgba(0,86,179,0.03)); 
        color: #0056b3; 
    }

    .faq-q-icon {
        width: 36px; 
        height: 36px; 
        min-width: 36px;
        background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 14px; 
        color: #28a745; 
        font-weight: 700; 
        transition: all 0.3s ease;
    }
    
    .faq-item-active .faq-q-icon { 
        background: linear-gradient(135deg, #0056b3, #28a745); 
        color: #fff; 
    }

    .faq-q-text { 
        flex: 1; 
    }
    
    .faq-arrow { 
        font-size: 14px; 
        color: #aaa; 
        transition: transform 0.3s ease;
        min-width: 14px;
    }
    
    .faq-arrow.rotated { 
        transform: rotate(180deg); 
        color: #28a745;
    }
    
    /* Answer Content - Supports CKEditor HTML */
    .faq-answer-content { 
        padding: 0 22px 20px 70px; 
        font-size: 0.95rem; 
        color: #555; 
        line-height: 1.9;
    }
    
    /* CKEditor Content Styling */
    .faq-answer-content h2,
    .faq-answer-content h3,
    .faq-answer-content h4 {
        color: #0a1628;
        margin-top: 15px;
        margin-bottom: 10px;
        font-weight: 700;
    }
    
    .faq-answer-content h2 { font-size: 1.3rem; }
    .faq-answer-content h3 { font-size: 1.1rem; }
    .faq-answer-content h4 { font-size: 1rem; }
    
    .faq-answer-content p {
        margin-bottom: 12px;
    }
    
    .faq-answer-content ul,
    .faq-answer-content ol {
        padding-left: 20px;
        margin-bottom: 12px;
    }
    
    .faq-answer-content li {
        margin-bottom: 5px;
    }
    
    .faq-answer-content strong {
        color: #0a1628;
    }
    
    .faq-answer-content blockquote {
        border-left: 4px solid #28a745;
        padding: 10px 15px;
        margin: 15px 0;
        background: rgba(40,167,69,0.05);
        border-radius: 0 8px 8px 0;
        color: #666;
    }
    
    .faq-answer-content a {
        color: #0056b3;
        text-decoration: underline;
    }
    
    .faq-answer-content a:hover {
        color: #28a745;
    }
    
    .faq-answer-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 10px 0;
    }
    
    .faq-answer-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }
    
    .faq-answer-content table td,
    .faq-answer-content table th {
        border: 1px solid #dee2e6;
        padding: 8px 12px;
    }
    
    .faq-answer-content table th {
        background: #f8f9fa;
        font-weight: 600;
    }

    /* CTA Section */
    .faq-cta {
        padding: 40px 35px; 
        background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 20px; 
        color: #fff; 
        text-align: center;
        box-shadow: 0 15px 40px rgba(0,86,179,0.2);
    }
    
    .faq-cta h4 { 
        color: #fff; 
        font-weight: 700; 
        margin-bottom: 10px;
        font-size: 1.5rem;
    }
    
    .faq-cta p { 
        color: rgba(255,255,255,0.85); 
        margin-bottom: 20px; 
        font-size: 1rem;
    }
    
    .btn-faq-cta {
        display: inline-flex; 
        align-items: center; 
        padding: 13px 30px;
        background: #fff; 
        color: #0056b3; 
        text-decoration: none;
        border-radius: 10px; 
        font-weight: 700; 
        font-size: 0.9rem; 
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .btn-faq-cta:hover { 
        background: #28a745; 
        color: #fff; 
        transform: translateY(-3px); 
        box-shadow: 0 8px 25px rgba(40,167,69,0.3);
    }

    /* Alpine.js Cloak */
    [x-cloak] { display: none !important; }

    /* ============================================
       RESPONSIVE STYLES
       ============================================ */
    @media (max-width: 1199.98px) {
        .faq-hero-title { font-size: 2.2rem; }
        .faq-cta { padding: 30px 25px; }
    }
    
    @media (max-width: 991.98px) {
        .faq-section { padding: 40px 0 60px; }
        .faq-hero { min-height: 200px; }
        .faq-hero-title { font-size: 2rem; }
        .faq-answer-content { padding-left: 20px; }
        .faq-answer-content { font-size: 0.9rem; }
    }
    
    @media (max-width: 767.98px) {
        .faq-section { padding: 30px 0 45px; }
        .faq-hero { min-height: 180px; }
        .faq-hero-title { font-size: 1.6rem; }
        .faq-hero-subtitle { font-size: 0.9rem; }
        .faq-question { 
            font-size: 0.88rem; 
            padding: 14px 16px; 
            gap: 10px;
        }
        .faq-answer-content { 
            padding: 0 16px 16px; 
            font-size: 0.87rem; 
        }
        .faq-cat-btn { 
            font-size: 0.75rem; 
            padding: 6px 14px; 
        }
        .faq-cta { 
            padding: 25px 20px; 
            border-radius: 16px;
        }
        .faq-cta h4 { font-size: 1.2rem; }
        .faq-q-icon {
            width: 30px;
            height: 30px;
            min-width: 30px;
            font-size: 12px;
        }
        .faq-search-input {
            padding: 12px 45px 12px 45px;
            font-size: 0.88rem;
        }
        .btn-faq-cta {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 575.98px) {
        .faq-section { padding: 25px 0 35px; }
        .faq-hero { min-height: 160px; }
        .faq-hero-content { padding: 25px 0; }
        .faq-hero-title { font-size: 1.3rem; }
        .faq-hero-subtitle { font-size: 0.8rem; }
        .faq-breadcrumb { margin-bottom: 8px; }
        .faq-breadcrumb li { font-size: 0.7rem; }
        .faq-question { 
            font-size: 0.82rem; 
            padding: 12px 14px; 
        }
        .faq-answer-content { 
            padding: 0 14px 14px; 
            font-size: 0.82rem;
            line-height: 1.7;
        }
        .faq-cta { 
            padding: 20px 15px; 
            border-radius: 12px;
        }
        .faq-cta h4 { font-size: 1.1rem; }
        .faq-cta p { font-size: 0.85rem; }
        .faq-categories { gap: 5px; }
        .faq-cat-btn { 
            font-size: 0.7rem; 
            padding: 5px 12px; 
        }
        .faq-search-input {
            padding: 10px 40px 10px 40px;
            font-size: 0.82rem;
        }
    }
    
    @media (max-width: 400px) {
        .faq-hero-title { font-size: 1.15rem; }
        .faq-question { font-size: 0.78rem; }
        .faq-answer-content { font-size: 0.78rem; }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize AOS after Livewire updates
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.updated', () => {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    });
</script>
@endpush