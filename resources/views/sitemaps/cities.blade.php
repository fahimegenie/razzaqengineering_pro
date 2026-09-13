{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
{{-- <?xml-stylesheet type="text/xsl" href="{{ asset('sitemap.xsl') }}" ?> --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!--
    ==========================================
    City Sitemap - Razzaq Engineering Services
    Total URLs: {{ count($urls) }}
    Generated: {{ now()->toAtomString() }}
    ==========================================
    -->

    @foreach($urls as $url)
    <url>
        <loc>{{ htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') }}</loc>
        
        @if(isset($url['lastmod']))
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        @else
        <lastmod>{{ now()->toDateString() }}</lastmod>
        @endif
        
        <changefreq>{{ $url['changefreq'] ?? 'monthly' }}</changefreq>
        <priority>{{ $url['priority'] ?? '0.7' }}</priority>
        
        <mobile:mobile/>

        @if(isset($url['alternates']) && count($url['alternates']) > 0)
            @foreach($url['alternates'] as $lang => $altUrl)
            <xhtml:link rel="alternate" hreflang="{{ $lang }}" href="{{ htmlspecialchars($altUrl, ENT_XML1, 'UTF-8') }}"/>
            @endforeach
        @endif
    </url>
    @endforeach

</urlset>