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
                    <p class="faq-hero-subtitle">Find answers to common questions about our services</p>
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
                
                // Toggle question
                toggle(id) {
                    this.activeQuestion = (this.activeQuestion === id) ? null : id;
                },
                
                // Filter by category
                filterCategory(cat) {
                    this.activeCategory = cat;
                    this.activeQuestion = null;
                    $wire.filterByCategory(cat);
                },
                
                // Check if FAQ matches search
                matchesSearch(faq) {
                    if (!this.search) return true;
                    const term = this.search.toLowerCase();
                    const question = (faq.faq_question || '').toLowerCase();
                    const answer = (faq.faq_answer || '').toLowerCase();
                    return question.includes(term) || answer.includes(term);
                },
                
                // Check if FAQ matches category
                matchesCategory(faq) {
                    if (this.activeCategory === 'all') return true;
                    return (faq.faq_category || '') === this.activeCategory;
                }
             }">
        <div class="container">
            
            {{-- Loading --}}
            @if($isLoading)
                <div class="text-center py-5">
                    <div class="spinner-border text-success" style="width:3rem;height:3rem;"></div>
                    <p class="text-muted mt-2">Loading FAQs...</p>
                </div>
            @else
                
                {{-- Search - Alpine.js controlled, NO Livewire --}}
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
                                    @click="search = ''; activeQuestion = null">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Categories --}}
                @if(count($categories) > 0)
                    <div class="faq-categories justify-content-center mb-4" data-aos="fade-up">
                        <button class="faq-cat-btn" 
                                :class="{ 'active': activeCategory === 'all' }"
                                @click="filterCategory('all')">
                            All Questions
                        </button>
                        @foreach($categories as $cat)
                            <button class="faq-cat-btn" 
                                    :class="{ 'active': activeCategory === '{{ $cat }}' }"
                                    @click="filterCategory('{{ $cat }}')">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                @endif
                
                {{-- FAQ List --}}
                <div class="row justify-content-center" data-aos="fade-up">
                    <div class="col-lg-9">
                        
                        @if(!empty($faqs) && count($faqs) > 0)
                            {{-- Results count --}}
                            <p class="text-muted small mb-3" 
                               x-show="search || activeCategory !== 'all'">
                                <span x-text="$refs.faqList.querySelectorAll('.faq-item:not([style*=\"display: none\"])').length"></span> 
                                questions found
                            </p>
                            
                            <div x-ref="faqList">
                                @foreach($faqs as $faq)
                                    <div class="faq-item"
                                         x-show="matchesSearch({{ json_encode($faq) }}) && matchesCategory({{ json_encode($faq) }})"
                                         :class="{ 'faq-item-active': activeQuestion === {{ $faq->faq_id }} }">
                                        
                                        {{-- Question --}}
                                        <div class="faq-question" 
                                             @click="toggle({{ $faq->faq_id }})">
                                            <span class="faq-q-icon">Q</span>
                                            <span class="faq-q-text">{{ $faq->faq_question }}</span>
                                            <i class="fas fa-chevron-down faq-arrow" 
                                               :class="{ 'rotated': activeQuestion === {{ $faq->faq_id }} }"></i>
                                        </div>
                                        
                                        {{-- Answer --}}
                                        <div class="faq-answer" 
                                             x-show="activeQuestion === {{ $faq->faq_id }}"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100">
                                            <div class="faq-answer-content">
                                                {{ $faq->faq_answer }}
                                            </div>
                                        </div>
                                        
                                    </div>
                                @endforeach
                            </div>
                            
                            {{-- No Results --}}
                            <div class="text-center py-5" 
                                 x-show="$refs.faqList.querySelectorAll('.faq-item:not([style*=\"display: none\"])').length === 0">
                                <i class="fas fa-search fa-3x text-muted opacity-25 mb-3"></i>
                                <h5 class="fw-bold">No Questions Found</h5>
                                <p class="text-muted">Try different keywords or browse all questions.</p>
                                <button class="btn btn-outline-success rounded-pill px-4" 
                                        @click="search = ''; filterCategory('all')">
                                    <i class="fas fa-redo me-2"></i> Show All Questions
                                </button>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-question-circle fa-3x text-muted opacity-25 mb-3"></i>
                                <h4 class="fw-bold">No FAQs Available</h4>
                                <p class="text-muted">Please check back later.</p>
                            </div>
                        @endif
                        
                    </div>
                </div>
                
            @endif
            
            {{-- CTA --}}
            <div class="row justify-content-center mt-5" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="faq-cta">
                        <h4>Still Have Questions?</h4>
                        <p>Can't find what you're looking for? Our team is ready to help.</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <a href="{{ route('quote.index') }}" class="btn-faq-cta">
                                <i class="fas fa-file-invoice me-2"></i> Get Free Quote
                            </a>
                            <a href="tel:+923048902805" class="btn-faq-cta">
                                <i class="fas fa-phone-alt me-2"></i> +92 304 8902805
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

</div>

