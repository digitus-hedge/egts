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

        {{-- ===== About Us Hero Banner ===== --}}
        <section class="au-hero" style="background-image: url('{{ asset('images/about hero.jpeg') }}');">
            <div class="au-hero-overlay"></div>
            <div class="au-hero-content">
                <h1>Precision, integrity and safety<br>at the heart of everything we do.</h1>
                <p>Erbil Gate Technical Services Ltd. is a specialized oilfield machine shop delivering precision machining, premium threading, repair, remanufacturing and inspection solutions.</p>
            </div>
        </section>
        {{-- ===== End About Us Hero Banner ===== --}}

        {{-- ===== About Us — Built to Support Section ===== --}}
<section class="au-built-section">
    <div class="au-bg-decor au-bg-decor-left">
        <svg viewBox="0 0 220 700" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
        </svg>
    </div>

    <div class="au-bg-decor au-bg-decor-right">
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
            <g transform="translate(140,510) rotate(-20) scale(-1,1) translate(-60,0)">
                <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                <rect x="4" y="38" width="20" height="10" rx="2" />
                <line x1="14" y1="48" x2="14" y2="72" />
                <circle cx="14" cy="80" r="7" />
            </g>
        </svg>
    </div>

    <div class="au-built-inner">
        <div class="au-built-images">
            <img src="{{ asset('images/about 1.jpeg') }}" alt="Offshore Platform" class="au-img-primary">
            <img src="{{ asset('images/about2.jpeg') }}" alt="Field Technician" class="au-img-secondary">
        </div>

        <div class="au-built-content">
            <span class="au-eyebrow">ABOUT EGTS</span>
            <h2>Built to support the demands of the oilfield and energy industry</h2>

            <div class="au-built-text">
                <p>Established in 2019 in Erbil, Kurdistan Region of Iraq, EGTS operates a modern facility designed to provide high-quality machining and technical services for oilfield and energy companies.</p>
                <p>We support drilling contractors, oilfield service companies and energy operators with precision machining, premium thread connections, equipment repair, remanufacturing and inspection services.</p>
                <p>Our commitment is to combine technical expertise, modern equipment and controlled quality processes to deliver reliable results that meet demanding industry requirements.</p>
            </div>
        </div>
    </div>
</section>
{{-- ===== End About Us — Built to Support Section ===== --}}

{{-- ===== About Us — Mission & Vision Section ===== --}}
<section class="au-mv-section">
    <div class="au-bg-decor au-bg-decor-left">
        <svg viewBox="0 0 220 600" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
            <g transform="translate(20,520) rotate(20)">
                <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                <rect x="4" y="38" width="20" height="10" rx="2" />
                <line x1="14" y1="48" x2="14" y2="72" />
                <circle cx="14" cy="80" r="7" />
            </g>
        </svg>
    </div>

    <div class="au-bg-decor au-bg-decor-right">
        <svg viewBox="0 0 220 600" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
            <g transform="translate(140,500) rotate(-20) scale(-1,1) translate(-60,0)">
                <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                <rect x="4" y="38" width="20" height="10" rx="2" />
                <line x1="14" y1="48" x2="14" y2="72" />
                <circle cx="14" cy="80" r="7" />
            </g>
        </svg>
    </div>

    <div class="au-mv-inner">

        {{-- Mission row --}}
        <div class="au-mv-row">
            <div class="au-mv-content">
                <span class="au-eyebrow">MISSION</span>
                <h2>Delivering Quality.<br>Driving Progress</h2>
                <p>Our mission is to deliver high-quality machining, threading, repair, remanufacturing, and inspection services that meet the needs of the oilfield and energy industries. We continuously improve our processes while prioritizing precision, safety, customer satisfaction, and international industry standards.</p>
            </div>
            <div class="au-mv-image">
                <img src="{{ asset('images/about 3.jpeg') }}" alt="Mission - EGTS Technician">
            </div>
        </div>

        {{-- Vision row (image swaps to left on desktop) --}}
        <div class="au-mv-row au-mv-row-reverse">
            <div class="au-mv-content">
                <span class="au-eyebrow">VISION</span>
                <h2>Building the Future of Oilfield Services</h2>
                <p>Our vision is to become a preferred oilfield machine shop and premium threading service provider in the Kurdistan Region and the wider Middle East. We aim to achieve this through advanced technology, skilled professionals, dependable service, innovative solutions, and long-term partnerships built on trust and consistent performance.</p>
            </div>
            <div class="au-mv-image">
                <img src="{{ asset('images/about 4.jpeg') }}" alt="Vision - Oilfield Facility">
            </div>
        </div>

    </div>
</section>
{{-- ===== End About Us — Mission & Vision Section ===== --}}

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

        {{-- ===== About Us — Our Foundation Section ===== --}}
<section class="au-foundation-section">
    <div class="au-bg-decor au-bg-decor-left">
        <svg viewBox="0 0 220 600" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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

    <div class="au-bg-decor au-bg-decor-right">
        <svg viewBox="0 0 220 600" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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

    <div class="au-foundation-inner">
        <span class="au-eyebrow">OUR FOUNDATION</span>
        <h2>Safety, values & Environment (HSE)</h2>
        <p class="au-foundation-sub">We prioritize safety, strong values, and environmental responsibility in every operation.</p>

        <div class="au-foundation-grid">

            <div class="au-foundation-card" style="background-image: url('{{ asset('images/about 5.jpeg') }}');">
                <div class="au-foundation-overlay"></div>
                <div class="au-foundation-content">
                    <h3>Core Values</h3>
                    <p>Integrity, safety, precision and accountability guide every project we undertake, ensuring consistent quality and trust with every client we serve.</p>
                </div>
            </div>

            <div class="au-foundation-card" style="background-image: url('{{ asset('images/about 6.jpeg') }}');">
                <div class="au-foundation-overlay"></div>
                <div class="au-foundation-content">
                    <h3>HSE Commitment</h3>
                    <p>We enforce strict health, safety and environmental protocols across all operations, protecting our people, our clients and the communities we work in.</p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- ===== End About Us — Our Foundation Section ===== --}}

