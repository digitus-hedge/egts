<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $licenseBanner->title ?? 'Certifications & Licenses' }} - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/licenses.css') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="lc-hero" @if(!$licenseBanner?->video && $licenseBanner?->image) style="background-image:
            url('{{ asset('storage/' . $licenseBanner->image) }}');" @endif>

            @if ($licenseBanner?->video)
            <video class="lc-hero-video-bg" autoplay muted loop playsinline>
                <source src="{{ asset('storage/' . $licenseBanner->video) }}" type="video/mp4">
            </video>
            @endif

            <div class="lc-hero-overlay"></div>
            <div class="lc-hero-content">
                <span class="lc-hero-eyebrow">CERTIFICATIONS &amp; LICENSES</span>
                <h1>{{ $licenseBanner->title ?? '' }}</h1>
                <p>{{ $licenseBanner->description ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== API License Section ===== --}}
        <section class="lc-group-section">
            <div class="lc-bg-decor lc-bg-decor-left">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(140,10) rotate(-12)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="32" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(10,110) rotate(18)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(130,220) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,320) rotate(6)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                </svg>
            </div>

            <div class="lc-group-inner">
                <h2>API License</h2>
                <p class="lc-group-desc">EGTS maintains key American Petroleum Institute requirements and related
                    qualifications supporting the manufacture, machining, threading, and inspection of oilfield
                    components.</p>

                @if ($apiCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($apiCertificates as $certificate)
                    <div class="lc-cert-card">
                        @if ($certificate->image)
                        <div class="lc-cert-image">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        @endif
                        <div class="lc-cert-body">
                            <h3>{{ $certificate->title }}</h3>
                            <p>{{ $certificate->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="lc-empty">No API license certificates added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End API License Section ===== --}}

        {{-- ===== Premium License Section ===== --}}
        <section class="lc-group-section lc-group-section-alt">
            <div class="lc-bg-decor lc-bg-decor-right">
                <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(30,20) rotate(15)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(140,120) rotate(-10)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                    <g transform="translate(20,220) rotate(10)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="12" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(130,320) rotate(12)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(30,420) rotate(18)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                </svg>
            </div>

            <div class="lc-group-inner">
                <h2>Premium License</h2>
                <p class="lc-group-desc">Our premium approvals and customer-specific qualifications support specialized
                    oilfield connection machining and provide additional assurance of consistent technical quality.</p>

                @if ($premiumCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($premiumCertificates as $certificate)
                    <div class="lc-cert-card">
                        @if ($certificate->image)
                        <div class="lc-cert-image">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        @endif
                        <div class="lc-cert-body">
                            <h3>{{ $certificate->title }}</h3>
                            <p>{{ $certificate->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="lc-empty">No premium license certificates added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End Premium License Section ===== --}}

    </main>

    @include('web.layout.footer')

</body>

</html>
