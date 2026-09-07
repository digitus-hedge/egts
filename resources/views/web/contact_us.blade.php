<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EGTS Erbil Gate Technical Services</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

    @include('web.layout.header')

    <main>

        {{-- ===== Page Hero Section ===== --}}
        <section class="ct-hero" @if($contactBanner?->image) style="background-image: url('{{ asset('storage/' . $contactBanner->image) }}');" @endif>
            <div class="ct-hero-overlay"></div>
            <div class="ct-hero-content">
                <span class="ct-hero-eyebrow">CONTACT US</span>
                <h1>{{ $contactBanner->title ?? '' }}</h1>
                <p>{{ $contactBanner->description ?? '' }}</p>
            </div>
        </section>
        {{-- ===== End Page Hero Section ===== --}}

        {{-- ===== Contact Content: Info + Form ===== --}}
        <section class="ct-content-section">
            <div class="ct-bg-decor ct-bg-decor-left">
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

            <div class="ct-content-inner">

                {{-- Left: Info --}}
                <div class="ct-info-col">
                    <span class="ct-section-eyebrow">GET IN TOUCH</span>
                    <h2>We'd Love to Hear From You</h2>
                    <p class="ct-info-lead">Whether you need a quote, technical consultation, or want to discuss a project, our team is ready to help. Reach out using the details below or send us a message directly.</p>

                    <div class="ct-info-list">
                        <div class="ct-info-item">
                            <div class="ct-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="ct-info-label">Address</span>
                                <span class="ct-info-value">{{ $contactBanner->address }}</span>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <span class="ct-info-label">Phone</span>
                                <span class="ct-info-value">{{ $contactBanner->phone }}</span>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <span class="ct-info-label">Email</span>
                                <span class="ct-info-value">{{ $contactBanner->email }}</span>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3"/>
                                </svg>
                            </div>
                            <div>
                                <span class="ct-info-label">Working Hours</span>
                                <span class="ct-info-value">{{ $contactBanner->working_hours }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="ct-social">
                        <a href="#" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                                <path d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8z"/>
                                <circle cx="18.406" cy="5.594" r="1.44"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.049c.476-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Right: Form --}}
                <div class="ct-form-col">
                    <div class="ct-form-card">
                        <h3>Send Us a Message</h3>
                        <p>Fill out the form and our team will get back to you within one business day.</p>

                        <form class="ct-form" action="{{ url('/contact/submit') }}" method="POST">
                            @csrf
                            <div class="ct-form-row">
                                <div class="ct-form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" placeholder="Your full name" required>
                                </div>
                                <div class="ct-form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                                </div>
                            </div>

                            <div class="ct-form-row">
                                <div class="ct-form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" placeholder="+964 xxx xxx xxxx">
                                </div>
                                <div class="ct-form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" id="subject" name="subject" placeholder="What is this regarding?" required>
                                </div>
                            </div>

                            <div class="ct-form-group ct-form-group-full">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="5" placeholder="Tell us about your requirement..." required></textarea>
                            </div>

                            <button type="submit" class="ct-submit-btn">Send Message</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
        {{-- ===== End Contact Content ===== --}}

        {{-- ===== Map Section ===== --}}
        <section class="ct-map-section">
            <iframe
                src="https://www.google.com/maps?q=Ankawa+Industrial+Area,+Erbil,+Iraq&output=embed"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </section>
        {{-- ===== End Map Section ===== --}}

    </main>

    @include('web.layout.footer')

</body>
</html>
