@php
    $settings = App\Models\Setting::getCached();
    $primaryPhone = $settings->mobile_phone_1 ?? '+923048902805';
    $primaryPhoneFormatted = $settings->mobile_phone_1 ?? '+92 304 8902805';
    $showQuoteForm = $settings->enable_quote_form ?? true;
    $whatsappNumber = $settings->whatsapp_number_2 ?? $settings->mobile_phone_1 ?? '+923048902805';
    $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
@endphp

<div class="faq-page" 
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
            const answer = (faq.faq_answer || '').replace(/<[^>]*>/g, '').toLowerCase();
            const category = (faq.faq_category || '').toLowerCase();
            return question.includes(term) || answer.includes(term) || category.includes(term);
        },
        
        matchesCategory(faq) {
            if (this.activeCategory === 'all') return true;
            return (faq.faq_category || '') === this.activeCategory;
        },
        
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
    
    {{-- ============================================
         STICKY MOBILE CTA
         ============================================ --}}
    <div class="faq-mobile-cta d-lg-none">
        <a href="tel:{{ $primaryPhone }}" class="faq-mobile-btn faq-mobile-call">
            <i class="fas fa-phone-alt"></i> Call
        </a>
        <a href="https://wa.me/{{ $whatsappClean }}" target="_blank" class="faq-mobile-btn faq-mobile-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        @if($showQuoteForm)
        <a href="{{ route('quote.index') }}" class="faq-mobile-btn faq-mobile-quote">
            <i class="fas fa-paper-plane"></i> Free Quote
        </a>
        @endif
    </div>

    {{-- ============================================
         HERO SECTION
         ============================================ --}}
    <section class="faq-hero">
        <div class="faq-hero-bg"></div>
        <div class="faq-hero-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-30">
                <div class="col-lg-8" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="faq-breadcrumb">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                            <li class="active">FAQ</li>
                        </ol>
                    </nav>
                    
                    <div class="faq-hero-badge">
                        <i class="fas fa-question-circle"></i> Help Center
                    </div>
                    
                    <h1 class="faq-hero-title">Frequently Asked Questions</h1>
                    <p class="faq-hero-subtitle">
                        {{ $settings->site_tagline ?? 'Find answers to common questions about our engineering services' }}
                    </p>
                    
                    <div class="faq-hero-stats">
                        <div class="faq-stat-item">
                            <span class="faq-stat-number">{{ count($faqs) }}+</span>
                            <span class="faq-stat-label">Questions</span>
                        </div>
                        {{-- <div class="faq-stat-item">
                            <span class="faq-stat-number">{{ count($categories) }}</span>
                            <span class="faq-stat-label">Categories</span>
                        </div> --}}
                        <div class="faq-stat-item">
                            <span class="faq-stat-number">24/7</span>
                            <span class="faq-stat-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         TRUST BAR
         ============================================ --}}
    <section class="faq-trust-bar">
        <div class="container">
            <div class="faq-trust-grid">
                <div class="faq-trust-card">
                    <div class="faq-trust-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <strong>Instant</strong>
                        <span>Answers</span>
                    </div>
                </div>
                <div class="faq-trust-card">
                    <div class="faq-trust-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <strong>24/7</strong>
                        <span>Available</span>
                    </div>
                </div>
                <div class="faq-trust-card">
                    <div class="faq-trust-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <strong>Trusted</strong>
                        <span>Information</span>
                    </div>
                </div>
                <div class="faq-trust-card">
                    <div class="faq-trust-icon"><i class="fas fa-sync-alt"></i></div>
                    <div>
                        <strong>Regularly</strong>
                        <span>Updated</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MAIN CONTENT
         ============================================ --}}
    <section class="faq-main-section">
        <div class="container">
            
            @if($isLoading)
                <div class="faq-state-box">
                    <div class="spinner-grow text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-3 fw-semibold">Loading FAQs...</p>
                </div>
            @else
                {{-- Search Bar --}}
                <div class="faq-search-wrapper" data-aos="fade-up">
                    <div class="faq-search-inner">
                        <div class="faq-input-wrapper">
                            <i class="fas fa-search faq-input-icon"></i>
                            <input type="text" 
                                   class="faq-form-input"
                                   x-model="search"
                                   @input="activeQuestion = null"
                                   placeholder="Search your question...">
                            <button class="faq-search-clear" 
                                    x-show="search"
                                    @click="search = ''; activeQuestion = null"
                                    title="Clear search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span class="faq-search-count">
                            <strong>{{ count($faqs) }}</strong> questions
                        </span>
                    </div>
                </div>

                {{-- Category Filters --}}
                @if(count($categories) > 0)
                    <div class="faq-filters-wrapper" data-aos="fade-up">
                        <div class="faq-filters-scroll">
                            <button class="faq-filter-pill" 
                                    :class="{ 'active': activeCategory === 'all' }"
                                    @click="filterCategory('all')">
                                <i class="fas fa-list"></i> All
                                <span class="faq-filter-count">{{ count($faqs) }}</span>
                            </button>
                            @foreach($categories as $cat)
                                @php
                                    $catCount = $faqs->where('faq_category', $cat)->count();
                                @endphp
                                <button class="faq-filter-pill" 
                                        :class="{ 'active': activeCategory === '{{ $cat }}' }"
                                        @click="filterCategory('{{ $cat }}')">
                                    {{ $cat }}
                                    <span class="faq-filter-count">{{ $catCount }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- FAQ List --}}
                <div class="faq-list-wrapper" data-aos="fade-up">
                    
                    @if(!empty($faqs) && count($faqs) > 0)
                        <p class="faq-results-text" 
                           x-show="search || activeCategory !== 'all'"
                           x-cloak>
                            <span x-text="getVisibleCount()"></span> question(s) found
                        </p>
                        
                        <div x-ref="faqList">
                            @foreach($faqs as $faq)
                                <div class="faq-item"
                                     x-show="matchesSearch(@js($faq->toArray())) && matchesCategory(@js($faq->toArray()))"
                                     :class="{ 'faq-item-active': activeQuestion === {{ $faq->id }} }">
                                    
                                    <div class="faq-question" 
                                         @click="toggle({{ $faq->id }})"
                                         role="button"
                                         tabindex="0"
                                         :aria-expanded="activeQuestion === {{ $faq->id }}">
                                        <span class="faq-q-badge">Q</span>
                                        <span class="faq-q-text">{{ $faq->faq_question }}</span>
                                        @if($faq->faq_category)
                                            <span class="faq-category-tag d-none d-md-inline-flex">
                                                {{ $faq->faq_category }}
                                            </span>
                                        @endif
                                        <i class="fas fa-chevron-down faq-chevron" 
                                           :class="{ 'rotate': activeQuestion === {{ $faq->id }} }"></i>
                                    </div>
                                    
                                    <div class="faq-answer" 
                                         x-show="activeQuestion === {{ $faq->id }}"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                                         x-transition:enter-end="opacity-100 transform translate-y-0">
                                        <div class="faq-answer-inner">
                                            <div class="faq-a-badge">A</div>
                                            <div class="faq-answer-content">
                                                {!! $faq->faq_answer !!}
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- No Results --}}
                        <div class="faq-empty-state" 
                             x-show="getVisibleCount() === 0"
                             x-cloak>
                            <div class="faq-empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>No Questions Found</h3>
                            <p>Try different keywords or browse all questions.</p>
                            <button class="btn btn-outline-primary mt-2" 
                                    @click="search = ''; filterCategory('all')">
                                <i class="fas fa-redo me-2"></i> Show All Questions
                            </button>
                        </div>
                    @else
                        <div class="faq-empty-state">
                            <div class="faq-empty-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h3>No FAQs Available</h3>
                            <p>Please check back later for frequently asked questions.</p>
                        </div>
                    @endif
                    
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================
         CTA SECTION
         ============================================ --}}
    <section class="faq-cta-section">
        <div class="container">
            <div class="faq-cta-card" data-aos="zoom-in">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3><i class="fas fa-headset me-2"></i> Still Have Questions?</h3>
                        <p>Can't find what you're looking for? Our team is ready to help you with any questions about our services.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <div class="faq-cta-buttons">
                            @if($showQuoteForm)
                            <a href="{{ route('quote.index') }}" class="faq-btn faq-btn-accent">
                                <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                            </a>
                            @endif
                            <a href="tel:{{ $primaryPhone }}" class="faq-btn faq-btn-white">
                                <i class="fas fa-phone-alt me-2"></i> {{ $primaryPhoneFormatted }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         FINAL CTA
         ============================================ --}}
    <section class="faq-final-cta">
        <div class="container text-center">
            <h2>Ready to Start Your Project?</h2>
            <p class="mb-4">Get in touch with our experts today for a free consultation and estimate</p>
            <div class="faq-final-cta-buttons">
                <a href="{{ route('quote.index') }}" class="faq-btn faq-btn-lg faq-btn-accent">
                    <i class="fas fa-paper-plane me-2"></i> Get Free Quote
                </a>
                <a href="tel:{{ $primaryPhone }}" class="faq-btn faq-btn-lg faq-btn-white-outline-dark">
                    <i class="fas fa-phone-alt me-2"></i> Call Now
                </a>
            </div>
        </div>
    </section>