{{-- ===== About Us — Behind the Scenes Section ===== --}}
<section class="au-infra-section">
    <div class="au-infra-inner">
        <span class="au-eyebrow">BEHIND THE SCENES</span>
        <h2>Technical infrastructure<br>built for precision.</h2>
        <p class="au-infra-sub">Our facility combines modern machinery and inspection equipment to support demanding oilfield applications</p>

        <div class="au-infra-carousel">
            <button class="au-infra-arrow au-infra-prev" id="infraPrev" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                </svg>
            </button>

            <div class="au-infra-viewport">
                <div class="au-infra-track" id="infraTrack">
                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-1.webp') }}" alt="CNC Lathes">
                        <h3>CNC Lathes</h3>
                        <p>Modern CNC machining capability for accurate, repeatable component production.</p>
                    </div>

                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-2.webp') }}" alt="Make-up & Break-out Equipment">
                        <h3>Make-up & Break-out Equipment</h3>
                        <p>Controlled connection handling for critical oilfield threading applications.</p>
                    </div>

                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-3.webp') }}" alt="Inspection & Measuring">
                        <h3>Inspection & Measuring</h3>
                        <p>Precision measuring and thread inspection equipment supporting quality assurance.</p>
                    </div>

                    {{-- TEMP: placeholder duplicates for testing slider, replace with real dynamic items later --}}
                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-4.webp') }}" alt="CNC Lathes">
                        <h3>CNC Lathes</h3>
                        <p>Modern CNC machining capability for accurate, repeatable component production.</p>
                    </div>

                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-5.webp') }}" alt="Make-up & Break-out Equipment">
                        <h3>Make-up & Break-out Equipment</h3>
                        <p>Controlled connection handling for critical oilfield threading applications.</p>
                    </div>

                    <div class="au-infra-item">
                        <img src="{{ asset('images/service-6.webp') }}" alt="Inspection & Measuring">
                        <h3>Inspection & Measuring</h3>
                        <p>Precision measuring and thread inspection equipment supporting quality assurance.</p>
                    </div>
                </div>
            </div>

            <button class="au-infra-arrow au-infra-next" id="infraNext" aria-label="Next">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>
    </div>
</section>

<script>
    (function () {
        const track = document.getElementById('infraTrack');
        const prevBtn = document.getElementById('infraPrev');
        const nextBtn = document.getElementById('infraNext');
        const items = track.querySelectorAll('.au-infra-item');

        let currentIndex = 0;

        function getVisibleCount() {
            if (window.innerWidth <= 767) return 1;
            if (window.innerWidth <= 991) return 2;
            return 3;
        }

        function updateSlide() {
            const visibleCount = getVisibleCount();
            const maxIndex = Math.max(0, items.length - visibleCount);
            currentIndex = Math.min(currentIndex, maxIndex);

            const itemWidth = items[0].getBoundingClientRect().width;
            const gap = parseFloat(getComputedStyle(track).gap) || 0;
            const offset = currentIndex * (itemWidth + gap);

            track.style.transform = `translateX(-${offset}px)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        }

        nextBtn.addEventListener('click', function () {
            const visibleCount = getVisibleCount();
            const maxIndex = Math.max(0, items.length - visibleCount);
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlide();
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlide();
            }
        });

        window.addEventListener('resize', updateSlide);
        updateSlide();
    })();
</script>
{{-- ===== End About Us — Behind the Scenes Section ===== --}}

{{-- ===== About Us — Closing CTA Section ===== --}}
<section class="au-closing-section">
    <div class="au-bg-decor au-bg-decor-left">
        <svg viewBox="0 0 220 400" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
            <g transform="translate(20,310) rotate(6)">
                <circle cx="28" cy="28" r="24" />
                <circle cx="28" cy="28" r="9" />
                <line x1="28" y1="0" x2="28" y2="7" />
                <line x1="28" y1="49" x2="28" y2="56" />
                <line x1="0" y1="28" x2="7" y2="28" />
                <line x1="49" y1="28" x2="56" y2="28" />
            </g>
        </svg>
    </div>

    <div class="au-bg-decor au-bg-decor-right">
        <svg viewBox="0 0 220 400" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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
        </svg>
    </div>

    <div class="au-closing-inner">
        <div class="au-closing-image">
            <img src="{{ asset('images/contact.webp') }}" alt="EGTS Technician at Work">
        </div>

        <div class="au-closing-content">
            <h2>Built on quality.<br>Driven by trust.</h2>
            <p>Partner with EGTS for precision machining, premium threading, repair, remanufacturing, and technical inspection services. With advanced capabilities, experienced professionals, and a strong commitment to quality and safety, we deliver reliable, efficient, and industry-focused solutions designed to meet demanding standards and keep your operations performing at their best.</p>
            <a href="{{ url('/contact') }}" class="au-closing-btn">Contact Our Team</a>
        </div>
    </div>
</section>
{{-- ===== End About Us — Closing CTA Section ===== --}}

    </main>

    @include('web.layout.footer')

</body>

</html>
