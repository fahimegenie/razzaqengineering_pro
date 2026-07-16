
<div>
    <!-- Loading State -->
    <div wire:loading.delay.longest wire:target="save"
        class="position-fixed top-0 start-0 w-100 h-100 align-items-center justify-content-center" 
        style="background: rgba(0,0,0,0.3); z-index: 99999; display: none !important;"
        wire:loading.class="d-flex"
        wire:loading.style="display: flex !important;">
        <div class="bg-body p-4 rounded-3 shadow-lg text-center border border-secondary-subtle">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Saving...</span>
            </div>
            <p class="mb-0 fw-semibold">Saving about us settings...</p>
        </div>
    </div>

    <!-- Page Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">About Us Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e($errorMessage); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($saveSuccess): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
             x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <i class="bi bi-check-circle me-2"></i>About Us page saved successfully!
            <button type="button" class="btn-close" @click="show = false"></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form wire:submit="save">
            <div class="row g-3">
                <!-- Tabs Navigation -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-2">
                            <ul class="nav nav-pills flex-nowrap overflow-auto" role="tablist">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li class="nav-item" role="presentation">
                                    <button type="button" 
                                            class="nav-link text-nowrap <?php echo e($activeTab === $key ? 'active' : ''); ?>"
                                            wire:click="setTab('<?php echo e($key); ?>')">
                                        <i class="bi <?php echo e($tab['icon']); ?> me-1"></i> <?php echo e($tab['label']); ?>

                                    </button>
                                </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-12 col-lg-9">
                    
                    
                    
                    
                    <div class="<?php echo e($activeTab === 'basic-info' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-info-circle me-2"></i>Basic Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label fw-semibold required">Page Title</label>
                                        <input type="text" wire:model="about_title" class="form-control <?php $__errorArgs = ['about_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., About Razzaq Engineering">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['about_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold d-block">Status</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" wire:model="is_active" id="isActive">
                                            <label class="form-check-label" for="isActive">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Subtitle</label>
                                        <input type="text" wire:model="about_subtitle" class="form-control" placeholder="e.g., Leading Engineering Services in Pakistan">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Short Description</label>
                                        <textarea wire:model="about_short_description" class="form-control" rows="3" placeholder="Brief introduction..."></textarea>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Description Part 1','placeholder' => 'Enter main description...','height' => '300px','toolbar' => 'full','value' => $about_description_1]);

$__keyOuter = $__key ?? null;

$__key = 'about-desc-1-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Description Part 2','placeholder' => 'Enter secondary description...','height' => '300px','toolbar' => 'full','value' => $about_description_2]);

$__keyOuter = $__key ?? null;

$__key = 'about-desc-2-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Our Story','placeholder' => 'Tell your company story...','height' => '300px','toolbar' => 'full','value' => $our_story]);

$__keyOuter = $__key ?? null;

$__key = 'our-story-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Video URL</label>
                                        <input type="url" wire:model="about_video_url" class="form-control" placeholder="e.g., https://youtube.com/watch?v=...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'mission-vision' ? '' : 'd-none'); ?>">
                        <!-- Mission -->
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-bullseye me-2"></i>Our Mission
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Mission Title</label>
                                        <input type="text" wire:model="mission_title" class="form-control" placeholder="e.g., Our Mission">
                                    </div>
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Mission Description','placeholder' => 'Describe your mission...','height' => '250px','toolbar' => 'standard','value' => $mission_description]);

$__keyOuter = $__key ?? null;

$__key = 'mission-desc-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vision -->
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-eye me-2"></i>Our Vision
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Vision Title</label>
                                        <input type="text" wire:model="vision_title" class="form-control" placeholder="e.g., Our Vision">
                                    </div>
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Vision Description','placeholder' => 'Describe your vision...','height' => '250px','toolbar' => 'standard','value' => $vision_description]);

$__keyOuter = $__key ?? null;

$__key = 'vision-desc-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-4', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Values -->
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-heart me-2"></i>Our Values
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Values Title</label>
                                        <input type="text" wire:model="values_title" class="form-control" placeholder="e.g., Our Core Values">
                                    </div>
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Values Description','placeholder' => 'Describe your core values...','height' => '250px','toolbar' => 'standard','value' => $values_description]);

$__keyOuter = $__key ?? null;

