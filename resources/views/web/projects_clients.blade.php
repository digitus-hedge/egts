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
</head>
<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="pj-hero" @if($banner?->image) style="background-image: url('{{ asset('storage/' . $banner->image) }}');" @endif>
            <div class="pj-hero-overlay"></div>
            <div class="pj-hero-content">
                <h1>{{ $banner->title ?? '' }}</h1>
                <p>{{ $banner->content ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Key Projects & Clients ===== --}}
        <section class="pj-section">
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

            <div class="pj-inner">
                <span class="pj-eyebrow">KEY PROJECTS &amp; CLIENTS</span>
                <p class="pj-narrative">{{ $banner->description ?? '' }}</p>

                @if ($projects->count())
                <div class="pj-grid">
                    @foreach ($projects as $project)
                        <button type="button" class="pj-logo-card" data-project-index="{{ $loop->index }}">
                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                            @endif
                        </button>
                    @endforeach
                </div>
                @else
                <p class="pj-empty">No projects or clients added yet.</p>
                @endif
            </div>
        </section>
        {{-- ===== End Key Projects & Clients ===== --}}

    </main>

    @include('web.layout.footer')

    {{-- ===== Project Detail Modal ===== --}}
    <div class="pj-modal-overlay" id="pjModalOverlay">
        <div class="pj-modal">
            <button type="button" class="pj-modal-close" id="pjModalClose">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="pj-modal-image">
                <img id="pjModalImage" src="" alt="">
            </div>

            <div class="pj-modal-body">
                <span class="pj-modal-client" id="pjModalClient"></span>
                <h3 id="pjModalTitle"></h3>
                <p id="pjModalDescription"></p>
            </div>
        </div>
    </div>

    @php
        $projectsForJs = $projects->map(function ($p) {
            return [
                'title' => $p->title,
                'client_name' => $p->client_name,
                'description' => $p->description,
                'image' => $p->image ? asset('storage/' . $p->image) : null,
            ];
        });
    @endphp

    <script>
        const projectsData = @json($projectsForJs);

        const overlay = document.getElementById('pjModalOverlay');
        const closeBtn = document.getElementById('pjModalClose');
        const modalImage = document.getElementById('pjModalImage');
        const modalClient = document.getElementById('pjModalClient');
        const modalTitle = document.getElementById('pjModalTitle');
        const modalDescription = document.getElementById('pjModalDescription');

        document.querySelectorAll('.pj-logo-card').forEach(function (card) {
            card.addEventListener('click', function () {
                const index = this.dataset.projectIndex;
                const project = projectsData[index];
                if (!project) return;

                modalImage.src = project.image || '';
                modalImage.style.display = project.image ? 'block' : 'none';
                modalClient.textContent = project.client_name || '';
                modalClient.style.display = project.client_name ? 'block' : 'none';
                modalTitle.textContent = project.title;
                modalDescription.textContent = project.description || '';

                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeModal() {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        closeBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</body>
</html>
