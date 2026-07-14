@props([
    'title' => '',
    'value' => '',
    'icon' => 'bi-graph-up',
    'color' => 'primary',
    'url' => '#',
    'trend' => null,
    'trendColor' => 'success'
])

<div {{ $attributes->merge(['class' => 'small-box text-bg-' . $color . ' shadow-sm']) }}>
    <div class="inner">
        <h3 class="fw-bold">{{ $value }}</h3>
        <p>{{ $title }}</p>
        @if($trend)
        <small class="text-{{ $trendColor }}">
            <i class="bi bi-arrow-up-short"></i> {{ $trend }}
        </small>
        @endif
    </div>
    <i class="bi {{ $icon }} small-box-icon opacity-25"></i>
    <a href="{{ $url }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        More info <i class="bi bi-arrow-right-short"></i>
    </a>
</div>