$__key = 'values-desc-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-5', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'why-choose-us' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-hand-thumbs-up me-2"></i>Why Choose Us
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'Why Choose Us','placeholder' => 'Describe why customers should choose you...','height' => '300px','toolbar' => 'full','value' => $why_choose_us]);

$__keyOuter = $__key ?? null;

$__key = 'why-choose-us-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-6', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-list-check me-2"></i>Key Points
                                </h3>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#addKeyPointForm">
                                    <i class="bi bi-plus-lg me-1"></i> Add Point
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="collapse mb-3" id="addKeyPointForm">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-3">
                                                    <label class="form-label small">Icon (FontAwesome)</label>
                                                    <input type="text" wire:model="newKeyPointIcon" class="form-control" placeholder="e.g., fa-check-circle">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small">Title</label>
                                                    <input type="text" wire:model="newKeyPointTitle" class="form-control" placeholder="Point title">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small">Description</label>
                                                    <input type="text" wire:model="newKeyPointDesc" class="form-control" placeholder="Point description">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" wire:click="addKeyPoint" class="btn btn-success w-100">
                                                        <i class="bi bi-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $key_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-start gap-3 p-3 border rounded bg-light">
                                                <div class="flex-shrink-0">
                                                    <i class="fas <?php echo e($point['icon'] ?? 'fa-check-circle'); ?> fa-2x text-primary"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1"><?php echo e($point['title'] ?? 'Point ' . ($index + 1)); ?></h6>
                                                    <p class="mb-0 text-muted small"><?php echo e($point['desc'] ?? ''); ?></p>
                                                </div>
                                                <button type="button" wire:click="removeKeyPoint(<?php echo e($index); ?>)" class="btn btn-sm text-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <div class="col-12 text-center py-3 text-muted">
                                            <i class="bi bi-inbox display-4"></i>
                                            <p>No key points added yet.</p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'statistics' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-graph-up me-2"></i>Core Statistics
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Years Experience</label>
                                        <input type="number" wire:model="years_experience" class="form-control" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Projects Completed</label>
                                        <input type="number" wire:model="projects_completed" class="form-control" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Happy Clients</label>
                                        <input type="number" wire:model="happy_clients" class="form-control" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-plus-circle me-2"></i>Custom Statistics
                                </h3>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#addStatForm">
                                    <i class="bi bi-plus-lg me-1"></i> Add Statistic
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="collapse mb-3" id="addStatForm">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-3">
                                                    <label class="form-label small">Icon</label>
                                                    <input type="text" wire:model="newStatIcon" class="form-control" placeholder="e.g., fa-users">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small">Label</label>
                                                    <input type="text" wire:model="newStatLabel" class="form-control" placeholder="e.g., Team Members">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small">Value</label>
                                                    <input type="text" wire:model="newStatValue" class="form-control" placeholder="e.g., 150">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" wire:click="addStatistic" class="btn btn-success w-100">
                                                        <i class="bi bi-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="col-md-4">
                                            <div class="stat-card p-3 border rounded text-center bg-light position-relative">
                                                <button type="button" wire:click="removeStatistic(<?php echo e($index); ?>)" 
                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                                <i class="fas <?php echo e($stat['icon'] ?? 'fa-star'); ?> fa-2x text-primary mb-2"></i>
                                                <h3 class="mb-1"><?php echo e($stat['value'] ?? '0'); ?>+</h3>
                                                <p class="mb-0 text-muted"><?php echo e($stat['label'] ?? 'Stat ' . ($index + 1)); ?></p>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <div class="col-12 text-center py-3 text-muted">
                                            <p>No custom statistics added yet.</p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'images' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-image me-2"></i>Main Image
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aImagePreview): ?>
                                                <img src="<?php echo e($aImagePreview); ?>" class="img-fluid mb-2 rounded" style="max-height: 250px;">
                                            <?php else: ?>
                                                <div class="py-4 text-muted">
                                                    <i class="bi bi-image display-4"></i>
                                                    <p>No main image</p>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <input type="file" wire:model="a_image" class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended: 600x500px</small>
                                        </div>
                                        <div wire:loading wire:target="a_image" class="mt-2">
                                            <span class="spinner-border spinner-border-sm text-primary"></span> Uploading...
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aImagePreview): ?>
                                            <button type="button" wire:click="removeImage('main')" class="btn btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i> Remove Image
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-image-alt me-2"></i>Banner Image
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aboutBannerPreview): ?>
                                                <img src="<?php echo e($aboutBannerPreview); ?>" class="img-fluid mb-2 rounded" style="max-height: 200px;">
                                            <?php else: ?>
                                                <div class="py-4 text-muted">
                                                    <i class="bi bi-image display-4"></i>
                                                    <p>No banner image</p>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <input type="file" wire:model="about_banner" class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended: 1920x400px</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aboutBannerPreview): ?>
                                            <button type="button" wire:click="removeImage('banner')" class="btn btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i> Remove Banner
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-images me-2"></i>Gallery
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Add Gallery Images</label>
                                    <input type="file" wire:model="galleryImages" class="form-control" accept="image/*" multiple>
                                    <small class="text-muted">You can select multiple images</small>
                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($galleryPreviews): ?>
                                    <div class="row g-2 mb-3">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryPreviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="col-md-3">
                                                <img src="<?php echo e($preview); ?>" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($about_gallery) > 0): ?>
                                    <h6 class="fw-semibold mb-2">Existing Gallery (<?php echo e(count($about_gallery)); ?> images)</h6>
                                    <div class="row g-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $about_gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div class="col-md-3 position-relative">
                                                <img src="<?php echo e(asset('uploads/about/gallery/' . $image)); ?>" 
                                                     class="img-fluid rounded" 
                                                     style="height: 100px; object-fit: cover; width: 100%;">
                                                <button type="button" wire:click="removeGalleryImage(<?php echo e($index); ?>)" 
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'certifications' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-patch-check me-2"></i>Certifications
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" wire:model="newCertification" class="form-control" placeholder="Add certification..." 
                                           @keydown.enter.prevent="$wire.addCertification()">
                                    <button type="button" wire:click="addCertification" class="btn btn-primary">
                                        <i class="bi bi-plus"></i> Add
                                    </button>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="badge bg-success d-flex align-items-center gap-2 p-2">
                                            <i class="bi bi-patch-check"></i> <?php echo e($cert); ?>

                                            <button type="button" wire:click="removeCertification(<?php echo e($index); ?>)" 
                                                    class="btn-close btn-close-white" style="font-size: 0.5rem;"></button>
                                        </span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <p class="text-muted">No certifications added.</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-trophy me-2"></i>Awards
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" wire:model="newAward" class="form-control" placeholder="Add award..." 
                                           @keydown.enter.prevent="$wire.addAward()">
                                    <button type="button" wire:click="addAward" class="btn btn-warning">
                                        <i class="bi bi-plus"></i> Add
                                    </button>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="badge bg-warning text-dark d-flex align-items-center gap-2 p-2">
                                            <i class="bi bi-trophy"></i> <?php echo e($award); ?>

                                            <button type="button" wire:click="removeAward(<?php echo e($index); ?>)" 
                                                    class="btn-close" style="font-size: 0.5rem;"></button>
                                        </span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <p class="text-muted">No awards added.</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'ceo' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-person-badge me-2"></i>CEO / Director Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">CEO Name</label>
                                        <input type="text" wire:model="ceo_name" class="form-control" placeholder="e.g., Muhammad Razzaq">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Designation</label>
                                        <input type="text" wire:model="ceo_designation" class="form-control" placeholder="e.g., Founder & CEO">
                                    </div>
                                    <div class="col-12">
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.ck-editor', ['label' => 'CEO Message','placeholder' => 'Enter CEO message...','height' => '300px','toolbar' => 'full','value' => $ceo_message,'field' => 'ceo_message']);

