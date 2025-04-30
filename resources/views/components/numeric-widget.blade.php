@props([
    'title',
    'icon' => 'fa-chart-bar',
    'value' => 0,
    'description' => '',
    'color' => 'primary',
    'isMoney' => false,
    'isHour' => false,
])

@php
    $colorClass = "text-{$color}";
    $borderClass = "border-{$color}";
@endphp

<div class="col-12 col-md-6 col-lg-3 mb-4">
    <div class="card shadow-sm border {{ $borderClass }} rounded h-100">
        <div class="card-body d-flex flex-column align-items-start">
            <div class="d-flex align-items-center mb-2 w-100">
                <span class="{{ $colorClass }} me-2 fs-4">
                    <i class="fa-solid {{ $icon }}"></i>
                </span>
                <span class="fw-semibold fs-5 {{ $colorClass }}">{{ $title }}</span>
                @if($description)
                    <span class="ms-auto" data-bs-toggle="tooltip" title="{{ $description }}">
                        <i class="fa fa-info-circle text-muted"></i>
                    </span>
                @endif
            </div>
            <div class="fs-2 fw-bold {{ $colorClass }}">
                {{ $formattedValue }}
            </div>
        </div>
    </div>
</div>