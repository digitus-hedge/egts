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
        <section class="fc-hero" style="background-image: url('{{ asset('images/facility-hero.webp') }}');">
            <div class="fc-hero-overlay"></div>
            <div class="fc-hero-content">
                <span class="fc-hero-eyebrow">FACILITY &amp; CAPABILITIES</span>
                <h1>Our Modern Facility: Advanced Machining &amp; Precision</h1>
                <p>Showcase of the modern Ankawa facility, advanced CNC infrastructure, and precision measuring tools.</p>
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
                    <g transform="translate(140,420) rotate(-15)">
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
                        <h3>Facility Narrative</h3>
                        <p>Our modern Ankawa workshop is purpose-built for precision oilfield machining. The layout is optimized for efficient workflow, with dedicated bays for machining, threading, inspection, and make-up/break-out operations. Every area of the facility is designed around consistent capacity, standing infrastructure, and reliable operational uptime.</p>
                    </div>

                    <div class="fc-narrative-col">
                        <h3>Infrastructure Highlights</h3>
                        <ul class="fc-highlights-list">
                            <li>Climate-controlled environment</li>
                            <li>Power backup control, climate, and environment monitoring</li>
                            <li>Power systems reporting on-site and on-demand</li>
                            <li>Safety systems and layers of standing protocols</li>
                            <li>Safety systems and standing layouts across all bays</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        {{-- ===== End Ankawa Operations & Infrastructure ===== --}}

        {{-- ===== Advanced CNC Infrastructure / Machinery Gallery ===== --}}
        <section class="fc-machinery-section">
            <div class="fc-machinery-inner">
                <span class="fc-section-eyebrow">MACHINERY GALLERY</span>
                <h2>Advanced CNC Infrastructure</h2>

                <div class="fc-machinery-grid">

                    <div class="fc-machinery-card">
                        <img src="{{ asset('images/service-2.webp') }}" alt="CNC Lathe (Flatbed)">
                        <div class="fc-machinery-body">
                            <h3>CNC Lathe (Flatbed)</h3>
                            <p>CNC lathe (flatbed) measuring machine, for long threaded operations on all spindle sizes.</p>
                        </div>
                    </div>

                    <div class="fc-machinery-card">
                        <img src="{{ asset('images/service-1.webp') }}" alt="CNC Heavy-Duty Lathe">
                        <div class="fc-machinery-body">
                            <h3>CNC Heavy-Duty Lathe</h3>
                            <p>CNC heavy-duty lathe capable of handling large diameter and specialized configurations.</p>
                        </div>
                    </div>

                    <div class="fc-machinery-card">
                        <img src="{{ asset('images/service-3.webp') }}" alt="Make-Up / Break-Out Unit">
                        <div class="fc-machinery-body">
                            <h3>Make-Up / Break-Out Unit</h3>
                            <p>Bucking unit designed for reliable, torque-controlled connection assembly and disassembly.</p>
                        </div>
                    </div>

                    <div class="fc-machinery-card">
                        <img src="{{ asset('images/service-4.webp') }}" alt="Band Saw">
                        <div class="fc-machinery-body">
                            <h3>Band Saw</h3>
                            <p>Band saw for precise cutting, sized to fit specific tolerance and length requirements.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- ===== End Machinery Gallery ===== --}}

        {{-- ===== Precision Measuring & Inspection Tools ===== --}}
        <section class="fc-qc-section">
            <div class="fc-qc-inner">
                <span class="fc-section-eyebrow">QC &amp; INSPECTION TOOLS</span>
                <h2>Precision Measuring &amp; Inspection Tools</h2>

                <div class="fc-qc-grid">

                    <div class="fc-qc-card">
                        <div class="fc-qc-image">
                            <img src="{{ asset('images/service-5.webp') }}" alt="CMM Coordinate Measuring Machine">
                        </div>
                        <h3>CMM (Coordinate Measuring Machine)</h3>
                        <p>CMM (coordinate measuring machine) verifies dimensional accuracy to ensure full quality assurance to API/ISO standards.</p>
                    </div>

                    <div class="fc-qc-card">
                        <div class="fc-qc-image">
                            <img src="{{ asset('images/service-6.webp') }}" alt="Thread Gauges and Calipers">
                        </div>
                        <h3>Thread Gauges &amp; Calipers</h3>
                        <p>Thread gauges and calipers used for precision on connections to verify compliance with API/ISO standards.</p>
                    </div>

                    <div class="fc-qc-card">
                        <div class="fc-qc-image">
                            <img src="{{ asset('images/service-7.webp') }}" alt="Hardness Tester">
                        </div>
                        <h3>Hardness Tester</h3>
                        <p>Hardness tester validates material and calibrated readings to comply with material assurance standards.</p>
                    </div>

                </div>
            </div>
        </section>
        {{-- ===== End QC & Inspection Tools ===== --}}

    </main>

    @include('web.layout.footer')

</body>
</html>
