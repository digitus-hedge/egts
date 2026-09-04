<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="page-hero" style="background-image: url('{{ asset('images/about-us-banner.webp') }}');">
            <div class="page-hero-overlay"></div>
            <div class="page-hero-content">
                <span class="page-hero-eyebrow">ABOUT US</span>
                <h1>Precision Engineering. Proven Trust.</h1>
                <p>Detailed company mission, vision, core values, and health &amp; safety (HSE) commitments.</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Company at a Glance (Reworked) ===== --}}
        <section class="glance-section">
            <div class="glance-bg-decor glance-bg-decor-left">
                <svg viewBox="0 0 220 560" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
                </svg>
            </div>

            <div class="glance-bg-decor glance-bg-decor-right">
                <svg viewBox="0 0 220 560" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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

            <div class="glance-inner">
                <div class="glance-left">
                    <span class="glance-eyebrow">EXECUTIVE SUMMARY</span>
                    <h2>Company at a Glance</h2>
                    <p>
                        Erbil Gate Technical Services Ltd. (EGTS) was established in Erbil in 2019. In a short
                        period of time, EGTS has become one of the region's most trusted names in precision
                        machining, threading, and technical inspection services for the oil and gas industry.
                        Our reputation is built on consistent standards, regional expertise, and current
                        leadership across our operations, positioning EGTS as a growing regional and
                        international name.
                    </p>
                    <div class="glance-location">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Ankawa Industrial Area, Erbil, Iraq</span>
                    </div>
                </div>

                <div class="glance-right">
                    <div class="glance-stat-card">
                        <span class="glance-stat-number">2019</span>
                        <span class="glance-stat-label">Established</span>
                    </div>
                    <div class="glance-stat-card">
                        <span class="glance-stat-number">15+</span>
                        <span class="glance-stat-label">Years Combined Team Experience</span>
                    </div>
                    <div class="glance-stat-card">
                        <span class="glance-stat-number">100%</span>
                        <span class="glance-stat-label">Regional &amp; International Compliance</span>
                    </div>
                    <div class="glance-stat-card">
                        <span class="glance-stat-number">5+</span>
                        <span class="glance-stat-label">Certifications Held</span>
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Company at a Glance ===== --}}

        {{-- ===== Quality Advantage / Certifications ===== --}}
        <section class="quality-section">
            <div class="quality-inner">
                <span class="quality-eyebrow">CERTIFIED STANDARDS</span>
                <h2>Our Quality Advantage</h2>
                <p>Licensed for premium connections (TMK, Voestalpine, Interpipe, etc.)</p>

                <div class="quality-grid">
                    <div class="quality-item">
                        <img src="{{ asset('images/Certifications 1.webp') }}" alt="API Q1 Certification">
                    </div>
                    <div class="quality-item">
                        <img src="{{ asset('images/Certifications 2.webp') }}" alt="API 7-2 Certification">
                    </div>
                    <div class="quality-item">
                        <img src="{{ asset('images/Certifications 3.webp') }}" alt="API 5B Certification">
                    </div>
                    <div class="quality-item">
                        <img src="{{ asset('images/Certifications 4.webp') }}" alt="ISO 9001:2015 Certification">
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Quality Advantage ===== --}}

        {{-- ===== Core Values & HSE Commitment ===== --}}
        <section class="foundation-section">
            <div class="foundation-bg-decor foundation-bg-decor-left">
                <svg viewBox="0 0 220 560" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
                </svg>
            </div>

            <div class="foundation-inner">
                <span class="foundation-eyebrow">SAFETY, VALUES &amp; ENVIRONMENT</span>
                <h2>Our Foundation</h2>
                <p class="foundation-sub">The principles that guide every project, and the commitments that keep our
                    people and environment protected.</p>

                <div class="foundation-grid">

                    {{-- Core Values --}}
                    <div class="foundation-col">
                        <h3>Core Values</h3>

                        <div class="values-grid">
                            <div class="value-card value-card-1">
                                <span class="value-num">01</span>
                                <div class="value-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </div>
                                <span class="value-title">Integrity</span>
                                <span class="value-desc">Honest, transparent operations in every engagement.</span>
                            </div>

                            <div class="value-card value-card-2">
                                <span class="value-num">02</span>
                                <div class="value-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                    </svg>
                                </div>
                                <span class="value-title">Safety</span>
                                <span class="value-desc">Protecting our people is the first priority, always.</span>
                            </div>

                            <div class="value-card value-card-3">
                                <span class="value-num">03</span>
                                <div class="value-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="12" r="9" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3" />
                                    </svg>
                                </div>
                                <span class="value-title">Innovation</span>
                                <span class="value-desc">Modern methods and equipment for better results.</span>
                            </div>

                            <div class="value-card value-card-4">
                                <span class="value-num">04</span>
                                <div class="value-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="4" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8" />
                                    </svg>
                                </div>
                                <span class="value-title">Customer Commitment</span>
                                <span class="value-desc">Dependable service built around client needs.</span>
                            </div>

                            <div class="value-card value-card-5">
                                <span class="value-num">05</span>
                                <div class="value-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6M20 20v-6h-6" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15a8 8 0 0014.5 4M19.5 9A8 8 0 005 5" />
                                    </svg>
                                </div>
                                <span class="value-title">Continuous Improvement</span>
                                <span class="value-desc">Always refining our process and performance.</span>
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="foundation-divider">
                        <span class="foundation-divider-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </span>
                    </div>

                    {{-- HSE Commitment --}}
                    <div class="foundation-col hse-col">
                        <h3>HSE Commitment</h3>

                        <div class="hse-box">
                            <div class="hse-pattern"></div>

                            <div class="hse-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                </svg>
                            </div>

                            <span class="hse-badge">ZERO INCIDENT TARGET</span>
                            <span class="hse-headline">Zero Harm is Our Priority</span>
                            <p class="hse-lead">Every process at EGTS is designed around the wellbeing of our people,
                                our partners, and the environment we operate in.</p>

                            <ul class="hse-list">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" /></svg>
                                    Safe Operations
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" /></svg>
                                    Environmental Protection
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" /></svg>
                                    Regulatory Compliance
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- ===== End Core Values & HSE Commitment ===== --}}

        {{-- ===== Behind the Scenes / Technical Infrastructure ===== --}}
        <section class="infra-section">
            <div class="infra-inner">
                <span class="infra-eyebrow">OUR TECHNICAL INFRASTRUCTURE</span>
                <h2>Behind the Scenes</h2>

                <div class="infra-grid">
                    <div class="infra-item">
                        <img src="{{ asset('images/service-1.webp') }}" alt="CNC Lathes">
                        <span>CNC Lathes</span>
                    </div>
                    <div class="infra-item">
                        <img src="{{ asset('images/service-2.webp') }}" alt="Make-Up / Break-Out Equipment">
                        <span>Make-Up / Break-Out Equipment</span>
                    </div>
                    <div class="infra-item">
                        <img src="{{ asset('images/service-3.webp') }}" alt="Precision Measuring Instruments">
                        <span>Precision Measuring Instruments</span>
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Behind the Scenes ===== --}}

    </main>

    @include('web.layout.footer')

</body>

</html>
