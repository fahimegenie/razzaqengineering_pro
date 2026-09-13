{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
{{-- <?xml-stylesheet type="text/xsl" href="{{ asset('sitemap.xsl') }}" ?> --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    @foreach($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        
        @if(isset($url['lastmod']))
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        @endif
        
        <changefreq>{{ $url['changefreq'] ?? 'monthly' }}</changefreq>
        <priority>{{ $url['priority'] ?? '0.5' }}</priority>
        
        <mobile:mobile/>

        @if(isset($url['images']) && is_array($url['images']) && count($url['images']) > 0)
            @foreach($url['images'] as $image)
            <image:image>
                <image:loc>{{ $image['loc'] ?? $image }}</image:loc>
                @if(isset($image['caption']))
                <image:caption>{{ $image['caption'] }}</image:caption>
                @endif
                @if(isset($image['title']))
                <image:title>{{ $image['title'] }}</image:title>
                @endif
            </image:image>
            @endforeach
        @endif
    </url>
    @endforeach

</urlset>