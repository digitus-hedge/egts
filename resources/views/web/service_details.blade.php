<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="sd-hero" @if(!$service->banner_video && $service->banner_image) style="background-image: url('{{ asset('storage/' . $service->banner_image) }}');" @endif>

    @if ($service->banner_video)
        <video class="sd-hero-video-bg" autoplay muted loop playsinline>
            <source src="{{ asset('storage/' . $service->banner_video) }}" type="video/mp4">
        </video>
    @endif

    <div class="sd-hero-overlay"></div>
    <div class="sd-hero-content">
        <h1>{{ $service->title }}:<br>Detailed Specifications</h1>
    </div>
</section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Overview & Technical Process ===== --}}
        <section class="sd-overview-section">
            <div class="sd-bg-decor sd-bg-decor-left">
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

            <div class="sd-bg-decor sd-bg-decor-right">
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

            <div class="sd-overview-inner">
                <span class="sd-section-eyebrow">SERVICE OVERVIEW & TECHNICAL PROCESS</span>

                <div class="sd-overview-grid">
                    <div class="sd-overview-col">
                        <h3>Process Description</h3>
                        <p>{{ $service->process_description }}</p>
                    </div>

                    @if (!empty($service->technical_scope))
                    <div class="sd-overview-col">
                        <h3>Technical Scope &amp; Capabilities</h3>
                        <ul class="sd-scope-list-full">
                            @foreach ($service->technical_scope as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

            </div>
        </section>
        {{-- ===== End Overview & Technical Process ===== --}}

        {{-- ===== Our Inspection Process Section ===== --}}
        @if (!empty($service->inspection_process))
        <section class="sd-process-section">
            <div class="sd-process-inner">
                <h2>Our Inspection process</h2>

                <div class="sd-process-grid">

                    <div class="sd-process-image-wrap">
                        @foreach ($service->inspection_process as $index => $step)
                        <img src="{{ asset('storage/' . $step['image']) }}" alt="{{ $step['heading'] }}"
                            class="sd-process-image {{ $index === 0 ? 'active' : '' }}" id="process-image-{{ $index }}">
                        @endforeach
                    </div>

                    <div class="sd-process-content">
                        <div class="sd-process-tabs">
                            @foreach ($service->inspection_process as $index => $step)
                            <button type="button" class="sd-process-tab {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}">
                                {{ strtoupper($step['heading']) }}
                            </button>
                            @endforeach
                        </div>

                        @foreach ($service->inspection_process as $index => $step)
                        <div class="sd-process-panel {{ $index === 0 ? 'active' : '' }}"
                            id="process-panel-{{ $index }}">
                            <h3>{{ $step['heading'] }}</h3>
                            <p>{{ $step['description'] }}</p>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>

        <script>
            (function () {
                const tabs = document.querySelectorAll('.sd-process-tab');
                const images = document.querySelectorAll('.sd-process-image');
                const panels = document.querySelectorAll('.sd-process-panel');

                tabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        const index = this.dataset.index;

                        tabs.forEach(t => t.classList.remove('active'));
                        images.forEach(i => i.classList.remove('active'));
                        panels.forEach(p => p.classList.remove('active'));

                        this.classList.add('active');
                        document.getElementById('process-image-' + index).classList.add('active');
                        document.getElementById('process-panel-' + index).classList.add('active');
                    });
                });
            })();

        </script>
        @endif
        {{-- ===== End Our Inspection Process Section ===== --}}


        {{-- ===== Technical Specifications & Features ===== --}}
        @if (!empty($service->specifications))
        <section class="sd-specs-section">
            <div class="sd-specs-inner">
                <span class="sd-section-eyebrow">TECHNICAL SPECIFICATIONS &amp; FEATURES</span>

                <div class="sd-specs-table-wrap">
                    <table class="sd-specs-table">
                        <thead>
                            <tr>
                                <th>Specification</th>
                                <th>Details</th>
                                <th>Compliance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service->specifications as $row)
                            <tr>
                                <td>{{ $row['specification'] ?? '' }}</td>
                                <td>{{ $row['details'] ?? '' }}</td>
                                <td>{{ $row['compliance'] ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @endif
        {{-- ===== End Technical Specifications & Features ===== --}}

        {{-- ===== Gallery & Related Services ===== --}}
        <section class="sd-gallery-section">
    <div class="sd-bg-decor sd-bg-decor-left">
        <svg viewBox="0 0 220 500" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <g transform="translate(15,20) rotate(20)">
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

    <div class="sd-bg-decor sd-bg-decor-right">
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

    <div class="sd-gallery-inner">

        @if (!empty($service->gallery))
        <div class="sd-gallery-col">
            <span class="sd-section-eyebrow">GALLERY</span>
            <h2>Service Images</h2>

            <div class="sd-gallery-grid">
                @foreach ($service->gallery as $index => $img)
                <div class="sd-gallery-item"
                     onclick="openSdLightbox({{ $index }})"
                     role="button"
                     tabindex="0"
                     aria-label="View image {{ $index + 1 }} in gallery">
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $service->title }} - {{ $index + 1 }}">
                    <div class="sd-gallery-overlay">
                        <i class="bi bi-zoom-in"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if ($relatedServices->count())
        <div class="sd-related-col">
            <span class="sd-section-eyebrow">RELATED SERVICES</span>
            <h2>You May Also Need</h2>

            <div class="sd-related-grid">
                @foreach ($relatedServices as $related)
                    <div class="sd-related-card">
                        @if ($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                        @endif
                        <h3>{{ $related->title }}</h3>
                        <a href="{{ url('/services/' . $related->slug) }}" class="sd-related-link">
                            Learn More
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

{{-- ===================== LIGHTBOX MODAL ===================== --}}
@if (!empty($service->gallery))
<div class="sd-lightbox" id="sdLightbox" onclick="sdCloseOnBackdrop(event)" aria-hidden="true">
    <button class="sd-lightbox-close" onclick="closeSdLightbox()" aria-label="Close gallery">
        <i class="bi bi-x-lg"></i>
    </button>

    @if (count($service->gallery) > 1)
    <button class="sd-lightbox-nav sd-lightbox-prev" onclick="sdPrevSlide()" aria-label="Previous image">
        <i class="bi bi-chevron-left"></i>
    </button>

    <button class="sd-lightbox-nav sd-lightbox-next" onclick="sdNextSlide()" aria-label="Next image">
        <i class="bi bi-chevron-right"></i>
    </button>
    @endif

    <div class="sd-lightbox-content">
        <div class="sd-lightbox-stage">
            @foreach ($service->gallery as $index => $img)
                <div class="sd-lightbox-slide" data-index="{{ $index }}">
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $service->title }} - Image {{ $index + 1 }}">
                </div>
            @endforeach
        </div>

        <div class="sd-lightbox-meta">
            <div class="sd-lightbox-title">{{ $service->title }}</div>
            <div class="sd-lightbox-counter">
                <span id="sdCurrentSlide">1</span> / <span id="sdTotalSlides">{{ count($service->gallery) }}</span>
            </div>
        </div>

        @if (count($service->gallery) > 1)
        <div class="sd-lightbox-thumbs" id="sdLightboxThumbs">
            @foreach ($service->gallery as $index => $img)
                <div class="sd-lightbox-thumb" data-index="{{ $index }}" onclick="sdGoToSlide({{ $index }})">
                    <img src="{{ asset('storage/' . $img) }}" alt="Thumbnail {{ $index + 1 }}">
                </div>
            @endforeach
        </div>

        {{-- Progress bar for auto-slide --}}
        <div class="sd-lightbox-progress">
            <div class="sd-lightbox-progress-bar" id="sdProgressBar"></div>
        </div>
        @endif
    </div>
