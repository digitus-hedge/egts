@php
    // Everything on this page comes from Admin > Career > Banner ($careerPage) and Admin > Career ($careers).
    // The text after "??" is only shown until a record has been saved in the admin.
    $bannerTitle = $careerPage->banner_title ?? 'Careers at EGTS';
    $bannerDesc  = $careerPage
        ? $careerPage->banner_description
        : 'Join a team that supports demanding oil and gas operations with careful inspection work.';

    $careerTitle = $careerPage->career_title ?? 'Build your career in inspection and technical services.';
    $careerDesc  = (string) ($careerPage->career_description
        ?? 'EGTS welcomes qualified inspectors, technicians and support staff who take pride in careful, standards-driven work. Browse the current openings below, read the details of each role and send us your CV online.');

    // Works for both kinds of admin field: formatted text is cleaned to safe tags,
    // plain text is escaped and keeps its line breaks.
    $careerDescIsHtml = $careerDesc !== strip_tags($careerDesc);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $careerPage->meta_title ?? 'Careers' }}</title>
    <meta name="description" content="{{ $careerPage->meta_description ?? '' }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/career.css') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="shortcut icon" type="image/webp" href="{{ asset('images/logo.webp') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">
</head>

<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section (same markup as the Services page) ===== --}}
        <section class="page-hero" @if(!$careerPage?->banner_video && $careerPage?->banner)
            style="background-image: url('{{ asset('storage/' . $careerPage->banner) }}');" @endif>

            @if ($careerPage?->banner_video)
            <video class="page-hero-video-bg" autoplay muted loop playsinline>
                <source src="{{ asset('storage/' . $careerPage->banner_video) }}">
            </video>
            @endif

            <div class="page-hero-overlay"></div>
            <div class="page-hero-content">
                <h1>{{ $bannerTitle }}</h1>
                @if (!empty($bannerDesc))
                <p>{{ $bannerDesc }}</p>
                @endif
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Careers ===== --}}
        <section class="capabilities-section">
            <div class="capabilities-inner">

                <div class="capabilities-header">
                    <div class="capabilities-header-left">
                        <span class="capabilities-eyebrow">CAREERS</span>
                        <h2>{{ $careerTitle }}</h2>
                    </div>
                    <div class="capabilities-header-right">
                        @if ($careerDescIsHtml)
                        <div class="cr-intro-text">{!! \App\Models\Career::cleanHtml($careerDesc) !!}</div>
                        @else
                        <p>{!! nl2br(e($careerDesc)) !!}</p>
                        @endif
                    </div>
                </div>

                <div class="cr-openings" id="openings">

                    <div class="cr-openings-top">
                        <h3 class="cr-openings-title">Current Openings</h3>
                        @if ($careers->isNotEmpty())
                        <p class="cr-openings-count">
                            <strong>{{ $careers->count() }}</strong> open {{ $careers->count() === 1 ? 'position' : 'positions' }}
                        </p>
                        @endif
                    </div>

                    @if (session('career_success'))
                    <div class="cr-flash" role="status">{{ session('career_success') }}</div>
                    @endif

                    @if ($careers->isNotEmpty())
                    <div class="cr-list">
                        @foreach ($careers as $career)
                        <div class="cr-item">
                            <div class="cr-item-head">
                                <button type="button" class="cr-toggle" id="cr-btn-{{ $career->id }}"
                                    aria-expanded="false" aria-controls="cr-panel-{{ $career->id }}">
                                    <span class="cr-item-title">{{ $career->title }}</span>
                                    <span class="cr-item-loc">
                                        @if ($career->location)
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11z" />
                                            <circle cx="12" cy="10" r="2.6" />
                                        </svg>
                                        {{ $career->location }}
                                        @endif
                                    </span>
                                    <span class="cr-chevron" aria-hidden="true">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 9l6 6 6-6" />
                                        </svg>
                                    </span>
                                </button>

                                <button type="button" class="cr-btn cr-btn-outline cr-item-apply" data-apply
                                    data-career-id="{{ $career->id }}"
                                    data-career-title="{{ $career->title }}">Apply Now</button>
                            </div>

                            <div class="cr-panel" id="cr-panel-{{ $career->id }}" role="region"
                                aria-labelledby="cr-btn-{{ $career->id }}">
                                <div class="cr-panel-inner">
                                    <div class="cr-body">
                                        @if (trim(strip_tags((string) $career->description)) !== '')
                                        {{-- The Career model cleans the description before saving, so it is safe to print as HTML --}}
                                        <div class="cr-desc">{!! $career->description !!}</div>
                                        @else
                                        <p class="cr-desc-empty">More details about this role will be shared during the application process.</p>
                                        @endif

                                        <button type="button" class="cr-btn" data-apply
                                            data-career-id="{{ $career->id }}"
                                            data-career-title="{{ $career->title }}">Apply for this role <span aria-hidden="true">&#8594;</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="cr-empty">
                        <h3>No open positions right now</h3>
                        <p>We do not have any openings at the moment. Please check this page again soon.</p>
                    </div>
                    @endif

                </div>
            </div>
        </section>
        {{-- ===== End Careers ===== --}}

    </main>

    {{-- ===== Apply modal ===== --}}
    <dialog class="cr-modal" id="careerModal" aria-labelledby="careerModalTitle">
        <div class="cr-modal-inner">

            <button type="button" class="cr-modal-close" id="careerModalClose" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <h2 class="cr-modal-title" id="careerModalTitle">Submit CV</h2>
            <p class="cr-modal-note">We accept CVs in .pdf or .doc format only. File size limit: 3 MB.</p>

            <form class="cr-form" id="careerForm" method="POST" action="{{ route('career.apply') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="career_id" id="cfCareerId" value="">

                {{-- Trap for spam bots: real visitors never see or fill this --}}
                <div class="cr-hp" aria-hidden="true">
                    <label for="cfWebsite">Website</label>
                    <input type="text" name="website" id="cfWebsite" tabindex="-1" autocomplete="off">
                </div>

                <div class="cr-grid">
                    <div class="cr-field">
                        <label for="cfName">Name <span class="cr-req">*</span></label>
                        <input type="text" id="cfName" name="name" maxlength="120" autocomplete="name" required>
                        <span class="cr-error" data-error-for="name"></span>
                    </div>

                    <div class="cr-field">
                        <label for="cfPost">Post <span class="cr-req">*</span></label>
                        <input type="text" id="cfPost" name="apply_for" maxlength="150" readonly required>
                        <span class="cr-error" data-error-for="apply_for"></span>
                    </div>

                    <div class="cr-field">
                        <label for="cfEmail">E-mail <span class="cr-req">*</span></label>
                        <input type="email" id="cfEmail" name="email" maxlength="150" autocomplete="email" required>
                        <span class="cr-error" data-error-for="email"></span>
                    </div>

                    <div class="cr-field">
                        <label for="cfPhone">Phone <span class="cr-req">*</span></label>
                        <input type="tel" id="cfPhone" name="phone" maxlength="30" inputmode="tel" autocomplete="tel"
                            pattern="[0-9+\-\s()]{6,30}" required>
                        <span class="cr-error" data-error-for="phone"></span>
                    </div>

                    <div class="cr-field">
                        <label for="cfNationality">Nationality</label>
                        <input type="text" id="cfNationality" name="nationality" maxlength="100"
                            autocomplete="country-name">
                        <span class="cr-error" data-error-for="nationality"></span>
                    </div>

                    <div class="cr-field">
                        <label for="cfLocation">Location</label>
                        <select id="cfLocation" name="location">
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                        <span class="cr-error" data-error-for="location"></span>
                    </div>

                    <div class="cr-field cr-full">
                        <label for="cfMessage">Your Message</label>
                        <textarea id="cfMessage" name="message" rows="5" maxlength="2000"></textarea>
                        <span class="cr-error" data-error-for="message"></span>
                    </div>

                    <div class="cr-field cr-full">
                        <label for="cfCv">Resume / CV <span class="cr-req">*</span></label>
                        <input type="file" id="cfCv" name="cv"
                            accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            required>
                        <span class="cr-error" data-error-for="cv"></span>
                    </div>
                </div>

                <div class="cr-actions">
                    <button type="submit" class="cr-btn cr-submit" id="cfSubmit">Send Application</button>
                    <p class="cr-status" id="cfStatus" role="alert"></p>
                </div>
            </form>

            <div class="cr-success" role="status">
                <div class="cr-success-icon" aria-hidden="true">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12.5l4.5 4.5L19 7.5" />
                    </svg>
                </div>
                <h3>Application sent</h3>
                <p>Thank you. We have received your application and our team will contact you if your profile matches the role.</p>
                <button type="button" class="cr-btn cr-btn-outline" id="careerSuccessClose">Close</button>
            </div>

        </div>
    </dialog>

    @include('web.layout.footer')

    {{-- Same hero script as the Services page: on phones the banner follows the image's own shape --}}
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ----- Openings: click a row to expand it (one open at a time) ----- */
        const items = Array.from(document.querySelectorAll('.cr-item'));
        items.forEach(function (item) {
            const toggle = item.querySelector('.cr-toggle');
            toggle.addEventListener('click', function () {
                const willOpen = !item.classList.contains('open');
                items.forEach(function (other) {
                    other.classList.remove('open');
                    other.querySelector('.cr-toggle').setAttribute('aria-expanded', 'false');
                });
                if (willOpen) {
                    item.classList.add('open');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });
        });

        /* ----- Apply modal ----- */
        const modal = document.getElementById('careerModal');
        const form = document.getElementById('careerForm');
        if (!modal || !form) return;

        const fields = {
            career_id: document.getElementById('cfCareerId'),
            name: document.getElementById('cfName'),
            apply_for: document.getElementById('cfPost'),
            email: document.getElementById('cfEmail'),
            phone: document.getElementById('cfPhone'),
            nationality: document.getElementById('cfNationality'),
            location: document.getElementById('cfLocation'),
            message: document.getElementById('cfMessage'),
            cv: document.getElementById('cfCv')
        };
        const submitBtn = document.getElementById('cfSubmit');
        const statusEl = document.getElementById('cfStatus');
        const successClose = document.getElementById('careerSuccessClose');
        const MAX_CV_BYTES = 3 * 1024 * 1024;
        let lastTrigger = null;

        function clearErrors() {
            form.querySelectorAll('.cr-error').forEach(function (el) { el.textContent = ''; });
            form.querySelectorAll('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
            statusEl.textContent = '';
        }

        function showErrors(errors) {
            let first = null;
            Object.keys(errors).forEach(function (key) {
                const messages = [].concat(errors[key]);
                const slot = form.querySelector('[data-error-for="' + key + '"]');
                const field = fields[key];
                if (slot) slot.textContent = messages[0] || '';
                if (field) {
                    field.classList.add('is-invalid');
                    if (!first) first = field;
                }
                if (!slot) statusEl.textContent = messages[0] || '';
            });
            if (first) first.focus();
        }

        function setSending(sending) {
            submitBtn.disabled = sending;
            submitBtn.textContent = sending ? 'Sending...' : 'Send Application';
        }

        function openModal(trigger) {
            lastTrigger = trigger;
            modal.classList.remove('sent');
            form.reset();
            clearErrors();
            setSending(false);

            fields.career_id.value = trigger.dataset.careerId || '';
            fields.apply_for.value = trigger.dataset.careerTitle || '';

            if (typeof modal.showModal === 'function') modal.showModal();
            else modal.setAttribute('open', '');
            document.documentElement.classList.add('cr-lock');
            modal.scrollTop = 0;
            fields.name.focus();
        }

        function closeModal() {
            if (typeof modal.close === 'function') modal.close();
            else modal.removeAttribute('open');
            onClosed();
        }

        function onClosed() {
            document.documentElement.classList.remove('cr-lock');
            if (lastTrigger) { lastTrigger.focus(); lastTrigger = null; }
        }

        document.querySelectorAll('[data-apply]').forEach(function (btn) {
            btn.addEventListener('click', function () { openModal(btn); });
        });

        document.getElementById('careerModalClose').addEventListener('click', closeModal);
        successClose.addEventListener('click', closeModal);
        modal.addEventListener('close', onClosed);                 // Esc key
        modal.addEventListener('click', function (e) {             // click on the dark backdrop
            if (e.target === modal) closeModal();
        });

        /* Phone: digits, spaces, +, -, ( ) only */
        fields.phone.addEventListener('input', function () {
            const cleaned = fields.phone.value.replace(/[^0-9+\-\s()]/g, '');
            if (cleaned !== fields.phone.value) fields.phone.value = cleaned;
        });

        /* Send without reloading the page, so the chosen CV is not lost on an error */
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            const file = fields.cv.files[0];
            if (file) {
                if (!/\.(pdf|doc|docx)$/i.test(file.name)) {
                    showErrors({ cv: ['Please upload a PDF or Word file (.pdf, .doc or .docx).'] });
                    return;
                }
                if (file.size > MAX_CV_BYTES) {
                    showErrors({ cv: ['This file is larger than 3 MB. Please choose a smaller file.'] });
                    return;
                }
            }

            setSending(true);
            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: new FormData(form)
                });

                if (res.status === 422) {
                    const data = await res.json();
                    showErrors(data.errors || {});
                    return;
                }
                if (res.status === 419) {
                    statusEl.textContent = 'Your session has expired. Please refresh the page and try again.';
                    return;
                }
                if (res.status === 429) {
                    statusEl.textContent = 'Too many attempts. Please wait a minute and try again.';
                    return;
                }
                if (res.status === 413) {
                    showErrors({ cv: ['This file is too large. Please choose a file under 3 MB.'] });
                    return;
                }
                if (!res.ok) throw new Error('Request failed: ' + res.status);

                modal.classList.add('sent');
                modal.scrollTop = 0;
                successClose.focus();
            } catch (err) {
                statusEl.textContent = 'Something went wrong while sending. Please try again in a moment.';
            } finally {
                setSending(false);
            }
        });
    });
    </script>

</body>

</html>