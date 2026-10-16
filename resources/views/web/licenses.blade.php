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

                <a href="{{ asset('files/egts-license-register.pdf') }}"
                   target="_blank"
                   rel="noopener"
                   class="lc-hero-cta">
                    <span>EGTS License Register</span>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                         stroke="currentColor" stroke-width="2.2"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="4" y1="12" x2="19" y2="12"/>
                        <polyline points="13 6 19 12 13 18"/>
                    </svg>
                </a>
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
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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
                        <!-- @if ($certificate->image)
                        <div class="lc-cert-image">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        @endif -->


                        @if ($certificate->image)
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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

        <!-- ISO -->

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
                <h2>ISO/Q1 License</h2>
                <p class="lc-group-desc">EGTS is certified to ISO 9001:2015 and API Spec Q1, ensuring every product and
                    service is delivered through controlled, traceable and continually improving quality processes built
                    for the oil and gas industry.</p>

                @if ($isoCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($isoCertificates as $certificate)
                    <div class="lc-cert-card">
                        @if ($certificate->image)
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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
                <p class="lc-empty">No ISO license certificates added yet.</p>
                @endif
            </div>
        </section>

        {{-- MNR License Section --}}
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
                <h2>MNR License</h2>
                <p class="lc-group-desc">EGTS holds the Ministry of Natural Resources (MNR) license required to
                    operate in the oil and gas sector, demonstrating full compliance with national regulatory
                    standards for petroleum-related manufacturing and services.</p>

                @if ($mnrCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($mnrCertificates as $certificate)
                    <div class="lc-cert-card">
                        <!-- @if ($certificate->image)
                        <div class="lc-cert-image">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        @endif -->


                        @if ($certificate->image)
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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
                <p class="lc-empty">No MNR license certificates added yet.</p>
                @endif
            </div>
        </section>
        {{-- MNR License Section end  --}}

        {{-- Establishment certificate Section --}}
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
                <h2>Establishment Certificate</h2>
                <p class="lc-group-desc">Our official Establishment Certificate confirms EGTS is a legally registered
                    and fully licensed entity, authorized to conduct industrial, manufacturing, and technical service
                    operations in accordance with local commercial regulations.</p>

                @if ($establishmentCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($establishmentCertificates as $certificate)
                    <div class="lc-cert-card">
                        @if ($certificate->image)
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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
                <p class="lc-empty">No Establishment certificates added yet.</p>
                @endif
            </div>
        </section>
        {{-- Establishment certificate Section end --}}

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
                <h2>OEM License</h2>
                <p class="lc-group-desc">EGTS is an approved Original Equipment Manufacturer (OEM) licensee, authorized
                    to produce, machine and supply components under recognized brand specifications with full
                    traceability and adherence to original design and quality requirements.</p>

                @if ($oemCertificates->count())
                <div class="lc-cert-grid">
                    @foreach ($oemCertificates as $certificate)
                    <div class="lc-cert-card">
                        <!-- @if ($certificate->image)
                        <div class="lc-cert-image">
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                        </div>
                        @endif -->


                        @if ($certificate->image)
                        @php
                        $certUrl = asset('storage/' . $certificate->image);
                        $certExt = strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION));
                        @endphp

                        <div class="lc-cert-image">
                            @if ($certExt === 'pdf')
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link" title="View certificate">
                                <canvas class="lc-pdf-canvas" data-pdf="{{ $certUrl }}"></canvas>
                                <div class="lc-pdf-loading"><i class="bi bi-file-earmark-pdf"></i></div>
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>

                            @elseif (in_array($certExt, ['doc', 'docx']))
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link lc-cert-doc"
                                title="Download certificate">
                                <i class="bi bi-file-earmark-word"></i>
                                <span class="lc-doc-label">{{ strtoupper($certExt) }}</span>
                                <span class="lc-cert-overlay"><i class="bi bi-download"></i> Download Certificate</span>
                            </a>

                            @else
                            <a href="{{ $certUrl }}" target="_blank" class="lc-cert-link">
                                <img src="{{ $certUrl }}" alt="{{ $certificate->title }}">
                                <span class="lc-cert-overlay"><i class="bi bi-eye"></i> View Certificate</span>
                            </a>
                            @endif
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
                <p class="lc-empty">No OEM license certificates added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End Premium License Section ===== --}}
    </main>

    <style>
        /* Preview area: grey box, fixed height, like the product card */
        .lc-cert-image {
            position: relative;
            width: 100%;
            aspect-ratio: 3 / 4;
            /* portrait, like a certificate page */
            border-radius: 10px;
            overflow: hidden;
            background: #f4f5f8;
            border: 1px solid #e6e8ef;
        }

        .lc-cert-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            text-decoration: none;
        }

        .lc-cert-link img,
        .lc-pdf-canvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        .lc-pdf-canvas {
            opacity: 0;
            transition: opacity .3s;
        }

        .lc-pdf-canvas.loaded {
            opacity: 1;
        }

        .lc-pdf-canvas.loaded+.lc-pdf-loading {
            display: none;
        }

        .lc-pdf-loading {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #C0392B;
        }

        .lc-cert-doc {
            flex-direction: column;
            gap: 6px;
            color: #2B579A;
        }

        .lc-cert-doc>i {
            font-size: 56px;
        }

        .lc-doc-label {
            font-size: 13px;
            font-weight: 700;
        }

        .lc-cert-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: rgba(15, 18, 32, 0.6);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            opacity: 0;
            transition: opacity .25s;
        }

        .lc-cert-link:hover .lc-cert-overlay {
            opacity: 1;
        }

        /* ── Hero CTA: EGTS License Register (text link with accent underline) ── */
        .lc-hero-cta {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 28px;
            padding-bottom: 10px;
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .01em;
            text-decoration: none;
            transition: color .18s ease;
        }

        /* the red bar: spans from the label start to the arrow's right edge */
        .lc-hero-cta::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: #e02b1f;
            transform: scaleX(0);
            transform-origin: left center;
            transition: transform .28s ease;
        }

        /* the bar is drawn on by default, then re-draws on hover */
        .lc-hero-cta::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: #e02b1f;
        }

        .lc-hero-cta svg {
            flex-shrink: 0;
            transition: transform .22s ease;
        }

        .lc-hero-cta:hover,
        .lc-hero-cta:focus-visible {
            color: #ffffff;
            outline: none;
        }

        .lc-hero-cta:hover svg,
        .lc-hero-cta:focus-visible svg {
            transform: translateX(4px);
        }

        @media (max-width: 640px) {
            .lc-hero-cta {
                font-size: 14px;
                margin-top: 22px;
            }
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        document.querySelectorAll('.lc-pdf-canvas').forEach(async (canvas) => {
            try {
                const pdf = await pdfjsLib.getDocument(canvas.dataset.pdf).promise;
                const page = await pdf.getPage(1);

                const box = canvas.parentElement.getBoundingClientRect();
                const base = page.getViewport({
                    scale: 1
                });
                const scale = (box.width * (window.devicePixelRatio || 1)) / base.width;
                const viewport = page.getViewport({
                    scale
                });

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                await page.render({
                    canvasContext: canvas.getContext('2d'),
                    viewport
                }).promise;
                canvas.classList.add('loaded');
            } catch (e) {
                console.warn('PDF preview failed:', e);
            }
        });

    </script>


    @include('web.layout.footer')

</body>

</html>