</div>
@endif
        {{-- ===== End Gallery & Related Services ===== --}}

        {{-- ===== Request Consultation ===== --}}
        <section class="sd-consult-section">
            <div class="sd-consult-inner">
                <div class="sd-consult-left">
                    <span class="sd-section-eyebrow">GET IN TOUCH</span>
                    <h2>Request a Consultation</h2>
                    <p>Talk to our technical team about {{ Str::lower($service->title) }} specifications, lead times,
                        and capacity for your next project.</p>
                </div>

                <form class="sd-consult-form" action="{{ url('/contact/submit') }}" method="POST">
                    @csrf
                    <div class="sd-form-row">
                        <div class="sd-form-group">
                            <label for="contact_name">Contact Name</label>
                            <input type="text" id="contact_name" name="contact_name" placeholder="Your full name"
                                required>
                        </div>
                        <div class="sd-form-group">
                            <label for="contact_inquiry">Contact Inquiry</label>
                            <input type="text" id="contact_inquiry" name="contact_inquiry"
                                placeholder="Briefly describe your requirement" required>
                        </div>
                    </div>
                    <button type="submit" class="sd-consult-btn">Request Consultation</button>
                </form>
            </div>
        </section>
        {{-- ===== End Request Consultation ===== --}}

    </main>

    <style>
        /* ============== CLICKABLE GALLERY GRID ============== */
