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
                    @foreach ($footerServices as $service)
                        <li><a href="{{ url('/services/' . $service->slug) }}">{{ $service->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li><a href="{{ url('/career') }}">Careers</a></li>
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
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <span>&copy; {{ date('Y') }} Erbil Gate Technical Services Ltd. All rights reserved.</span>
            <span class="footer-tagline">Precision &bull; Reliability &bull; Safety &bull; Partnership</span>
        </div>
    </div>
</footer>

{{-- ============================================================
     FLOATING FEEDBACK BUTTON + MODAL (name + email optional)
   ============================================================ --}}
<button type="button" class="feedback-fab" id="feedbackFab" aria-label="Send feedback">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
    </svg>
    <span class="feedback-fab-text">Feedback</span>
</button>

<div class="feedback-modal" id="feedbackModal" aria-hidden="true" onclick="closeFeedbackOnBackdrop(event)">
    <div class="feedback-dialog" role="dialog" aria-labelledby="feedbackTitle">
        <button type="button" class="feedback-close" onclick="closeFeedbackModal()" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6"/></svg>
        </button>

        <div class="feedback-head">
            <div class="feedback-ico">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                </svg>
            </div>
            <div>
                <h3 id="feedbackTitle">Share Your Feedback</h3>
                <p>Tell us what's on your mind. We read every message.</p>
            </div>
        </div>

        <div class="feedback-alert feedback-alert-success" id="feedbackSuccess" style="display:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            <span id="feedbackSuccessMsg">Thank you! Your feedback has been sent successfully.</span>
        </div>
        <div class="feedback-alert feedback-alert-error" id="feedbackError" style="display:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            <span id="feedbackErrorMsg">Something went wrong. Please try again.</span>
        </div>

        <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST" class="feedback-form">
            @csrf

            {{-- Optional: Name --}}
            <div class="feedback-field">
                <label for="fbName">Your Name <small class="feedback-optional">(optional)</small></label>
                <input type="text" id="fbName" name="name" maxlength="120"
                       placeholder="e.g. John Doe" autocomplete="name">
            </div>

            {{-- Optional: Email --}}
            <div class="feedback-field">
                <label for="fbEmail">Your Email <small class="feedback-optional">(optional)</small></label>
                <input type="email" id="fbEmail" name="email" maxlength="180"
                       placeholder="e.g. you@example.com" autocomplete="email">
            </div>

            {{-- Required: Message --}}
            <div class="feedback-field">
                <label for="fbMessage">Your Message <span>*</span></label>
                <textarea id="fbMessage" name="message" rows="5"
                          placeholder="Write your feedback here..." maxlength="3000"></textarea>
                <div class="feedback-counter">
                    <span id="fbCount">0</span> / 3000
                </div>
            </div>

            <button type="submit" class="feedback-submit" id="feedbackSubmit">
                <span class="feedback-btn-text">Send Feedback</span>
                <svg class="feedback-spinner" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M22 12a10 10 0 00-10-10" stroke-linecap="round"/></svg>
            </button>
        </form>
    </div>
</div>

{{-- ============================================================
     FEEDBACK STYLES
   ============================================================ --}}
<style>
    .feedback-fab {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9998;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 20px;
        border: none;
        border-radius: 999px;
        background: linear-gradient(135deg, #5A7AAD, #425B82);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 10px 30px -8px rgba(90, 122, 173, 0.6), 0 4px 12px rgba(0,0,0,0.15);
        transition: transform .25s ease, box-shadow .25s ease;
        animation: feedbackPulse 2.4s ease-in-out infinite;
        font-family: inherit;
    }
    .feedback-fab:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 16px 40px -8px rgba(90, 122, 173, 0.75), 0 6px 16px rgba(0,0,0,0.2);
        animation: none;
    }
    .feedback-fab:active { transform: translateY(-1px) scale(0.98); }
    .feedback-fab svg { flex-shrink: 0; }

    @keyframes feedbackPulse {
        0%, 100% { box-shadow: 0 10px 30px -8px rgba(90, 122, 173, 0.6), 0 4px 12px rgba(0,0,0,0.15), 0 0 0 0 rgba(90, 122, 173, 0.4); }
        50%      { box-shadow: 0 10px 30px -8px rgba(90, 122, 173, 0.6), 0 4px 12px rgba(0,0,0,0.15), 0 0 0 14px rgba(90, 122, 173, 0); }
    }

    .feedback-modal {
        position: fixed;
        inset: 0;
        background: rgba(10, 15, 25, 0.65);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fbFadeIn .25s ease;
    }
    .feedback-modal.active { display: flex; }

    @keyframes fbFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .feedback-dialog {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 32px;
        position: relative;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.45);
        animation: fbSlideUp .35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fbSlideUp {
        from { opacity: 0; transform: translateY(30px) scale(0.96); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .feedback-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: #F2F4F8;
        color: #667085;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s, color .2s, transform .2s;
    }
    .feedback-close:hover {
        background: #BF0001;
        color: #fff;
        transform: rotate(90deg);
    }

    .feedback-head {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
        padding-right: 36px;
    }
    .feedback-ico {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #BF0001, #8C0001);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .feedback-head h3 {
        margin: 0 0 4px;
        font-size: 20px;
        font-weight: 700;
        color: #171B2C;
        letter-spacing: -0.01em;
    }
    .feedback-head p {
        margin: 0;
        font-size: 13.5px;
        color: #667085;
        line-height: 1.5;
    }

    .feedback-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 13.5px;
        margin-bottom: 16px;
        animation: fbSlideUp .3s ease;
    }
    .feedback-alert-success {
        background: #E9F8EF;
        color: #12875A;
        border: 1px solid #BFEBD2;
    }
    .feedback-alert-error {
        background: #FEECEC;
        color: #C92A2A;
        border: 1px solid #F7CCCC;
    }

    .feedback-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .feedback-field {
        display: flex;
        flex-direction: column;
    }
    .feedback-field label {
        font-size: 12.5px;
        font-weight: 600;
        color: #171B2C;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .feedback-field label span { color: #BF0001; }
    .feedback-optional {
        font-size: 11px;
        font-weight: 500;
        color: #9AA1B2;
        letter-spacing: 0;
    }
    .feedback-field input[type="text"],
    .feedback-field input[type="email"],
    .feedback-field textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #DBDFEA;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #171B2C;
        background: #fff;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        box-sizing: border-box;
    }
    .feedback-field textarea {
        resize: vertical;
        min-height: 120px;
        max-height: 240px;
        line-height: 1.55;
    }
    .feedback-field input[type="text"]:focus,
    .feedback-field input[type="email"]:focus,
    .feedback-field textarea:focus {
        border-color: #BF0001;
        box-shadow: 0 0 0 3px rgba(191, 0, 1, 0.1);
    }
    .feedback-counter {
        text-align: right;
        font-size: 11.5px;
        color: #9AA1B2;
        margin-top: 6px;
        font-weight: 500;
    }
    .feedback-counter.near-limit {
        color: #BF0001;
        font-weight: 600;
    }

    .feedback-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #0F1526, #1D2439);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 6px;
        transition: transform .15s, box-shadow .15s;
        font-family: inherit;
    }
    .feedback-submit:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -6px rgba(15, 21, 38, 0.45);
    }
    .feedback-submit:disabled {
        opacity: 0.7;
        cursor: wait;
    }
    .feedback-spinner { animation: fbSpin 0.8s linear infinite; }
    @keyframes fbSpin { to { transform: rotate(360deg); } }

    @media (max-width: 600px) {
        .feedback-fab {
            padding: 12px 16px;
            bottom: 16px;
            right: 16px;
        }
        .feedback-fab-text { display: none; }
        .feedback-dialog {
            padding: 22px;
            border-radius: 14px;
        }
        .feedback-head h3 { font-size: 17px; }
        .feedback-head p { font-size: 12.5px; }
    }
