<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-inner">
            {{-- Company Info --}}
            <div class="footer-col footer-brand">
                <img src="{{ asset('images/footer-logo.webp') }}" alt="EGTS Logo" class="footer-logo">
                <p>
                    Erbil Gate Technical Services Ltd. — precision machining and technical services for oilfield and energy industries.
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
                    <li>{{ $contactBanner->address }}</li>
                    <li>Phone: {{ $contactBanner->phone }}</li>
                    <li>Email: {{ $contactBanner->email }}</li>
                </ul>
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
