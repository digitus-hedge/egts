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
</head>
<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="sd-hero" @if($service->image) style="background-image: url('{{ asset('storage/' . $service->image) }}');" @endif>
            <div class="sd-hero-overlay"></div>
            <div class="sd-hero-content">
                <span class="sd-hero-eyebrow">SERVICE DETAIL</span>
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
                <span class="sd-section-eyebrow">SERVICE OVERVIEW &amp; TECHNICAL PROCESS</span>

                <div class="sd-overview-grid">
                    <div class="sd-overview-col">
                        <h3>Process Description</h3>
                        <p>{{ $service->process_description }}</p>
                    </div>

                    @if (!empty($service->technical_scope))
                    <div class="sd-overview-col">
                        <h3>Technical Scope &amp; Capabilities</h3>
                        <ul class="sd-scope-list">
                            @foreach ($service->technical_scope as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                @if ($service->image)
                <div class="sd-visual-box">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }} Process Visual">
                </div>
                @endif
            </div>
        </section>
        {{-- ===== End Overview & Technical Process ===== --}}

        {{-- ===== Technical Specifications & Features ===== --}}
        @if (!empty($service->specifications))
        <section class="sd-specs-section">
            <div class="sd-specs-inner">
                <span class="sd-section-eyebrow">TECHNICAL SPECIFICATIONS &amp; FEATURES</span>
                <h2>Specifications Table</h2>

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
                        @foreach ($service->gallery as $img)
                            <div class="sd-gallery-item">
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $service->title }} Gallery">
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
                            <a href="{{ url('/services/' . $related->slug) }}" class="sd-related-item">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                                @endif
                                <span>{{ $related->title }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </section>
        {{-- ===== End Gallery & Related Services ===== --}}

        {{-- ===== Request Consultation ===== --}}
        <section class="sd-consult-section">
            <div class="sd-consult-inner">
                <div class="sd-consult-left">
                    <span class="sd-section-eyebrow">GET IN TOUCH</span>
                    <h2>Request a Consultation</h2>
                    <p>Talk to our technical team about {{ Str::lower($service->title) }} specifications, lead times, and capacity for your next project.</p>
                </div>

                <form class="sd-consult-form" action="{{ url('/contact/submit') }}" method="POST">
                    @csrf
                    <div class="sd-form-row">
                        <div class="sd-form-group">
                            <label for="contact_name">Contact Name</label>
                            <input type="text" id="contact_name" name="contact_name" placeholder="Your full name" required>
                        </div>
                        <div class="sd-form-group">
                            <label for="contact_inquiry">Contact Inquiry</label>
                            <input type="text" id="contact_inquiry" name="contact_inquiry" placeholder="Briefly describe your requirement" required>
                        </div>
                    </div>
                    <button type="submit" class="sd-consult-btn">Request Consultation</button>
                </form>
            </div>
        </section>
        {{-- ===== End Request Consultation ===== --}}

    </main>

    @include('web.layout.footer')

</body>
</html>
