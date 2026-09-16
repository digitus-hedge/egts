<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects & Clients - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="pj-hero" @if(!$banner?->video && $banner?->image) style="background-image:
            url('{{ asset('storage/' . $banner->image) }}');" @endif>

            @if ($banner?->video)
            <video class="pj-hero-video-bg" autoplay muted loop playsinline>
                <source src="{{ asset('storage/' . $banner->video) }}" type="video/mp4">
            </video>
            @endif

            <div class="pj-hero-overlay"></div>
            <div class="pj-hero-content">
                <h1>{{ $banner->title ?? '' }}</h1>
                <p>{{ $banner->content ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Key Projects & Clients Intro ===== --}}
        <section class="pj-intro-section">
            <div class="pj-intro-inner">
                <span class="pj-eyebrow">KEY PROJECTS &amp; CLIENTS</span>
                <h2>Partnerships built on delivery</h2>
                <p class="pj-intro-text">{{ $banner->description ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Key Projects & Clients Intro ===== --}}

        {{-- ===== Projects Delivered Section ===== --}}
        <section class="pj-projects-section">
            <div class="pj-bg-decor pj-bg-decor-left">
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
                </svg>
            </div>

            <div class="pj-bg-decor pj-bg-decor-right">
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

            <div class="pj-projects-inner">
                <span class="pj-eyebrow">PROJECTS</span>
                <h2>Projects Delivered</h2>
                <p class="pj-intro-text">From thread repair on individual joints to full remanufacturing programs, our
                    project work spans drilling and OCTG equipment across operators, drilling contractors and service
                    companies in Iraq and the wider region.</p>

                @if ($masterProjects->count())
                <div class="pj-projects-grid" id="pjProjectsGrid">
                    @foreach ($masterProjects as $index => $project)
                    <div class="pj-project-card {{ $index >= 8 ? 'pj-project-hidden' : '' }}">
                        @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @endif
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description }}</p>
                    </div>
                    @endforeach
                </div>

                @if ($masterProjects->count() > 8)
                <div class="pj-loadmore-wrap">
                    <button type="button" class="pj-loadmore-btn" id="pjLoadMoreBtn">Load More</button>
                </div>
                @endif
                @else
                <p class="pj-empty">No projects added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End Projects Delivered Section ===== --}}

        {{-- ===== Clients Section ===== --}}
        <section class="pj-clients-section">
            <div class="pj-clients-inner">
                <span class="pj-eyebrow">CLIENTS</span>
                <h2>Trusted by Industry Leaders</h2>
                <p class="pj-intro-text">EGTS works alongside national oil companies, global oilfield service majors and
                    regional operators, delivering the precision machining and inspection work their drilling and
                    production programs depend on.</p>

                @if ($clients->count())
                <div class="pj-clients-grid">
                    @foreach ($clients as $client)
                    <div class="pj-client-card">
                        @if ($client->image)
                        <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->title }}">
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="pj-empty">No clients added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End Clients Section ===== --}}

    </main>

    @include('web.layout.footer')

    <script>
        (function () {
            const btn = document.getElementById('pjLoadMoreBtn');
            if (!btn) return;

            let expanded = false;

            btn.addEventListener('click', function () {
                const hiddenCards = document.querySelectorAll('.pj-project-hidden');

                if (!expanded) {
                    hiddenCards.forEach(card => card.classList.remove('pj-project-hidden'));
                    btn.textContent = 'Show Less';
                    expanded = true;
                } else {
                    hiddenCards.forEach(card => card.classList.add('pj-project-hidden'));
                    btn.textContent = 'Load More';
                    expanded = false;
                    document.getElementById('pjProjectsGrid').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        })();

    </script>

</body>

</html>