</style>

{{-- ============================================================
     FEEDBACK SCRIPT
   ============================================================ --}}
<script>
(function () {
    const fab        = document.getElementById('feedbackFab');
    const modal      = document.getElementById('feedbackModal');
    const form       = document.getElementById('feedbackForm');
    const submitBtn  = document.getElementById('feedbackSubmit');
    const btnText    = submitBtn.querySelector('.feedback-btn-text');
    const spinner    = submitBtn.querySelector('.feedback-spinner');
    const successBox = document.getElementById('feedbackSuccess');
    const errorBox   = document.getElementById('feedbackError');
    const successMsg = document.getElementById('feedbackSuccessMsg');
    const errorMsg   = document.getElementById('feedbackErrorMsg');
    const msgField   = document.getElementById('fbMessage');
    const counter    = document.getElementById('fbCount');
    const counterWrap = counter?.parentElement;

    if (!fab || !modal || !form) return;

    function openFeedback() {
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('fbName')?.focus(), 300);
    }

    window.closeFeedbackModal = function () {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        successBox.style.display = 'none';
        errorBox.style.display = 'none';
    };

    window.closeFeedbackOnBackdrop = function (e) {
        if (e.target === modal) closeFeedbackModal();
    };

    fab.addEventListener('click', openFeedback);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeFeedbackModal();
        }
    });

    // Character counter
    if (msgField && counter) {
        msgField.addEventListener('input', function () {
            const len = msgField.value.length;
            counter.textContent = len;
            if (len > 2700) {
                counterWrap.classList.add('near-limit');
            } else {
                counterWrap.classList.remove('near-limit');
            }
        });
    }

    // ============ AJAX SUBMIT — NO REDIRECT ============
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();

        successBox.style.display = 'none';
        errorBox.style.display = 'none';

        submitBtn.disabled = true;
        btnText.textContent = 'Sending...';
        spinner.style.display = 'inline-block';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            let data = {};
            try {
                data = await response.json();
            } catch (parseError) {
                throw new Error('Server returned an invalid response.');
            }

            if (!response.ok) {
                throw new Error(data.message || 'Could not send your feedback. Please try again.');
            }

            successMsg.textContent = data.message || 'Thank you! Your feedback has been sent successfully.';
            successBox.style.display = 'flex';

            form.reset();
            if (counter) counter.textContent = '0';
            if (counterWrap) counterWrap.classList.remove('near-limit');

            setTimeout(function () {
                closeFeedbackModal();
            }, 2500);
        })
        .catch(err => {
            errorMsg.textContent = err.message || 'Something went wrong. Please try again.';
            errorBox.style.display = 'flex';
        })
        .finally(() => {
            submitBtn.disabled = false;
            btnText.textContent = 'Send Feedback';
            spinner.style.display = 'none';
        });

        return false;
    });
})();
</script>