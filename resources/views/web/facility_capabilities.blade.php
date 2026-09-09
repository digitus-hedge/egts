<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility & Capabilities - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facility.css') }}">
</head>
<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="fc-hero" @if($facilityBanner?->banner_image) style="background-image: url('{{ asset('storage/' . $facilityBanner->banner_image) }}');" @endif>
            <div class="fc-hero-overlay"></div>
            <div class="fc-hero-content">
                <h1>{{ $facilityBanner->banner_title ?? '' }}</h1>
                <p>{{ $facilityBanner->banner_description ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Ankawa Operations & Infrastructure ===== --}}
        <section class="fc-narrative-section">
            <div class="fc-bg-decor fc-bg-decor-left">
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
                    <g transform="translate(140,440) rotate(-15)">
                        <path d="M18 0 C27 16 34 27 34 38 C34 49 26 57 18 57 C10 57 2 49 2 38 C2 27 9 16 18 0 Z" />
                    </g>
                </svg>
            </div>

            <div class="fc-bg-decor fc-bg-decor-right">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
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

            <div class="fc-narrative-inner">
                <span class="fc-section-eyebrow">ANKAWA OPERATIONS &amp; INFRASTRUCTURE</span>

                <div class="fc-narrative-grid">
                    <div class="fc-narrative-col">
                        <h3>{{ $facilityBanner->operations_heading ?? 'Facility Narrative' }}</h3>
                        <p>{{ $facilityBanner->operations_description ?? '' }}</p>
                    </div>

                    <div class="fc-narrative-col">
                        <h3>{{ $facilityBanner->infrastructure_title ?? 'Infrastructure Highlights' }}</h3>
                        <div class="fc-highlights-rich">
                            {!! $facilityBanner->infrastructure_description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Ankawa Operations & Infrastructure ===== --}}

        {{-- ===== Advanced CNC Infrastructure / Machinery Gallery ===== --}}
        @if ($machines->count())
        <section class="fc-machinery-section">
            <div class="fc-bg-decor fc-bg-decor-left">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(20,20) rotate(20)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="72" />
                        <circle cx="14" cy="80" r="7" />
                    </g>
                    <g transform="translate(130,140) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,240) rotate(6)">
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

            <div class="fc-bg-decor fc-bg-decor-right">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(30,30) rotate(15)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(140,140) rotate(-10)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="12" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(30,250) rotate(12)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(130,360) rotate(-20) scale(-1,1) translate(-60,0)">
                        <path d="M10 40 L10 10 Q10 0 20 0 L40 0 Q50 0 50 10 L50 20" fill="none" />
                        <rect x="4" y="38" width="20" height="10" rx="2" />
                        <line x1="14" y1="48" x2="14" y2="72" />
                        <circle cx="14" cy="80" r="7" />
                    </g>
                </svg>
            </div>

            <div class="fc-machinery-inner">
                <span class="fc-section-eyebrow">ADVANCES CNC INFRASTRUCTURE</span>
                <h2>Machine Gallery</h2>

                <div class="fc-carousel">
                    <button type="button" class="fc-carousel-arrow fc-carousel-prev" data-target="machineTrack">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                    </button>

                    <div class="fc-carousel-viewport">
                        <div class="fc-carousel-track" id="machineTrack">
                            @foreach ($machines as $machine)
                                <div class="fc-machinery-card fc-carousel-item">
                                    @if ($machine->image)
                                        <img src="{{ asset('storage/' . $machine->image) }}" alt="{{ $machine->title }}">
                                    @endif
                                    <div class="fc-machinery-body">
                                        <h3>{{ $machine->title }}</h3>
                                        <p>{{ $machine->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="fc-carousel-arrow fc-carousel-next" data-target="machineTrack">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </section>
        @endif
        {{-- ===== End Machinery Gallery ===== --}}

        {{-- ===== Precision Measuring & Inspection Tools ===== --}}
        @if ($tools->count())
        <section class="fc-qc-section">
            <div class="fc-bg-decor fc-bg-decor-left">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(140,20) rotate(-12)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="32" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,130) rotate(18)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(130,250) rotate(-8)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(20,360) rotate(6)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                </svg>
            </div>

            <div class="fc-bg-decor fc-bg-decor-right">
                <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(30,30) rotate(15)">
                        <polygon points="26,0 48,13 48,39 26,52 4,39 4,13" />
                    </g>
                    <g transform="translate(140,150) rotate(-10)">
                        <circle cx="28" cy="28" r="24" />
                        <circle cx="28" cy="28" r="9" />
                        <line x1="28" y1="0" x2="28" y2="7" />
                        <line x1="28" y1="49" x2="28" y2="56" />
                        <line x1="0" y1="28" x2="7" y2="28" />
                        <line x1="49" y1="28" x2="56" y2="28" />
                    </g>
                    <g transform="translate(20,270) rotate(10)">
                        <circle cx="22" cy="22" r="20" />
                        <line x1="22" y1="22" x2="12" y2="10" />
                        <circle cx="22" cy="22" r="3" fill="currentColor" stroke="none" />
                    </g>
                    <g transform="translate(130,380) rotate(12)">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="8" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="8" cy="26" r="3.5" fill="currentColor" stroke="none" />
                        <circle cx="26" cy="26" r="3.5" fill="currentColor" stroke="none" />
                    </g>
                </svg>
            </div>

            <div class="fc-qc-inner">
                <span class="fc-section-eyebrow">PRECISION MEASURING & INSPECTION TOOLS</span>

                <div class="fc-carousel">
                    <button type="button" class="fc-carousel-arrow fc-carousel-prev" data-target="toolTrack">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                    </button>

                    <div class="fc-carousel-viewport">
                        <div class="fc-carousel-track" id="toolTrack">
                            @foreach ($tools as $tool)
                                <div class="fc-qc-card fc-carousel-item">
                                    @if ($tool->image)
                                        <div class="fc-qc-image">
                                            <img src="{{ asset('storage/' . $tool->image) }}" alt="{{ $tool->title }}">
                                        </div>
                                    @endif
                                    <h3>{{ $tool->title }}</h3>
                                    <p>{{ $tool->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="fc-carousel-arrow fc-carousel-next" data-target="toolTrack">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                    </button>
                </div>
            </div>
        </section>
        @endif
        {{-- ===== End QC & Inspection Tools ===== --}}

        {{-- ===== Closing CTA Section ===== --}}
        <section class="fc-closing-section">
            <div class="fc-closing-inner">
                <div class="fc-closing-image">
                    <img src="{{ asset('images/facility-closing.webp') }}" alt="EGTS Technician">
                </div>

                <div class="fc-closing-content">
                    <h2>Looking for precision<br>technical capabilities?</h2>
                    <p>Talk to EGTS about your machining, threading, inspection, and other precision engineering requirements. Our experienced team is ready to understand your needs and provide reliable, accurate, and efficient solutions tailored to your specific application.</p>
                    <a href="{{ url('/contact') }}" class="fc-closing-btn">Request Consultation</a>
                </div>
            </div>
        </section>
        {{-- ===== End Closing CTA Section ===== --}}

    </main>

    @include('web.layout.footer')

    <script>
        (function () {
            function initCarousel(trackId) {
                const track = document.getElementById(trackId);
                if (!track) return;

                const viewport = track.parentElement;
                const prevBtn = document.querySelector(`.fc-carousel-prev[data-target="${trackId}"]`);
                const nextBtn = document.querySelector(`.fc-carousel-next[data-target="${trackId}"]`);
                const items = track.children;

                function getVisibleCount() {
                    if (window.innerWidth <= 767) return 1;
                    if (window.innerWidth <= 991) return 2;
                    return 4;
                }

                let currentIndex = 0;

                function update() {
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
                        update();
                    }
                });

                prevBtn.addEventListener('click', function () {
                    if (currentIndex > 0) {
                        currentIndex--;
                        update();
                    }
                });

                window.addEventListener('resize', update);
                update();
            }

            initCarousel('machineTrack');
            initCarousel('toolTrack');
        })();
    </script>

</body>
</html>
