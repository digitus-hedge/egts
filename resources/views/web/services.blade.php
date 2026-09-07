<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="page-hero" style="background-image: url('{{ asset('images/services-banner.webp') }}');">
            <div class="page-hero-overlay"></div>
            <div class="page-hero-content">
                <h1>Inspection Expertise That Keeps<br>Operations Moving</h1>
                <p>Professional inspection, NDT, and technical support services helping oil and gas operators maintain
                    equipment integrity, improve reliability, and operate with greater confidence.</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}
        {{-- ===== Our Technical Capabilities ===== --}}
        <section class="capabilities-section">
            <div class="capabilities-bg-decor capabilities-bg-decor-left">
                <svg viewBox="0 0 220 900" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
                    <g transform="translate(140,440) rotate(-15)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                    <g transform="translate(20,540) rotate(20)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="72" />
                        <circle cx="14" cy="80" r="7" />
                    </g>
                    <g transform="translate(130,640) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,740) rotate(10)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                </svg>
            </div>

            <div class="capabilities-bg-decor capabilities-bg-decor-right">
                <svg viewBox="0 0 220 900" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
                    <g transform="translate(140,510) rotate(-20) scale(-1,1) translate(-60,0)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="72" />
                        <circle cx="14" cy="80" r="7" />
                    </g>
                    <g transform="translate(20,610) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(140,710) rotate(14)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                </svg>
            </div>

            <div class="capabilities-inner">

                <div class="capabilities-header">
                    <div class="capabilities-header-left">
                        <span class="capabilities-eyebrow">OUR TECHNICAL CAPABILITIES</span>
                        <h2>Inspection expertise for demanding oil & gas operations.</h2>
                    </div>
                    <div class="capabilities-header-right">
                        <p>Focused technical services covering equipment inspection, NDT, quality control, repair
                            support and specialist inspection facilities.</p>
                    </div>
                </div>

                <div class="capabilities-grid">
                    @foreach ($services as $service)
                    <div class="capability-card">
                        @if ($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        @endif
                        <div class="capability-body">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                            <a href="{{ url('/services/' . $service->slug) }}" class="capability-link">
                                View Services
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- ===== End Our Technical Capabilities ===== --}}

        {{-- ===== Need Inspection Support CTA Section ===== --}}
        <section class="services-cta-section">
            <div class="services-cta-inner">
                <div class="services-cta-image">
                    <img src="{{ asset('images/about 9.jpeg') }}" alt="Technician performing inspection">
                </div>

                <div class="services-cta-content">
                    <h2>Need reliable inspection support?</h2>
                    <p>Talk to EGTS about your equipment, inspection requirements and technical challenges. Our team can
                        help identify the right inspection approach for your operation.</p>
                    <a href="{{ url('/contact') }}" class="services-cta-btn">Request Consultation</a>
                </div>
            </div>
        </section>
        {{-- ===== End Need Inspection Support CTA Section ===== --}}

    </main>

    @include('web.layout.footer')

</body>

</html>
