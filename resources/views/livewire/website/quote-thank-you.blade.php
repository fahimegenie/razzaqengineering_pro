<div class="quote-thank-you-wrapper">
    <section class="py-5 bg-light min-vh-75 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center" data-aos="zoom-in">
                    <div class="card border-0 shadow-lg rounded-4 p-5">
                        
                        {{-- Success Animation --}}
                        <div class="mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width:100px;height:100px; animation: bounceIn 0.8s ease;">
                                <i class="fas fa-check-circle text-success fa-3x"></i>
                            </div>
                        </div>
                        
                        <h2 class="fw-bold mb-3">Thank You, {{ $quoteName }}!</h2>
                        <p class="text-muted mb-2">Your quote request has been received successfully.</p>
                        
                        @if($quoteId)
                            <p class="text-muted mb-4">
                                <strong>Reference #:</strong> 
                                <span class="badge bg-gradient text-white px-3 py-2 fs-6">
                                    {{ $this->formattedQuoteId }}
                                </span>
                            </p>
                        @endif
                        
                        {{-- Next Steps --}}
                        <div class="bg-light rounded-4 p-4 mb-4 text-start">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-clock text-primary me-2"></i> What Happens Next?
                            </h6>
                            <div class="timeline-steps">
                                <div class="timeline-step d-flex align-items-start mb-3">
                                    <div class="timeline-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-search text-success small"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block small">Step 1: Review</strong>
                                        <span class="text-muted small">Our team reviews your requirements (2-4 hours)</span>
                                    </div>
                                </div>
                                <div class="timeline-step d-flex align-items-start mb-3">
                                    <div class="timeline-icon bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-file-invoice text-primary small"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block small">Step 2: Quote Preparation</strong>
                                        <span class="text-muted small">Detailed quote with pricing sent to you (within 24 hours)</span>
                                    </div>
                                </div>
                                <div class="timeline-step d-flex align-items-start mb-3">
                                    <div class="timeline-icon bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-phone-alt text-warning small"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block small">Step 3: Follow-up Call</strong>
                                        <span class="text-muted small">Our representative calls to discuss the quote</span>
                                    </div>
                                </div>
                                <div class="timeline-step d-flex align-items-start">
                                    <div class="timeline-icon bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-tools text-info small"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block small">Step 4: Project Start</strong>
                                        <span class="text-muted small">Once approved, we schedule and begin work</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <a href="{{ url('/') }}" class="btn btn-gradient px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-home me-2"></i> Back to Home
                            </a>
                            <a href="{{ url('get-quote') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-redo me-2"></i> Submit Another
                            </a>
                            <a href="tel:+923048902805" class="btn btn-success px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-phone-alt me-2"></i> Call Now
                            </a>
                        </div>
                        
                        {{-- Share/Contact Alternative --}}
                        <div class="mt-4 pt-4 border-top">
                            <p class="text-muted small mb-2">Have questions or need to modify your request?</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="mailto:info@razzaqengineering.com" class="text-muted small text-decoration-none">
                                    <i class="fas fa-envelope me-1"></i> info@razzaqengineering.com
                                </a>
                                <span class="text-muted">|</span>
                                <a href="https://wa.me/923048902805" target="_blank" class="text-muted small text-decoration-none">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    @keyframes bounceIn {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.2); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    .timeline-step {
        transition: all 0.3s ease;
    }
    .timeline-step:hover {
        transform: translateX(5px);
    }
    .timeline-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
@endpush