@push('styles')
<style>
    /* FAQ Page Styles - Same as before */
    .faq-hero {
        position: relative;
        background: linear-gradient(135deg, #003d80 0%, #1a5c2a 100%);
        min-height: 250px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .faq-hero-content { position: relative; z-index: 1; }
    .faq-breadcrumb {
        display: flex; gap: 8px; list-style: none; padding: 0; margin: 0 0 10px;
    }
    .faq-breadcrumb li { color: rgba(255,255,255,0.7); font-size: 0.85rem; }
    .faq-breadcrumb li a { color: #fff; text-decoration: none; }
    .faq-breadcrumb li a:hover { color: #48c964; }
    .faq-breadcrumb li:not(:last-child)::after { content: '/'; margin-left: 8px; color: rgba(255,255,255,0.4); }
    .faq-hero-title { color: #fff; font-size: 2.5rem; font-weight: 800; margin: 0; }
    .faq-hero-subtitle { color: rgba(255,255,255,0.8); font-size: 1rem; margin-top: 8px; }

    .faq-section { padding: 80px 0; background: #f8f9fa; }

    .faq-search-wrap { position: relative; }
    .faq-search-input {
        width: 100%; padding: 14px 50px 14px 48px;
        border: 2px solid #e9ecef; border-radius: 50px;
        font-size: 0.95rem; background: #fff;
        transition: all 0.3s ease;
    }
    .faq-search-input:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.1);
        outline: none;
    }
    .faq-search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #aaa; }
    .faq-search-clear {
        position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
        background: #eee; border: none; width: 26px; height: 26px; border-radius: 50%;
        cursor: pointer; color: #888; font-size: 12px; display: flex; align-items: center; justify-content: center;
    }
    .faq-search-clear:hover { background: #dc3545; color: #fff; }

    .faq-categories { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .faq-cat-btn {
        padding: 8px 18px; border: 2px solid #e9ecef; background: #fff;
        border-radius: 50px; font-size: 0.82rem; font-weight: 600;
        color: #555; cursor: pointer; transition: all 0.3s ease;
    }
    .faq-cat-btn:hover { border-color: #28a745; color: #28a745; background: #f0faf3; }
    .faq-cat-btn.active { background: #28a745; color: #fff; border-color: #28a745; }

    .faq-item {
        background: #fff; border: 1px solid #eef0f2; border-radius: 12px;
        margin-bottom: 10px; overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    .faq-item:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.06); }
    .faq-item-active { border-color: #28a745; box-shadow: 0 5px 25px rgba(40,167,69,0.1); }

    .faq-question {
        padding: 18px 22px; display: flex; align-items: center; gap: 12px;
        cursor: pointer; font-weight: 600; font-size: 0.95rem;
        color: #0a1628; transition: all 0.3s ease; user-select: none;
    }
    .faq-question:hover { color: #0056b3; }
    .faq-item-active .faq-question { background: linear-gradient(135deg, rgba(40,167,69,0.03), rgba(0,86,179,0.03)); color: #0056b3; }

    .faq-q-icon {
        width: 36px; height: 36px; min-width: 36px;
        background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(0,86,179,0.1));
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 14px; color: #28a745; font-weight: 700; transition: all 0.3s ease;
    }
    .faq-item-active .faq-q-icon { background: linear-gradient(135deg, #0056b3, #28a745); color: #fff; }

    .faq-q-text { flex: 1; }
    .faq-arrow { font-size: 14px; color: #aaa; transition: transform 0.3s ease; }
    .faq-arrow.rotated { transform: rotate(180deg); }
    .faq-answer-content { padding: 0 22px 20px 70px; font-size: 0.9rem; color: #666; line-height: 1.8; }

    .faq-cta {
        padding: 35px; background: linear-gradient(135deg, #0056b3, #003d80);
        border-radius: 16px; color: #fff; text-align: center;
    }
    .faq-cta h4 { color: #fff; font-weight: 700; margin-bottom: 8px; }
    .faq-cta p { color: rgba(255,255,255,0.8); margin-bottom: 15px; }
    .btn-faq-cta {
        display: inline-flex; align-items: center; padding: 12px 28px;
        background: #fff; color: #0056b3; text-decoration: none;
        border-radius: 8px; font-weight: 700; font-size: 0.9rem; transition: all 0.3s ease;
    }
    .btn-faq-cta:hover { background: #28a745; color: #fff; transform: translateY(-2px); }

    @media (max-width: 991.98px) {
        .faq-section { padding: 60px 0; }
        .faq-hero { min-height: 200px; }
        .faq-hero-title { font-size: 2rem; }
        .faq-answer-content { padding-left: 20px; }
    }
    @media (max-width: 767.98px) {
        .faq-section { padding: 45px 0; }
        .faq-hero-title { font-size: 1.6rem; }
        .faq-question { font-size: 0.88rem; padding: 14px 16px; }
        .faq-answer-content { padding: 0 16px 16px; font-size: 0.85rem; }
        .faq-cat-btn { font-size: 0.75rem; padding: 6px 14px; }
    }
    @media (max-width: 575.98px) {
        .faq-section { padding: 35px 0; }
        .faq-hero { min-height: 170px; }
        .faq-hero-title { font-size: 1.3rem; }
        .faq-question { font-size: 0.82rem; }
        .faq-cta { padding: 20px; }
    }
</style>
@endpush