</div>


<style>
/* ============================================
   FAQ PAGE - ENTERPRISE GRADE DESIGN
   Laravel 13 + Livewire 4 + Alpine.js
   ============================================ */

[x-cloak] { display: none !important; }

/* --- Mobile Sticky CTA --- */
.faq-mobile-cta {
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 998;
    display: flex; background: #fff; box-shadow: 0 -4px 20px rgba(0,0,0,0.12);
}

.faq-mobile-btn {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 12px 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none;
    border: none; cursor: pointer; transition: all 0.2s;
}

.faq-mobile-call { background: #f8f9fa; color: #0a1628; }
.faq-mobile-whatsapp { background: #25D366; color: #fff; }
.faq-mobile-quote { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

/* --- Hero Section --- */
.faq-hero {
    position: relative; padding: 90px 0 70px; overflow: hidden;
    min-height: 420px; display: flex; align-items: center;
}

.faq-hero-bg {
    position: absolute; inset: 0;
    background: url('{{ asset("images/faq-hero-bg.jpg") }}') center/cover no-repeat;
    filter: brightness(0.3);
}

.faq-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,61,128,0.88) 0%, rgba(26,92,42,0.82) 100%);
}

.faq-hero .container { position: relative; z-index: 2; }

.faq-breadcrumb {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 15px;
    font-size: 0.84rem; color: rgba(255,255,255,0.7);
}

