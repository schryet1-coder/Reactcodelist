@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-lg-7">
        <div class="hero-card p-5">
            <span class="badge bg-primary feature-badge mb-3">Premium Streaming</span>
            <h1 class="display-6 fw-semibold">أدوات متقدمة لإدارة المحتوى والترفيه</h1>
            <p class="text-muted mb-4">نظام متكامل لإدارة القنوات والمباريات والمقاطع القصيرة والإعلانات والاشتراكات، مع تجربة مستخدم احترافية وسهلة.</p>
            <div class="row g-3">
                <div class="col-sm-6">
                    <a href="/channels" class="btn btn-outline-primary w-100">استكشف القنوات</a>
                </div>
                <div class="col-sm-6">
                    <a href="/subscriptions" class="btn btn-primary w-100">اشترك الآن</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h5 class="mb-3">مؤشرات الأداء الرئيسية</h5>
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h2 class="mb-0">{{ $stats['channels'] }}</h2>
                        <small class="text-muted">قناة</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 class="mb-0">{{ $stats['matches'] }}</h2>
                        <small class="text-muted">مباراة</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 class="mb-0">{{ $stats['reels'] }}</h2>
                        <small class="text-muted">مقطع</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 class="mb-0">{{ $stats['plans'] }}</h2>
                        <small class="text-muted">خطة اشتراك</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-4">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">جلب القنوات تلقائياً</h4>
                <p class="text-muted">أضف كود Extreme للحصول على القنوات ومشاركتها مباشرة داخل لوحة التحكم.</p>
                <form method="post" action="{{ url('/fetch-extreme') }}">
                    @csrf
                    <div class="mb-3"><input name="code" class="form-control" placeholder="Extreme code"></div>
                    <button class="btn btn-primary">Fetch Channels</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">سحب المباريات بذكاء</h4>
                <p class="text-muted">يمكنك استيراد المباريات من أي رابط خارجي للحصول على محتوى إضافي بسرعة.</p>
                <form method="post" action="{{ url('/fetch-matches') }}">
                    @csrf
                    <div class="mb-3"><input name="site_url" class="form-control" placeholder="https://example.com/feed"></div>
                    <button class="btn btn-primary">Scrape Matches</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5>أمان احترافي</h5>
                <p class="text-muted">مدعوم بـ Stripe وبيئة آمنة لتسجيل الدخول وإدارة الحسابات.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5>إدارة إعلانات مرنة</h5>
                <p class="text-muted">تحكم في مواضع الإعلانات ومحتواها بسهولة من لوحة الإدارة.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5>محتوى حصري</h5>
                <p class="text-muted">يمكن للمشتركين الوصول إلى ميزات إضافية وتحميل المقاطع القصيرة.</p>
            </div>
        </div>
    </div>
</div>
@endsection
