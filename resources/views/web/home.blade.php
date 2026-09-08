<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EGTS - Erbil Gate Technical Services</title>
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Hero Banner Section ===== --}}
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        @php
            $bannerImages = collect([$banner->image_1 ?? null, $banner->image_2 ?? null, $banner->image_3 ?? null])
                ->filter()
                ->map(fn ($img) => asset('storage/' . $img))
                ->values();
            $bannerVideo = $banner->video ?? null;
            $heroTitle = $banner->title ?? '';
            $heroDescription = $banner->description ?? '';
            $fallbackImage = $bannerImages->first() ?? '';
        @endphp

        <section class="hero-banner" id="heroBanner" @if($fallbackImage) style="background-image: url('{{ $fallbackImage }}');" @endif>

            @if ($bannerVideo)
                <video class="hero-video-bg" autoplay muted loop playsinline>
                    <source src="{{ asset('storage/' . $bannerVideo) }}" type="video/mp4">
                </video>
            @endif

            <div class="hero-overlay"></div>

            <div class="hero-content">
                <h1>{{ $heroTitle }}</h1>
                <p>{{ $heroDescription }}</p>
                <a href="{{ url('/services') }}" class="hero-cta">
                    Explore Our Services
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>
        </section>

        @if (!$bannerVideo && $bannerImages->count() > 1)
        <script>
            (function () {
                const images = @json($bannerImages);
                let index = 0;
                const heroEl = document.getElementById('heroBanner');

                setInterval(() => {
                    index = (index + 1) % images.length;
                    heroEl.style.backgroundImage = `url('${images[index]}')`;
                }, 4000);
            })();
        </script>
        @endif
        {{-- ===== End Hero Banner Section ===== --}}

        {{-- ===== About Section ===== --}}
        <section class="about-section">
            <div class="about-bg-decor about-bg-decor-left">
                <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                    {{-- Pipe wrench --}}
                    <g transform="translate(10,30)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="90" />
                        <circle cx="14" cy="98" r="8" />
                    </g>

                    {{-- Valve / flange --}}
                    <g transform="translate(20,150)">
                        <circle cx="30" cy="30" r="26" />
                        <circle cx="30" cy="30" r="10" />
                        <line x1="30" y1="0" x2="30" y2="8" />
                        <line x1="30" y1="52" x2="30" y2="60" />
                        <line x1="0" y1="30" x2="8" y2="30" />
                        <line x1="52" y1="30" x2="60" y2="30" />
                    </g>

                    {{-- Pipeline w/ flanges --}}
                    <g transform="translate(0,270)">
                        <line x1="0" y1="20" x2="90" y2="20" />
                        <line x1="0" y1="34" x2="90" y2="34" />
                        <rect x="20" y="12" width="8" height="30" />
                        <rect x="60" y="12" width="8" height="30" />
                    </g>

                    {{-- Oil drop --}}
                    <g transform="translate(30,360)">
                        <path d="M20 0 C30 18 38 30 38 42 C38 55 29 64 20 64 C11 64 2 55 2 42 C2 30 10 18 20 0 Z" />
                    </g>

                    {{-- Bolt cluster --}}
                    <g transform="translate(15,460)">
                        <circle cx="10" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="30" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="50" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="10" cy="30" r="4" fill="currentColor" stroke="none" />
                        <circle cx="30" cy="30" r="4" fill="currentColor" stroke="none" />
                        <circle cx="50" cy="30" r="4" fill="currentColor" stroke="none" />
                    </g>

                    {{-- Drill bit --}}
                    <g transform="translate(20,540)">
                        <path d="M20 0 L30 0 L30 40 L25 60 L20 40 Z" />
                        <line x1="20" y1="10" x2="30" y2="10" />
                        <line x1="20" y1="20" x2="30" y2="20" />
                        <line x1="20" y1="30" x2="30" y2="30" />
                    </g>

                    {{-- Gauge/meter --}}
                    <g transform="translate(15,630)">
                        <circle cx="25" cy="25" r="22" />
                        <line x1="25" y1="25" x2="35" y2="12" />
                        <circle cx="25" cy="25" r="3" fill="currentColor" stroke="none" />
                    </g>
                </svg>
            </div>

            <div class="about-bg-decor about-bg-decor-right">
                <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                    {{-- Gauge/meter --}}
                    <g transform="translate(150,20)">
                        <circle cx="25" cy="25" r="22" />
                        <line x1="25" y1="25" x2="14" y2="12" />
                        <circle cx="25" cy="25" r="3" fill="currentColor" stroke="none" />
                    </g>

                    {{-- Valve / flange --}}
                    <g transform="translate(130,100)">
                        <circle cx="30" cy="30" r="26" />
                        <circle cx="30" cy="30" r="10" />
                        <line x1="30" y1="0" x2="30" y2="8" />
                        <line x1="30" y1="52" x2="30" y2="60" />
                        <line x1="0" y1="30" x2="8" y2="30" />
                        <line x1="52" y1="30" x2="60" y2="30" />
                    </g>

                    {{-- Pipeline w/ flanges --}}
                    <g transform="translate(130,220)">
                        <line x1="0" y1="20" x2="90" y2="20" />
                        <line x1="0" y1="34" x2="90" y2="34" />
                        <rect x="20" y="12" width="8" height="30" />
                        <rect x="60" y="12" width="8" height="30" />
                    </g>

                    {{-- Oil drop --}}
                    <g transform="translate(155,300)">
                        <path d="M20 0 C30 18 38 30 38 42 C38 55 29 64 20 64 C11 64 2 55 2 42 C2 30 10 18 20 0 Z" />
                    </g>

                    {{-- Bolt cluster --}}
                    <g transform="translate(150,400)">
                        <circle cx="10" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="30" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="50" cy="10" r="4" fill="currentColor" stroke="none" />
                        <circle cx="10" cy="30" r="4" fill="currentColor" stroke="none" />
                        <circle cx="30" cy="30" r="4" fill="currentColor" stroke="none" />
                        <circle cx="50" cy="30" r="4" fill="currentColor" stroke="none" />
                    </g>

                    {{-- Pipe wrench (mirrored) --}}
                    <g transform="translate(160,470) scale(-1,1) translate(-60,0)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="90" />
                        <circle cx="14" cy="98" r="8" />
                    </g>

                    {{-- Drill bit --}}
                    <g transform="translate(150,590)">
                        <path d="M20 0 L30 0 L30 40 L25 60 L20 40 Z" />
                        <line x1="20" y1="10" x2="30" y2="10" />
                        <line x1="20" y1="20" x2="30" y2="20" />
                        <line x1="20" y1="30" x2="30" y2="30" />
                    </g>
                </svg>
            </div>
            <div class="about-inner">
                <div class="about-image">
                    @if ($about && $about->image)
                        <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}">
                    @endif
                </div>
                <div class="about-content">
                    <span class="about-eyebrow">ABOUT EGTS</span>
                    <h2>{{ $about->title ?? '' }}</h2>
                    <div class="about-text">
                        {!! $about->description ?? '' !!}
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End About Section ===== --}}

        {{-- ===== Stats Strip Section ===== --}}
        <section class="stats-strip" style="background-image: url('{{ asset('images/operation.webp') }}');">
            <div class="stats-overlay"></div>

            <div class="stats-inner">
                @foreach ($stat->items ?? [] as $item)
                    <div class="stat-item">
                        <span class="stat-number">{{ $item['value'] ?? '' }}</span>
                        <span class="stat-label">{{ $item['label'] ?? '' }}</span>
                        <span class="stat-sub">{{ $item['description'] ?? '' }}</span>
                    </div>
                @endforeach
            </div>
        </section>
        {{-- ===== End Stats Strip Section ===== --}}

        {{-- ===== Services Section ===== --}}
        <section class="services-section">

            <div class="services-inner">

                {{-- Left decor — sticky, scattered --}}
                <div class="services-bg-decor services-bg-decor-left">
                    <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                        {{-- Gauge/meter --}}
                        <g transform="translate(140,0) rotate(-12)">
                            <circle cx="22" cy="22" r="20" />
                            <line x1="22" y1="22" x2="32" y2="10" />
                            <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Pipe wrench --}}
                        <g transform="translate(10,60) rotate(18)">
                            <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                            <rect x="4" y="38" width="20" height="10" rx="2" />
                            <line x1="14" y1="48" x2="14" y2="72" />
                            <circle cx="14" cy="80" r="7" />
                        </g>

                        {{-- Bolt cluster --}}
                        <g transform="translate(130,140) rotate(-8)">
                            <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="44" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="44" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Valve / flange --}}
                        <g transform="translate(20,210) rotate(6)">
                            <circle cx="28" cy="28" r="24" />
                            <circle cx="28" cy="28" r="9" />
                            <line x1="28" y1="0" x2="28" y2="7" />
                            <line x1="28" y1="49" x2="28" y2="56" />
                            <line x1="0" y1="28" x2="7" y2="28" />
                            <line x1="49" y1="28" x2="56" y2="28" />
                        </g>

                        {{-- Hexagon --}}
                        <g transform="translate(150,300) rotate(20)">
                            <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                        </g>

                        {{-- Pipeline w/ flanges --}}
                        <g transform="translate(0,340) rotate(-4)">
                            <line x1="0" y1="16" x2="80" y2="16" />
                            <line x1="0" y1="28" x2="80" y2="28" />
                            <rect x="18" y="10" width="7" height="24" />
                            <rect x="54" y="10" width="7" height="24" />
                        </g>

                        {{-- Oil drop --}}
                        <g transform="translate(40,420) rotate(-15)">
                            <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                        </g>

                        {{-- Drill bit --}}
                        <g transform="translate(120,460) rotate(25)">
                            <path d="M17 0 L26 0 L26 34 L21.5 51 L17 34 Z" />
                            <line x1="17" y1="9" x2="26" y2="9" />
                            <line x1="17" y1="18" x2="26" y2="18" />
                            <line x1="17" y1="27" x2="26" y2="27" />
                        </g>

                        {{-- Small gear --}}
                        <g transform="translate(10,540) rotate(10)">
                            <circle cx="20" cy="20" r="18" />
                            <circle cx="20" cy="20" r="7" />
                        </g>

                        {{-- Bolt cluster --}}
                        <g transform="translate(140,580) rotate(15)">
                            <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Hexagon small --}}
                        <g transform="translate(30,630) rotate(-10)">
                            <polygon points="18,0 33,9 33,27 18,36 3,27 3,9" />
                        </g>

                    </svg>
                </div>

                {{-- Left sticky column --}}
                <div class="services-left">
                    <span class="services-eyebrow">OUR SERVICES</span>
                    <h2>{{ $serviceSection->heading }}</h2>
                    <p>{{ $serviceSection->description }}</p>
                </div>

                {{-- Right scrolling grid --}}
                <div class="services-right">
                    <div class="services-grid">

                        @foreach ($services as $service)
                            <div class="service-card">
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @endif
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->description }}</p>
                                <a href="{{ url('/services/' . $service->slug) }}" class="service-link">
                                    READ MORE
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Right decor — sticky, scattered --}}
                <div class="services-bg-decor services-bg-decor-right">
                    <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                        {{-- Hexagon --}}
                        <g transform="translate(30,0) rotate(15)">
                            <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                        </g>

                        {{-- Valve / flange --}}
                        <g transform="translate(140,50) rotate(-10)">
                            <circle cx="28" cy="28" r="24" />
                            <circle cx="28" cy="28" r="9" />
                            <line x1="28" y1="0" x2="28" y2="7" />
                            <line x1="28" y1="49" x2="28" y2="56" />
                            <line x1="0" y1="28" x2="7" y2="28" />
                            <line x1="49" y1="28" x2="56" y2="28" />
                        </g>

                        {{-- Gauge/meter --}}
                        <g transform="translate(20,150) rotate(10)">
                            <circle cx="22" cy="22" r="20" />
                            <line x1="22" y1="22" x2="12" y2="10" />
                            <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Bolt cluster --}}
                        <g transform="translate(130,220) rotate(12)">
                            <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="44" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="44" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Pipeline w/ flanges --}}
                        <g transform="translate(120,290) rotate(6)">
                            <line x1="0" y1="16" x2="80" y2="16" />
                            <line x1="0" y1="28" x2="80" y2="28" />
                            <rect x="18" y="10" width="7" height="24" />
                            <rect x="54" y="10" width="7" height="24" />
                        </g>

                        {{-- Oil drop --}}
                        <g transform="translate(30,360) rotate(18)">
                            <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                        </g>

                        {{-- Pipe wrench (mirrored) --}}
                        <g transform="translate(140,420) rotate(-20) scale(-1,1) translate(-60,0)">
                            <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                            <rect x="4" y="38" width="20" height="10" rx="2" />
                            <line x1="14" y1="48" x2="14" y2="72" />
                            <circle cx="14" cy="80" r="7" />
                        </g>

                        {{-- Small gear --}}
                        <g transform="translate(30,500) rotate(-14)">
                            <circle cx="20" cy="20" r="18" />
                            <circle cx="20" cy="20" r="7" />
                        </g>

                        {{-- Drill bit --}}
                        <g transform="translate(130,540) rotate(-25)">
                            <path d="M17 0 L26 0 L26 34 L21.5 51 L17 34 Z" />
                            <line x1="17" y1="9" x2="26" y2="9" />
                            <line x1="17" y1="18" x2="26" y2="18" />
                            <line x1="17" y1="27" x2="26" y2="27" />
                        </g>

                        {{-- Bolt cluster --}}
                        <g transform="translate(20,600) rotate(-8)">
                            <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                            <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        </g>

                        {{-- Hexagon small --}}
                        <g transform="translate(150,630) rotate(22)">
                            <polygon points="18,0 33,9 33,27 18,36 3,27 3,9" />
                        </g>

                    </svg>
                </div>

            </div>
        </section>
        {{-- ===== End Services Section ===== --}}

        {{-- ===== Clients Section ===== --}}
        <section class="clients-section">
            <div class="clients-inner">

                <div class="clients-left">
                    <span class="clients-eyebrow">OUR VALUED CLIENTS</span>
                    <h2>{{ $clientSection->title ?? '' }}</h2>
                    <p>{{ $clientSection->description ?? '' }}</p>
                </div>

                <div class="clients-right">
                    <div class="clients-track">
                        @php
                            $clientImages = $clientSection->images ?? [];
                        @endphp

                        {{-- First set --}}
                        @foreach ($clientImages as $img)
                            <div class="client-logo">
                                <img src="{{ asset('storage/' . $img) }}" alt="Client Logo">
                            </div>
                        @endforeach

                        {{-- Duplicate set for seamless loop --}}
                        @if (count($clientImages) > 1)
                            @foreach ($clientImages as $img)
                                <div class="client-logo">
                                    <img src="{{ asset('storage/' . $img) }}" alt="Client Logo">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </section>
        {{-- ===== End Clients Section ===== --}}

        {{-- ===== Why Choose Us Section ===== --}}
        <section class="why-section">
            <div class="why-bg-decor why-bg-decor-left">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(140,10) rotate(-12)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="32" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(10,90) rotate(18)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(130,180) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,260) rotate(6)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                    <g transform="translate(140,360) rotate(-15)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                </svg>
            </div>

            <div class="why-bg-decor why-bg-decor-right">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(30,20) rotate(15)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(140,110) rotate(-10)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                    <g transform="translate(20,210) rotate(10)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="12" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(130,290) rotate(12)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(30,380) rotate(18)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                </svg>
            </div>

            <div class="why-inner">
                <span class="why-eyebrow">WHY CHOOSE EGTS</span>
                <h2>{{ $whyChooseUs->heading ?? '' }}</h2>
                <p class="why-sub">{{ $whyChooseUs->description ?? '' }}</p>

                <div class="why-grid">

                    <div class="why-card" @if($whyChooseUs?->mission_image) style="background-image: url('{{ asset('storage/' . $whyChooseUs->mission_image) }}');" @endif>
                        <div class="why-card-overlay"></div>
                        <div class="why-card-content">
                            <h3>Mission</h3>
                            <p>{{ $whyChooseUs->mission_description ?? '' }}</p>
                        </div>
                    </div>

                    <div class="why-card" @if($whyChooseUs?->vision_image) style="background-image: url('{{ asset('storage/' . $whyChooseUs->vision_image) }}');" @endif>
                        <div class="why-card-overlay"></div>
                        <div class="why-card-content">
                            <h3>Vision</h3>
                            <p>{{ $whyChooseUs->vision_description ?? '' }}</p>
                        </div>
                    </div>

                    <div class="why-card" @if($whyChooseUs?->values_image) style="background-image: url('{{ asset('storage/' . $whyChooseUs->values_image) }}');" @endif>
                        <div class="why-card-overlay"></div>
                        <div class="why-card-content">
                            <h3>Values</h3>
                            <p>{{ $whyChooseUs->values_description ?? '' }}</p>
                        </div>
                    </div>

                    <div class="why-card why-card-commitment">
                        <h3>Commitment</h3>
                        <p>{{ $whyChooseUs->commitment_description ?? '' }}</p>
                    </div>

                </div>
            </div>
        </section>
        {{-- ===== End Why Choose Us Section ===== --}}

        {{-- ===== Certifications Section ===== --}}
        <section class="certs-section">
            <div class="certs-inner">
                <h2>Certifications & Licenses</h2>
                <p>EGTS places quality at the center of every operation, with inspection processes designed to verify
                    product requirements and customer expectations.</p>

                <div class="certs-grid">
                    <div class="cert-item">
                        <img src="{{ asset('images/Certifications 1.webp') }}" alt="API Q1 Certification">
                    </div>

                    <div class="cert-item">
                        <img src="{{ asset('images/Certifications 2.webp') }}" alt="API 5B Certification">
                    </div>

                    <div class="cert-item">
                        <img src="{{ asset('images/Certifications 3.webp') }}" alt="ISO 45001:2018 Certification">
                    </div>

                    <div class="cert-item">
                        <img src="{{ asset('images/Certifications 4.webp') }}" alt="ISO 9001:2015 Certification">
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Certifications Section ===== --}}

        {{-- ===== Closing CTA Section ===== --}}
        <section class="closing-section">
            <div class="closing-bg-decor closing-bg-decor-left">
                <svg viewBox="0 0 220 620" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(140,10) rotate(-12)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="32" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(10,100) rotate(18)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(130,200) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,300) rotate(6)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                    <g transform="translate(140,420) rotate(-15)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                    <g transform="translate(20,510) rotate(20)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="72" />
                        <circle cx="14" cy="80" r="7" />
                    </g>
                </svg>
            </div>

            <div class="closing-bg-decor closing-bg-decor-right">
                <svg viewBox="0 0 220 620" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
                </svg>
            </div>

            <div class="closing-inner">
                <div class="closing-image">
                    <img src="{{ asset('images/contact.webp') }}" alt="EGTS Technician at Work">
                </div>

                <div class="closing-content">
                    <h2>Powering Precision.<br>Delivering Performance.<br>Building Trust</h2>
                    <p>Partner with EGTS for precision oilfield machining, premium threading, equipment repair,
                        remanufacturing, and comprehensive technical inspection services. With advanced capabilities,
                        experienced professionals, and a strong commitment to quality, we deliver reliable, efficient,
                        and high-performance solutions engineered to meet demanding international industry standards.
                        From critical components to specialized oilfield requirements, EGTS is committed to keeping your
                        operations safe, productive, and performing at their best.</p>
                    <a href="{{ url('/contact') }}" class="closing-cta-btn">Contact Our Team</a>
                </div>
            </div>
        </section>
        {{-- ===== End Closing CTA Section ===== --}}

    </main>

    @include('web.layout.footer')

</body>

</html>