.faq-breadcrumb li { display: flex; align-items: center; gap: 8px; }
.faq-breadcrumb li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,0.4); }
.faq-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.faq-breadcrumb a:hover { color: #fff; }
.faq-breadcrumb .active { color: rgba(255,255,255,0.6); }

.faq-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
    color: #fff; padding: 8px 18px; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 18px;
}

.faq-hero-title { color: #fff; font-size: clamp(2.2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 12px; line-height: 1.15; }
.faq-hero-subtitle { color: rgba(255,255,255,0.85); font-size: 1.05rem; max-width: 550px; margin: 0 0 25px; line-height: 1.6; }

.faq-hero-stats { display: flex; gap: 30px; flex-wrap: wrap; }
.faq-stat-item { text-align: center; }
.faq-stat-number { display: block; font-size: 1.8rem; font-weight: 800; color: #28a745; }
.faq-stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px; }

/* --- Trust Bar --- */
.faq-trust-bar { background: #fff; border-bottom: 1px solid #eef0f2; }
.faq-trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); }

.faq-trust-card {
    display: flex; align-items: center; gap: 12px; padding: 20px;
    border-right: 1px solid #f0f0f0;
}
.faq-trust-card:last-child { border-right: none; }

.faq-trust-icon {
    width: 44px; height: 44px; min-width: 44px; background: rgba(40,167,69,0.1);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #28a745; font-size: 1.1rem;
}

