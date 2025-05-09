{{-- resources/views/components/stats-card.blade.php --}}
@props([
    'icon',                     // أيقونة FontAwesome، مثال: "fas fa-users"
    'title',                    // عنوان البطاقة
    'value',                    // القيمة الرئيسية
    'color' => 'primary',       // لون البطاقة
    'subIcon' => null,          // أيقونة ثانوية (اختياري)
    'numerator' => null,        // البسط لحساب النسبة (اختياري)
    'denominator' => null,      // المقام لحساب النسبة (اختياري)
    'subValue' => null,         // قيمة ثانوية جاهزة للعرض (اختياري)
])

@php
    // إذا مررنا numerator و denominator، نحصّل subValue بشكل آمن
    if (is_numeric($numerator) && is_numeric($denominator)) {
        $subValue = $denominator > 0
            ? round(($numerator / $denominator) * 100) . '%'
            : '0%';
    }
@endphp

<div class="card border-left-{{ $color }} shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">
                    {{ $title }}
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $value }}
                </div>
                @if($subValue)
                    <div class="mt-1 text-sm text-gray-600 d-flex align-items-center">
                        @if($subIcon)
                            <i class="{{ $subIcon }} mr-1"></i>
                        @endif
                        <span>{{ $subValue }}</span>
                    </div>
                @endif
            </div>
            <div class="col-auto">
                <i class="{{ $icon }} fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
