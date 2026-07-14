<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'value' => '',
    'icon' => 'bi-graph-up',
    'color' => 'primary',
    'url' => '#',
    'trend' => null,
    'trendColor' => 'success'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => '',
    'value' => '',
    'icon' => 'bi-graph-up',
    'color' => 'primary',
    'url' => '#',
    'trend' => null,
    'trendColor' => 'success'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'small-box text-bg-' . $color . ' shadow-sm'])); ?>>
    <div class="inner">
        <h3 class="fw-bold"><?php echo e($value); ?></h3>
        <p><?php echo e($title); ?></p>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trend): ?>
        <small class="text-<?php echo e($trendColor); ?>">
            <i class="bi bi-arrow-up-short"></i> <?php echo e($trend); ?>

        </small>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <i class="bi <?php echo e($icon); ?> small-box-icon opacity-25"></i>
    <a href="<?php echo e($url); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        More info <i class="bi bi-arrow-right-short"></i>
    </a>
</div><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/components/admin/dashboard/stat-card.blade.php ENDPATH**/ ?>