.faq-trust-card strong { display: block; font-size: 1.1rem; color: #0a1628; }
.faq-trust-card span { font-size: 0.75rem; color: #888; }

/* --- Main Section --- */
.faq-main-section { padding: 40px 0 60px; background: #f8f9fa; }

/* --- Search --- */
.faq-search-wrapper { margin-bottom: 25px; display: flex; justify-content: center; }
.faq-search-inner { display: flex; align-items: center; gap: 12px; max-width: 600px; width: 100%; }

.faq-input-wrapper { position: relative; flex: 1; }

.faq-form-input {
    width: 100%; padding: 14px 44px 14px 48px; border: 2px solid #e9ecef;
    border-radius: 12px; font-size: 0.92rem; color: #333; background: #fff;
    transition: all 0.3s ease; outline: none;
}

.faq-form-input:focus { border-color: #28a745; box-shadow: 0 0 0 3px rgba(40,167,69,0.1); }

.faq-input-icon {
    position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
    color: #aaa; font-size: 1rem;
}

.faq-search-clear {
    position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
    background: #f0f0f0; border: none; width: 28px; height: 28px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #888; transition: all 0.2s;
}

.faq-search-clear:hover { background: #dc3545; color: #fff; }

.faq-search-count {
    background: #f0faf3; color: #28a745; padding: 10px 16px; border-radius: 10px;
    font-size: 0.85rem; font-weight: 600; white-space: nowrap;
}

/* --- Filter Pills --- */
.faq-filters-wrapper { margin-bottom: 25px; }
.faq-filters-scroll {
    display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none;
    justify-content: center; padding: 5px 0;
}
.faq-filters-scroll::-webkit-scrollbar { display: none; }

.faq-filter-pill {
    display: flex; align-items: center; gap: 8px; padding: 10px 20px;
    background: #fff; border: 2px solid #e9ecef; border-radius: 50px;
    font-size: 0.84rem; font-weight: 600; color: #555; cursor: pointer;
    transition: all 0.3s ease; white-space: nowrap; flex-shrink: 0;
}

.faq-filter-pill:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }
.faq-filter-pill.active { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; border-color: transparent; box-shadow: 0 5px 20px rgba(40,167,69,0.3); }

.faq-filter-count {
    background: rgba(0,0,0,0.08); padding: 2px 8px; border-radius: 50px;
    font-size: 0.72rem; font-weight: 700;
}

.faq-filter-pill.active .faq-filter-count { background: rgba(255,255,255,0.25); }

/* --- FAQ List --- */
.faq-list-wrapper { max-width: 850px; margin: 0 auto; }

.faq-results-text {
    font-size: 0.82rem; color: #888; margin-bottom: 12px;
}

.faq-item {
    background: #fff; border: 1px solid #eef0f2; border-radius: 14px;
    margin-bottom: 10px; overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.03); transition: all 0.3s ease;
}

.faq-item:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.06); }
.faq-item-active { border-color: #28a745; box-shadow: 0 5px 25px rgba(40,167,69,0.1); }

.faq-question {
    padding: 18px 22px; display: flex; align-items: center; gap: 14px;
    cursor: pointer; font-weight: 600; font-size: 0.95rem;
    color: #0a1628; transition: all 0.3s ease; user-select: none;
}

.faq-question:hover { color: #0056b3; }
.faq-item-active .faq-question { 
    background: linear-gradient(135deg, rgba(40,167,69,0.03), rgba(0,86,179,0.03)); 
    color: #0056b3; 
}

.faq-q-badge {
    width: 38px; height: 38px; min-width: 38px;
    background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; color: #28a745; font-weight: 700; transition: all 0.3s ease;
}

.faq-item-active .faq-q-badge { 
    background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; 
}

.faq-q-text { flex: 1; }

.faq-category-tag {
    font-size: 0.7rem; padding: 4px 12px; background: #f0f7ff;
    color: #0056b3; border-radius: 50px; font-weight: 500;
}

.faq-chevron { 
    font-size: 0.85rem; color: #aaa; transition: transform 0.3s ease; 
}

.faq-chevron.rotate { transform: rotate(180deg); color: #28a745; }

.faq-answer-inner {
    display: flex; gap: 14px; padding: 0 22px 22px 22px;
}

.faq-a-badge {
    width: 38px; height: 38px; min-width: 38px;
    background: linear-gradient(135deg, #28a745, #1e7e34);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; color: #fff; font-weight: 700;
}

.faq-answer-content { 
    font-size: 0.9rem; color: #666; line-height: 1.85; flex: 1;
}

/* CKEditor Content Styles */
.faq-answer-content h2, .faq-answer-content h3, .faq-answer-content h4 {
    color: #0a1628; margin: 12px 0 8px; font-weight: 700;
}
.faq-answer-content h2 { font-size: 1.2rem; }
.faq-answer-content h3 { font-size: 1.05rem; }
.faq-answer-content p { margin-bottom: 10px; }
.faq-answer-content ul, .faq-answer-content ol { padding-left: 20px; margin-bottom: 10px; }
.faq-answer-content li { margin-bottom: 4px; }
.faq-answer-content strong { color: #0a1628; }
.faq-answer-content a { color: #0056b3; text-decoration: underline; }
.faq-answer-content a:hover { color: #28a745; }
.faq-answer-content img { max-width: 100%; border-radius: 8px; margin: 8px 0; }
.faq-answer-content blockquote {
    border-left: 3px solid #28a745; padding: 8px 14px; margin: 10px 0;
    background: rgba(40,167,69,0.04); border-radius: 0 8px 8px 0;
}

/* --- CTA Section --- */
.faq-cta-section { padding: 0 0 60px; background: #f8f9fa; }

.faq-cta-card {
    background: linear-gradient(135deg, #0056b3, #003d80); border-radius: 20px;
    padding: 35px 30px; color: #fff; position: relative; overflow: hidden;
}

.faq-cta-card::before {
    content: ''; position: absolute; top: -30%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
}

.faq-cta-card h3 { font-size: clamp(1.2rem, 2.5vw, 1.4rem); font-weight: 800; margin-bottom: 6px; position: relative; }
.faq-cta-card p { opacity: 0.9; margin: 0; position: relative; }

.faq-cta-buttons { display: flex; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }

.faq-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    white-space: nowrap;
}

.faq-btn-lg { padding: 14px 28px; font-size: 0.95rem; border-radius: 10px; }
.faq-btn-accent { background: #28a745; color: #fff; box-shadow: 0 6px 25px rgba(40,167,69,0.35); }
.faq-btn-accent:hover { transform: translateY(-2px); box-shadow: 0 10px 35px rgba(40,167,69,0.5); color: #fff; }

.faq-btn-white { background: #fff; color: #0056b3; }
.faq-btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); color: #003d80; }

.faq-btn-white-outline-dark { background: transparent; color: #0a1628; border: 2px solid #0a1628; }
.faq-btn-white-outline-dark:hover { background: #0a1628; color: #fff; }

/* --- Final CTA --- */
.faq-final-cta { padding: 60px 0; background: #fff; }
.faq-final-cta h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #0a1628; margin-bottom: 10px; }
.faq-final-cta p { font-size: 1rem; color: #666; max-width: 500px; margin: 0 auto 20px; }
.faq-final-cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* --- States --- */
.faq-state-box { text-align: center; padding: 60px 20px; }
.faq-empty-state { text-align: center; padding: 50px 20px; }
.faq-empty-icon { width: 90px; height: 90px; margin: 0 auto 20px; background: rgba(40,167,69,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: #28a745; }
.faq-empty-state h3 { font-size: 1.2rem; font-weight: 700; color: #0a1628; }
.faq-empty-state p { color: #888; max-width: 400px; margin: 0 auto; }

/* ============================================
   RESPONSIVE
   ============================================ */

@media (max-width: 1199.98px) {
    .faq-trust-grid { grid-template-columns: repeat(2, 1fr); }
    .faq-trust-card:nth-child(2) { border-right: none; }
}

@media (max-width: 991.98px) {
    .faq-hero { padding: 60px 0 50px; min-height: auto; }
    .faq-hero-title { font-size: 1.8rem; }
    .faq-cta-card { text-align: center; padding: 25px; }
    .faq-cta-buttons { justify-content: center; }
    .faq-answer-inner { padding: 0 16px 16px; }
}

@media (max-width: 767.98px) {
    .faq-hero { padding: 45px 0 40px; }
    .faq-hero-title { font-size: 1.5rem; }
    .faq-hero-subtitle { font-size: 0.9rem; }
    .faq-hero-stats { gap: 15px; }
    .faq-stat-number { font-size: 1.4rem; }
    .faq-trust-grid { grid-template-columns: 1fr 1fr; }
    .faq-trust-card { padding: 14px; gap: 8px; }
    .faq-search-inner { flex-direction: column; }
    .faq-filters-scroll { justify-content: flex-start; }
    .faq-question { padding: 14px 16px; font-size: 0.88rem; gap: 10px; }
    .faq-answer-inner { padding: 0 12px 14px; gap: 10px; }
    .faq-q-badge, .faq-a-badge { width: 32px; height: 32px; min-width: 32px; font-size: 0.8rem; }
}

@media (max-width: 575.98px) {
    .faq-hero { padding: 35px 0 30px; }
    .faq-hero-title { font-size: 1.3rem; }
    .faq-hero-badge { font-size: 0.75rem; padding: 6px 14px; }
    .faq-breadcrumb { font-size: 0.75rem; }
    .faq-trust-grid { grid-template-columns: 1fr 1fr; }
    .faq-trust-card { padding: 12px 10px; border-bottom: 1px solid #f0f0f0; }
    .faq-trust-card:nth-child(even) { border-right: none; }
    .faq-trust-icon { width: 34px; height: 34px; min-width: 34px; font-size: 0.9rem; }
    .faq-filter-pill { padding: 7px 14px; font-size: 0.74rem; }
    .faq-question { padding: 12px 14px; font-size: 0.82rem; gap: 8px; }
    .faq-answer-content { font-size: 0.82rem; }
    .faq-cta-card { padding: 20px 15px; border-radius: 14px; }
    .faq-cta-buttons { flex-direction: column; }
    .faq-cta-buttons .faq-btn { width: 100%; justify-content: center; }
    .faq-final-cta { padding: 40px 0; }
    .faq-final-cta-buttons { flex-direction: column; }
    .faq-final-cta-buttons .faq-btn { width: 100%; justify-content: center; }
    body { padding-bottom: 55px; }
}
</style>


<script>
document.addEventListener('livewire:navigated', () => {
    if (typeof AOS !== 'undefined') AOS.refresh();
});
</script>