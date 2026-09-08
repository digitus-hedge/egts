<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-inner">
            {{-- Company Info --}}
            <div class="footer-col footer-brand">
                <img src="{{ asset('images/footer-logo.webp') }}" alt="EGTS Logo" class="footer-logo">
                <p>
                    Erbil Gate Technical Services Ltd. is a specialized oilfield machine shop based in Erbil, Kurdistan
                    Region of Iraq, delivering precision machining, premium threading, repair, remanufacturing and
                    inspection solutions to drilling contractors, oilfield service companies and energy operators across
                    the region.
                </p>
            </div>

            {{-- Services --}}
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ url('/services') }}">API Threading</a></li>
                    <li><a href="{{ url('/services') }}">Premium Connections</a></li>
                    <li><a href="{{ url('/services') }}">Repair &amp; Remanufacturing</a></li>
                    <li><a href="{{ url('/services') }}">Inspection &amp; QC</a></li>
                </ul>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li><a href="{{ url('/facility_capabilities') }}">Facility & Capabilities</a></li>
                    <li><a href="{{ url('/projects_clients') }}">Projects & Clients</a></li>
                    <li><a href="{{ url('/licenses') }}">Licenses</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li>{{ $contactBanner->address ?? '' }}</li>
                    <li>Phone: {{ $contactBanner->phone ?? '' }}</li>
                    <li>Email: {{ $contactBanner->email ?? '' }}</li>
                </ul>

                <div class="footer-social">
                    <a href="#" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z" />
                            <path
                                d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8z" />
                            <circle cx="18.406" cy="5.594" r="1.44" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.128 22 16.991 22 12z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.049c.476-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <span>&copy; {{ date('Y') }} Erbil Gate Technical Services Ltd. All rights reserved.</span>
            <span class="footer-tagline">Precision &bull; Reliability &bull; Safety &bull; Partnership</span>
        </div>
    </div>
</footer>
