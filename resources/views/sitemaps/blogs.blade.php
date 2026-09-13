{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
{{-- <?xml-stylesheet type="text/xsl" href="{{ asset('sitemap.xsl') }}" ?> --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!--
    ==========================================
    Blog Sitemap - Razzaq Engineering Services
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

        @if(isset($url['image']))
        <image:image>
            <image:loc>{{ htmlspecialchars($url['image'], ENT_XML1, 'UTF-8') }}</image:loc>
            @if(isset($url['image_title']))
            <image:title>{{ htmlspecialchars($url['image_title'], ENT_XML1, 'UTF-8') }}</image:title>
            @endif
        </image:image>
        @endif

        @if(isset($url['news']) && $url['news'])
        <news:news>
            <news:publication>
                <news:name>Razzaq Engineering Services</news:name>
                <news:language>en</news:language>
            </news:publication>
            @if(isset($url['news_title']))
            <news:title>{{ htmlspecialchars($url['news_title'], ENT_XML1, 'UTF-8') }}</news:title>
            @endif
            @if(isset($url['news_date']))
            <news:publication_date>{{ $url['news_date'] }}</news:publication_date>
            @endif
        </news:news>
        @endif
    </url>
    @endforeach

</urlset>