.sd-gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    cursor: pointer;
    aspect-ratio: 4/3;
    background: #f6f7fb;
    transition: transform .3s ease, box-shadow .3s ease;
}

.sd-gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s ease;
}

.sd-gallery-item:hover,
.sd-gallery-item:focus {
    transform: translateY(-4px);
    box-shadow: 0 18px 40px -12px rgba(15, 21, 38, 0.28);
    outline: none;
}

.sd-gallery-item:hover img,
.sd-gallery-item:focus img {
    transform: scale(1.08);
}

.sd-gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(191,0,1,0.0) 0%, rgba(10,15,25,0.55) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .3s ease;
    color: #fff;
    font-size: 36px;
}

.sd-gallery-item:hover .sd-gallery-overlay,
.sd-gallery-item:focus .sd-gallery-overlay {
    opacity: 1;
}

/* ============== LIGHTBOX MODAL ============== */
.sd-lightbox {
    position: fixed;
    inset: 0;
    background: rgba(5, 8, 15, 0.96);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: sdFadeIn .3s ease;
}

.sd-lightbox.active {
    display: flex;
}

@keyframes sdFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Close button */
.sd-lightbox-close {
    position: absolute;
    top: 24px;
    right: 24px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .25s, transform .25s;
    z-index: 10;
}

.sd-lightbox-close:hover {
    background: #BF0001;
    transform: rotate(90deg);
}

/* Nav arrows */
.sd-lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 54px;
    height: 54px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .25s, transform .25s;
    z-index: 10;
}

.sd-lightbox-nav:hover {
    background: #BF0001;
}

.sd-lightbox-prev { left: 24px; }
.sd-lightbox-next { right: 24px; }

/* Content wrapper */
.sd-lightbox-content {
    width: 100%;
    max-width: 1100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

/* Slides stage */
.sd-lightbox-stage {
    position: relative;
    width: 100%;
    height: 70vh;
    overflow: hidden;
    border-radius: 14px;
    background: #000;
    box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.7);
}

.sd-lightbox-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transform: scale(0.98);
    transition: opacity .5s ease, transform .5s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
}

.sd-lightbox-slide.active {
    opacity: 1;
    transform: scale(1);
    pointer-events: auto;
}

.sd-lightbox-slide img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    display: block;
}

/* Meta row (title + counter) */
.sd-lightbox-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    color: #fff;
    gap: 16px;
    padding: 0 4px;
}

.sd-lightbox-title {
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.02em;
}

.sd-lightbox-counter {
    color: rgba(255, 255, 255, 0.7);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.05em;
    background: rgba(255,255,255,0.08);
    padding: 6px 12px;
    border-radius: 999px;
}