$__keyOuter = $__key ?? null;

$__key = 'ceo-message-editor';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-515511317-7', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">CEO Image</label>
                                        <div class="border rounded p-3 text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ceoImagePreview): ?>
                                                <img src="<?php echo e($ceoImagePreview); ?>" class="img-fluid mb-2 rounded-circle" style="max-height: 150px; width: 150px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="py-4 text-muted">
                                                    <i class="bi bi-person-circle display-4"></i>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <input type="file" wire:model="ceo_image" class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended: 400x400px square</small>
                                        </div>
                                        <div wire:loading wire:target="ceo_image" class="mt-2">
                                            <span class="spinner-border spinner-border-sm text-primary"></span> Uploading...
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ceoImagePreview): ?>
                                            <button type="button" wire:click="removeImage('ceo')" class="btn btn-outline-danger mt-4">
                                                <i class="bi bi-trash me-1"></i> Remove CEO Image
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                    
                    <div class="<?php echo e($activeTab === 'seo' ? '' : 'd-none'); ?>">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-search me-2"></i>SEO Settings
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Title</label>
                                        <input type="text" wire:model="meta_title" class="form-control">
                                        <small class="text-muted">Recommended: 50-60 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Description</label>
                                        <textarea wire:model="meta_description" class="form-control" rows="3"></textarea>
                                        <small class="text-muted">Recommended: 150-160 characters</small>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Meta Keywords</label>
                                        <input type="text" wire:model="meta_keywords" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Meta Robots</label>
                                        <select wire:model="meta_robots" class="form-select">
                                            <option value="index, follow">Index, Follow</option>
                                            <option value="noindex, follow">No Index, Follow</option>
                                            <option value="index, nofollow">Index, No Follow</option>
                                            <option value="noindex, nofollow">No Index, No Follow</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Canonical URL</label>
                                        <input type="url" wire:model="canonical_url" class="form-control" placeholder="https://...">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">OG Image</label>
                                        <div class="border rounded p-3 text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ogImagePreview): ?>
                                                <img src="<?php echo e($ogImagePreview); ?>" class="img-fluid mb-2" style="max-height: 100px;">
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <input type="file" wire:model="og_image" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ogImagePreview): ?>
                                            <button type="button" wire:click="removeImage('og')" class="btn btn-outline-danger mt-4">
                                                <i class="bi bi-trash me-1"></i> Remove OG Image
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Schema Markup (JSON-LD)</label>
                                        <textarea wire:model="schema_markup" class="form-control font-monospace" rows="8" placeholder="`"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-header bg-transparent">
                                <h3 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-google me-2"></i>Search Engine Preview
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="seo-preview p-3 border rounded">
                                    <p class="seo-title mb-1" style="color: #1a0dab; font-size: 18px;">
                                        <?php echo e($meta_title ?: $about_title ?: 'About Us - Your Site'); ?>

                                    </p>
                                    <p class="seo-url mb-1" style="color: #006621; font-size: 13px;">
                                        <?php echo e($canonical_url ?: url('/about-us')); ?>

                                    </p>
                                    <p class="seo-desc mb-0" style="color: #545454; font-size: 13px;">
                                        <?php echo e(Str::limit($meta_description ?: $about_short_description, 160)); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save">
                                <i class="bi bi-check-lg me-1"></i> Save All Settings
                            </span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm me-1"></span> Saving...
                            </span>
                        </button>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="<?php echo e(url('/about-us')); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i> View About Page
                                </a>
                                <button type="button" wire:click="$refresh" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh Data
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent">
                            <h3 class="card-title mb-0 fs-6">Page Summary</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2"><strong>Title:</strong> <?php echo e($about_title ?: 'Not set'); ?></li>
                                <li class="mb-2"><strong>Status:</strong> 
                                    <span class="badge bg-<?php echo e($is_active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </li>
                                <li class="mb-2"><strong>Stats:</strong> <?php echo e($years_experience); ?>+ Years, <?php echo e($projects_completed); ?>+ Projects</li>
                                <li class="mb-2"><strong>Key Points:</strong> <?php echo e(count($key_points)); ?></li>
                                <li class="mb-2"><strong>Certifications:</strong> <?php echo e(count($certifications)); ?></li>
                                <li class="mb-2"><strong>Awards:</strong> <?php echo e(count($awards)); ?></li>
                                <li class="mb-2"><strong>Gallery:</strong> <?php echo e(count($about_gallery)); ?> images</li>
                                <li class="mb-2"><strong>CEO:</strong> <?php echo e($ceo_name ?: 'Not set'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .required::after { content: ' *'; color: #dc3545; }
    .seo-preview { background: #fff; max-width: 600px; }
    .seo-preview p { font-family: Arial, sans-serif; }
    .stat-card { transition: all 0.3s ease; }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    @media (max-width: 768px) { .seo-preview { max-width: 100%; } }
    [x-cloak] { display: none !important; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/admin/settings/about-us-settings.blade.php ENDPATH**/ ?>