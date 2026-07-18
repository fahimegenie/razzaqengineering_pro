
@push('styles')


@endpush

<div>
<!-- Hero Carousel -->
<x-website.partials.home.hero-section :slider="$slider" />
<x-website.partials.home.about-section :com="$com" />
<x-website.partials.home.service-section :services="$services" :sd="$sd" :os="$os" />
<x-website.partials.home.industries-we-service-section/>
<x-website.partials.home.why-choose-us />
<x-website.partials.home.director-message-section :com="$com"/>
<x-website.partials.home.video-section />
<x-website.partials.home.call-us-section  :com="$com"/>
<x-website.partials.home.advanced-technology-fleet-section />
<x-website.partials.home.latest-project-section :pro="$pro"/>
<x-website.partials.home.our-core-values-section />
<x-website.partials.home.service-across-pakistan-section />

</div>
@push('scripts')
<script>
    // Initialize default tabs
    document.addEventListener('DOMContentLoaded', function() {
        const defaultTab = document.getElementById('defaultOpen');
        if (defaultTab){
            defaultTab.click();
        }
        
        const defaultTabNew = document.getElementById('defaultOpen_new');
        if (defaultTabNew){
            defaultTabNew.click();
        }
    });
</script>
@endpush