.sd-lightbox-counter span {
    color: #fff;
    font-weight: 700;
}

/* Thumbnails strip */
.sd-lightbox-thumbs {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    max-width: 100%;
    padding: 6px 4px;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) transparent;
}

.sd-lightbox-thumbs::-webkit-scrollbar {
    height: 6px;
}

.sd-lightbox-thumbs::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 999px;
}

.sd-lightbox-thumb {
    flex-shrink: 0;
    width: 76px;
    height: 56px;
    border-radius: 7px;
    overflow: hidden;
    cursor: pointer;
    opacity: 0.5;
    transition: opacity .25s, transform .25s, border-color .25s;
    border: 2px solid transparent;
}

.sd-lightbox-thumb:hover {
    opacity: 0.85;
    transform: translateY(-2px);
}

.sd-lightbox-thumb.active {
    opacity: 1;
    border-color: #BF0001;
    box-shadow: 0 4px 12px -2px rgba(191, 0, 1, 0.5);
}

.sd-lightbox-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Auto-slide progress bar */
.sd-lightbox-progress {
    width: 100%;
    height: 3px;
    background: rgba(255,255,255,0.1);
    border-radius: 999px;
    overflow: hidden;
}

.sd-lightbox-progress-bar {
    height: 100%;
    width: 0%;
    background: linear-gradient(to right, #BF0001, #ff4e4f);
    border-radius: 999px;
    transition: width .1s linear;
}

/* ============== RESPONSIVE ============== */
@media (max-width: 900px) {
    .sd-lightbox { padding: 12px; }
    .sd-lightbox-stage { height: 60vh; }
    .sd-lightbox-nav {
        width: 42px; height: 42px; font-size: 18px;
    }
    .sd-lightbox-prev { left: 10px; }
    .sd-lightbox-next { right: 10px; }
    .sd-lightbox-close { top: 12px; right: 12px; width: 40px; height: 40px; }
    .sd-lightbox-thumb { width: 58px; height: 44px; }
}

@media (max-width: 560px) {
    .sd-lightbox-stage { height: 55vh; }
    .sd-lightbox-title { font-size: 13px; }
    .sd-lightbox-meta { flex-direction: column; align-items: flex-start; gap: 6px; }
    .sd-lightbox-thumb { width: 50px; height: 38px; }
    .sd-lightbox-nav {
        width: 38px; height: 38px; font-size: 16px;
    }
}
    </style>

    @include('web.layout.footer')


   <script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('sdLightbox');
    if (!lightbox) {
        console.warn('[Lightbox] Element #sdLightbox not found');
        return;
    }

    const slides = lightbox.querySelectorAll('.sd-lightbox-slide');
    const thumbs = lightbox.querySelectorAll('.sd-lightbox-thumb');
    const currentEl = document.getElementById('sdCurrentSlide');
    const progressBar = document.getElementById('sdProgressBar');
    const total = slides.length;

    console.log('[Lightbox] Initialized with', total, 'slides');

    if (total === 0) return;

    let currentIndex = 0;
    let autoSlideTimer = null;
    let progressTimer = null;
    const AUTO_SLIDE_DELAY = 4000;   // 4 seconds between slides
    const PROGRESS_STEP = 50;         // progress bar update interval

    function showSlide(index) {
        // Normalize index (loop back)
        currentIndex = ((index % total) + total) % total;

        // Remove active from ALL slides and thumbs
        for (let i = 0; i < total; i++) {
            slides[i].classList.remove('active');
            if (thumbs[i]) thumbs[i].classList.remove('active');
        }

        // Add active to current
        slides[currentIndex].classList.add('active');

        if (thumbs[currentIndex]) {
            thumbs[currentIndex].classList.add('active');
            try {
                thumbs[currentIndex].scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center',
                    block: 'nearest'
                });
            } catch (e) { /* older browsers */ }
        }

        if (currentEl) currentEl.textContent = currentIndex + 1;

        console.log('[Lightbox] Showing slide', currentIndex + 1, 'of', total);
    }

    function stopAutoSlide() {
        if (autoSlideTimer) { clearTimeout(autoSlideTimer); autoSlideTimer = null; }
        if (progressTimer)  { clearInterval(progressTimer); progressTimer = null; }
        if (progressBar) progressBar.style.width = '0%';
    }

    function startAutoSlide() {
        stopAutoSlide();
        if (total <= 1) return;

        let elapsed = 0;

        // Progress bar animation
        if (progressBar) {
            progressTimer = setInterval(function () {
                elapsed += PROGRESS_STEP;
                const pct = Math.min((elapsed / AUTO_SLIDE_DELAY) * 100, 100);
                progressBar.style.width = pct + '%';
            }, PROGRESS_STEP);
        }

        // Auto-advance
        autoSlideTimer = setTimeout(function () {
            showSlide(currentIndex + 1);
            startAutoSlide();   // restart for next slide
        }, AUTO_SLIDE_DELAY);

        console.log('[Lightbox] Auto-slide started');
    }

    // ============ GLOBAL FUNCTIONS ============
    window.openSdLightbox = function (index) {
        console.log('[Lightbox] Opening at index', index);
        lightbox.classList.add('active');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        showSlide(index || 0);
        startAutoSlide();
    };

    window.closeSdLightbox = function () {
        lightbox.classList.remove('active');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        stopAutoSlide();
    };

    window.sdNextSlide = function () {
        showSlide(currentIndex + 1);
        startAutoSlide();
    };

    window.sdPrevSlide = function () {
        showSlide(currentIndex - 1);
        startAutoSlide();
    };

    window.sdGoToSlide = function (index) {
        showSlide(index);
        startAutoSlide();
    };

    window.sdCloseOnBackdrop = function (event) {
        if (event.target === lightbox) closeSdLightbox();
    };

    // ============ KEYBOARD ============
    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape')     { e.preventDefault(); closeSdLightbox(); }
        if (e.key === 'ArrowRight') { e.preventDefault(); sdNextSlide(); }
        if (e.key === 'ArrowLeft')  { e.preventDefault(); sdPrevSlide(); }
    });

    // ============ PAUSE ON HOVER ============
    const contentEl = lightbox.querySelector('.sd-lightbox-content');
    if (contentEl) {
        contentEl.addEventListener('mouseenter', stopAutoSlide);
        contentEl.addEventListener('mouseleave', function () {
            if (lightbox.classList.contains('active')) startAutoSlide();
        });
    }

    // ============ TOUCH SWIPE ============
    let touchStartX = 0;
    const stage = lightbox.querySelector('.sd-lightbox-stage');
    if (stage) {
        stage.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoSlide();
        }, { passive: true });

        stage.addEventListener('touchend', function (e) {
            const diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 50) {
                diff > 0 ? sdNextSlide() : sdPrevSlide();
            } else {
                startAutoSlide();
            }
        });
    }
});
</script>

    <script>
    (function () {
        const heroes = document.querySelectorAll('.page-hero, .sd-hero');

        heroes.forEach(function (hero) {
            function matchHeroToImage() {
                if (window.innerWidth > 991) {
                    hero.style.aspectRatio = '';
                    return;
                }

                const bgImage = getComputedStyle(hero).backgroundImage;
                const match = bgImage.match(/url\(["']?(.*?)["']?\)/);
                if (!match || !match[1]) return;

                const img = new Image();
                img.onload = function () {
                    if (img.naturalWidth && img.naturalHeight) {
                        hero.style.aspectRatio = img.naturalWidth + ' / ' + img.naturalHeight;
                    }
                };
                img.src = match[1];
            }

            matchHeroToImage();
            window.addEventListener('resize', matchHeroToImage);
        });
    })();
</script>

</body>

</html>
